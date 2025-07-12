<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model(['Cart_model', 'Ticket_model', 'Concert_model']);
        $this->load->library(['session', 'form_validation']);
    }
    
    /**
     * View cart
     */
    public function index() {
        // Check if user is logged in
        if (!$this->session->userdata('user_id')) {
            redirect('auth/login');
        }
        
        $user_id = $this->session->userdata('user_id');
        $data['cart_items'] = $this->Cart_model->getWithTicket($user_id);
        $data['cart_total'] = $this->Cart_model->getTotal($user_id);
        $data['item_count'] = $this->Cart_model->getItemCount($user_id);
        $data['title'] = 'Shopping Cart - Ticket Concert';
        
        $this->load->view('templates/header', $data);
        $this->load->view('cart/index', $data);
        $this->load->view('templates/footer');
    }
    
    /**
     * Add item to cart
     */
    public function add() {
        // Check if user is logged in
        if (!$this->session->userdata('user_id')) {
            echo json_encode(['success' => false, 'message' => 'Please login first']);
            return;
        }
        
        $user_id = $this->session->userdata('user_id');
        $ticket_id = $this->input->post('ticket_id');
        $quantity = $this->input->post('quantity') ?: 1;
        
        // Validate ticket
        $ticket = $this->Ticket_model->getById($ticket_id);
        if (!$ticket || $ticket->status !== 'available' || $ticket->quantity < $quantity) {
            echo json_encode(['success' => false, 'message' => 'Ticket not available']);
            return;
        }
        
        // Add to cart
        $cart_data = [
            'user_id' => $user_id,
            'ticket_id' => $ticket_id,
            'quantity' => $quantity,
            'price' => $ticket->price
        ];
        
        $result = $this->Cart_model->add($cart_data);
        
        if ($result) {
            $item_count = $this->Cart_model->getItemCount($user_id);
            echo json_encode([
                'success' => true, 
                'message' => 'Added to cart successfully',
                'item_count' => $item_count
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to add to cart']);
        }
    }
    
    /**
     * Update cart item quantity
     */
    public function update() {
        // Check if user is logged in
        if (!$this->session->userdata('user_id')) {
            echo json_encode(['success' => false, 'message' => 'Please login first']);
            return;
        }
        
        $user_id = $this->session->userdata('user_id');
        $cart_id = $this->input->post('cart_id');
        $quantity = $this->input->post('quantity');
        
        // Validate cart item belongs to user
        $cart_item = $this->Cart_model->getById($cart_id);
        if (!$cart_item || $cart_item->user_id != $user_id) {
            echo json_encode(['success' => false, 'message' => 'Invalid cart item']);
            return;
        }
        
        // Check ticket availability
        $ticket = $this->Ticket_model->getById($cart_item->ticket_id);
        if ($ticket->quantity < $quantity) {
            echo json_encode(['success' => false, 'message' => 'Not enough tickets available']);
            return;
        }
        
        // Update quantity
        $result = $this->Cart_model->updateQuantity($cart_id, $quantity);
        
        if ($result) {
            $cart_total = $this->Cart_model->getTotal($user_id);
            echo json_encode([
                'success' => true, 
                'message' => 'Cart updated successfully',
                'cart_total' => $cart_total
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update cart']);
        }
    }
    
    /**
     * Remove item from cart
     */
    public function remove() {
        // Check if user is logged in
        if (!$this->session->userdata('user_id')) {
            echo json_encode(['success' => false, 'message' => 'Please login first']);
            return;
        }
        
        $user_id = $this->session->userdata('user_id');
        $cart_id = $this->input->post('cart_id');
        
        // Validate cart item belongs to user
        $cart_item = $this->Cart_model->getById($cart_id);
        if (!$cart_item || $cart_item->user_id != $user_id) {
            echo json_encode(['success' => false, 'message' => 'Invalid cart item']);
            return;
        }
        
        // Remove item
        $result = $this->Cart_model->remove($cart_id);
        
        if ($result) {
            $cart_total = $this->Cart_model->getTotal($user_id);
            $item_count = $this->Cart_model->getItemCount($user_id);
            echo json_encode([
                'success' => true, 
                'message' => 'Item removed from cart',
                'cart_total' => $cart_total,
                'item_count' => $item_count
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to remove item']);
        }
    }
    
    /**
     * Clear cart
     */
    public function clear() {
        // Check if user is logged in
        if (!$this->session->userdata('user_id')) {
            redirect('auth/login');
        }
        
        $user_id = $this->session->userdata('user_id');
        $result = $this->Cart_model->clear($user_id);
        
        if ($result) {
            $this->session->set_flashdata('success', 'Cart cleared successfully');
        } else {
            $this->session->set_flashdata('error', 'Failed to clear cart');
        }
        
        redirect('cart');
    }
    
    /**
     * Get cart summary (AJAX)
     */
    public function summary() {
        // Check if user is logged in
        if (!$this->session->userdata('user_id')) {
            echo json_encode(['success' => false, 'message' => 'Please login first']);
            return;
        }
        
        $user_id = $this->session->userdata('user_id');
        $summary = $this->Cart_model->getSummary($user_id);
        
        echo json_encode([
            'success' => true,
            'summary' => $summary
        ]);
    }
    
    /**
     * Validate cart (AJAX)
     */
    public function validate() {
        // Check if user is logged in
        if (!$this->session->userdata('user_id')) {
            echo json_encode(['success' => false, 'message' => 'Please login first']);
            return;
        }
        
        $user_id = $this->session->userdata('user_id');
        $errors = $this->Cart_model->validateCart($user_id);
        
        if (empty($errors)) {
            echo json_encode(['success' => true, 'valid' => true]);
        } else {
            echo json_encode([
                'success' => true, 
                'valid' => false, 
                'errors' => $errors
            ]);
        }
    }
    
    /**
     * Checkout
     */
    public function checkout() {
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
        $data['cart_summary'] = $this->Cart_model->getSummary($user_id);
        $data['user'] = $this->User_model->getById($user_id);
        $data['title'] = 'Checkout - Ticket Concert';
        
        if (empty($data['cart_summary']['items'])) {
            $this->session->set_flashdata('error', 'Your cart is empty');
            redirect('cart');
        }
        
        $this->load->view('templates/header', $data);
        $this->load->view('cart/checkout', $data);
        $this->load->view('templates/footer');
    }
} 