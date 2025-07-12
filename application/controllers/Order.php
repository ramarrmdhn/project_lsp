<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model(['Order_model', 'Order_item_model', 'Cart_model', 'Ticket_model', 'User_model']);
        $this->load->library(['session', 'form_validation']);
    }
    
    /**
     * List user orders
     */
    public function index() {
        // Check if user is logged in
        if (!$this->session->userdata('user_id')) {
            redirect('auth/login');
        }
        
        $user_id = $this->session->userdata('user_id');
        $data['orders'] = $this->Order_model->getByUser($user_id);
        $data['title'] = 'My Orders - Ticket Concert';
        
        $this->load->view('templates/header', $data);
        $this->load->view('orders/index', $data);
        $this->load->view('templates/footer');
    }
    
    /**
     * View order details
     */
    public function view($order_id) {
        // Check if user is logged in
        if (!$this->session->userdata('user_id')) {
            redirect('auth/login');
        }
        
        $user_id = $this->session->userdata('user_id');
        $order = $this->Order_model->getById($order_id);
        
        // Check if order belongs to user
        if (!$order || $order->user_id != $user_id) {
            show_404();
        }
        
        $data['order'] = $this->Order_model->getWithItems($order_id);
        $data['title'] = 'Order #' . $order->order_number . ' - Ticket Concert';
        
        $this->load->view('templates/header', $data);
        $this->load->view('orders/view', $data);
        $this->load->view('templates/footer');
    }
    
    /**
     * Create order from cart
     */
    public function create() {
        // Check if user is logged in
        if (!$this->session->userdata('user_id')) {
            redirect('auth/login');
        }
        
        $user_id = $this->session->userdata('user_id');
        
        // Validate cart
        $errors = $this->Cart_model->validateCart($user_id);
        if (!empty($errors)) {
            $this->session->set_flashdata('error', implode('<br>', $errors));
            redirect('cart');
        }
        
        // Get cart summary
        $cart_summary = $this->Cart_model->getSummary($user_id);
        if (empty($cart_summary['items'])) {
            $this->session->set_flashdata('error', 'Your cart is empty');
            redirect('cart');
        }
        
        // Form validation
        $this->form_validation->set_rules('customer_name', 'Customer Name', 'required');
        $this->form_validation->set_rules('customer_email', 'Customer Email', 'required|valid_email');
        $this->form_validation->set_rules('customer_phone', 'Customer Phone', 'required');
        $this->form_validation->set_rules('payment_method', 'Payment Method', 'required');
        
        if ($this->form_validation->run()) {
            // Create order
            $order_data = [
                'user_id' => $user_id,
                'order_number' => $this->Order_model->generateOrderNumber(),
                'customer_name' => $this->input->post('customer_name'),
                'customer_email' => $this->input->post('customer_email'),
                'customer_phone' => $this->input->post('customer_phone'),
                'customer_address' => $this->input->post('customer_address'),
                'payment_method' => $this->input->post('payment_method'),
                'total_amount' => $cart_summary['total_amount'],
                'status' => 'pending'
            ];
            
            $order_id = $this->Order_model->create($order_data);
            
            if ($order_id) {
                // Create order items
                foreach ($cart_summary['items'] as $item) {
                    $order_item_data = [
                        'order_id' => $order_id,
                        'ticket_id' => $item['ticket_id'],
                        'quantity' => $item['quantity'],
                        'price' => $item['price'],
                        'subtotal' => $item['subtotal']
                    ];
                    
                    $this->Order_item_model->create($order_item_data);
                    
                    // Decrease ticket quantity
                    $this->Ticket_model->decreaseQuantity($item['ticket_id'], $item['quantity']);
                }
                
                // Clear cart
                $this->Cart_model->clear($user_id);
                
                $this->session->set_flashdata('success', 'Order created successfully! Order #' . $order_data['order_number']);
                redirect('order/view/' . $order_id);
            } else {
                $this->session->set_flashdata('error', 'Failed to create order');
                redirect('cart/checkout');
            }
        }
        
        // Show checkout form
        $data['cart_summary'] = $cart_summary;
        $data['user'] = $this->User_model->getById($user_id);
        $data['title'] = 'Checkout - Ticket Concert';
        
        $this->load->view('templates/header', $data);
        $this->load->view('orders/checkout', $data);
        $this->load->view('templates/footer');
    }
    
    /**
     * Cancel order
     */
    public function cancel($order_id) {
        // Check if user is logged in
        if (!$this->session->userdata('user_id')) {
            redirect('auth/login');
        }
        
        $user_id = $this->session->userdata('user_id');
        $order = $this->Order_model->getById($order_id);
        
        // Check if order belongs to user and can be cancelled
        if (!$order || $order->user_id != $user_id || $order->status !== 'pending') {
            $this->session->set_flashdata('error', 'Order cannot be cancelled');
            redirect('order');
        }
        
        // Update order status
        $result = $this->Order_model->updateStatus($order_id, 'cancelled');
        
        if ($result) {
            // Restore ticket quantities
            $order_items = $this->Order_item_model->getByOrder($order_id);
            foreach ($order_items as $item) {
                $ticket = $this->Ticket_model->getById($item->ticket_id);
                $new_quantity = $ticket->quantity + $item->quantity;
                $status = $new_quantity > 0 ? 'available' : 'sold_out';
                $this->Ticket_model->update($item->ticket_id, [
                    'quantity' => $new_quantity,
                    'status' => $status
                ]);
            }
            
            $this->session->set_flashdata('success', 'Order cancelled successfully');
        } else {
            $this->session->set_flashdata('error', 'Failed to cancel order');
        }
        
        redirect('order');
    }
    
    /**
     * Process payment
     */
    public function payment($order_id) {
        // Check if user is logged in
        if (!$this->session->userdata('user_id')) {
            redirect('auth/login');
        }
        
        $user_id = $this->session->userdata('user_id');
        $order = $this->Order_model->getById($order_id);
        
        // Check if order belongs to user and is pending
        if (!$order || $order->user_id != $user_id || $order->status !== 'pending') {
            $this->session->set_flashdata('error', 'Invalid order');
            redirect('order');
        }
        
        // Process payment (implement payment gateway integration)
        $payment_method = $order->payment_method;
        
        // For demo purposes, mark as paid
        $result = $this->Order_model->updateStatus($order_id, 'paid');
        
        if ($result) {
            $this->session->set_flashdata('success', 'Payment processed successfully!');
        } else {
            $this->session->set_flashdata('error', 'Payment failed');
        }
        
        redirect('order/view/' . $order_id);
    }
    
    /**
     * Download ticket (PDF)
     */
    public function download_ticket($order_id) {
        // Check if user is logged in
        if (!$this->session->userdata('user_id')) {
            redirect('auth/login');
        }
        
        $user_id = $this->session->userdata('user_id');
        $order = $this->Order_model->getById($order_id);
        
        // Check if order belongs to user and is paid
        if (!$order || $order->user_id != $user_id || $order->status !== 'paid') {
            $this->session->set_flashdata('error', 'Invalid order or not paid');
            redirect('order');
        }
        
        // Generate PDF ticket (implement PDF generation)
        $data['order'] = $this->Order_model->getWithItems($order_id);
        
        // For now, just show the ticket details
        $this->load->view('orders/ticket_pdf', $data);
    }
    
    /**
     * Get order status (AJAX)
     */
    public function status($order_id) {
        // Check if user is logged in
        if (!$this->session->userdata('user_id')) {
            echo json_encode(['success' => false, 'message' => 'Please login first']);
            return;
        }
        
        $user_id = $this->session->userdata('user_id');
        $order = $this->Order_model->getById($order_id);
        
        if (!$order || $order->user_id != $user_id) {
            echo json_encode(['success' => false, 'message' => 'Invalid order']);
            return;
        }
        
        echo json_encode([
            'success' => true,
            'status' => $order->status,
            'order_number' => $order->order_number
        ]);
    }
} 