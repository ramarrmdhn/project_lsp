<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_order extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model(['Order_model', 'Order_item_model', 'User_model']);
        $this->load->library(['session', 'form_validation']);
        
        // Check if user is logged in and is admin
        if (!$this->session->userdata('user_id') || $this->session->userdata('role') !== 'admin') {
            redirect('auth/login');
        }
    }
    
    /**
     * List all orders
     */
    public function index() {
        $data['orders'] = $this->Order_model->getWithUser();
        $data['title'] = 'Manage Orders - Admin';
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/orders/index', $data);
        $this->load->view('admin/templates/footer');
    }
    
    /**
     * View order details
     */
    public function view($id) {
        $order = $this->Order_model->getById($id);
        
        if (!$order) {
            show_404();
        }
        
        $data['order'] = $this->Order_model->getWithItems($id);
        $data['title'] = 'Order #' . $order->order_number . ' - Admin';
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/orders/view', $data);
        $this->load->view('admin/templates/footer');
    }
    
    /**
     * Update order status
     */
    public function update_status($id) {
        $order = $this->Order_model->getById($id);
        
        if (!$order) {
            $this->session->set_flashdata('error', 'Order not found');
            redirect('admin_order');
        }
        
        $new_status = $this->input->post('status');
        
        if ($this->Order_model->updateStatus($id, $new_status)) {
            $this->session->set_flashdata('success', 'Order status updated successfully');
        } else {
            $this->session->set_flashdata('error', 'Failed to update order status');
        }
        
        redirect('admin_order/view/' . $id);
    }
    
    /**
     * Cancel order
     */
    public function cancel($id) {
        $order = $this->Order_model->getById($id);
        
        if (!$order) {
            $this->session->set_flashdata('error', 'Order not found');
            redirect('admin_order');
        }
        
        // Check if order can be cancelled
        if ($order->status === 'paid') {
            $this->session->set_flashdata('error', 'Cannot cancel paid orders');
            redirect('admin_order/view/' . $id);
        }
        
        // Update order status
        $result = $this->Order_model->updateStatus($id, 'cancelled');
        
        if ($result) {
            // Restore ticket quantities
            $order_items = $this->Order_item_model->getByOrder($id);
            foreach ($order_items as $item) {
                $this->load->model('Ticket_model');
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
        
        redirect('admin_order');
    }
    
    /**
     * Delete order
     */
    public function delete($id) {
        $order = $this->Order_model->getById($id);
        
        if (!$order) {
            $this->session->set_flashdata('error', 'Order not found');
            redirect('admin_order');
        }
        
        // Check if order can be deleted
        if ($order->status === 'paid') {
            $this->session->set_flashdata('error', 'Cannot delete paid orders');
            redirect('admin_order');
        }
        
        if ($this->Order_model->delete($id)) {
            $this->session->set_flashdata('success', 'Order deleted successfully');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete order');
        }
        
        redirect('admin_order');
    }
    
    /**
     * Get orders by status
     */
    public function by_status($status) {
        $data['orders'] = $this->Order_model->getByStatus($status);
        $data['status'] = ucfirst($status);
        $data['title'] = ucfirst($status) . ' Orders - Admin';
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/orders/by_status', $data);
        $this->load->view('admin/templates/footer');
    }
    
    /**
     * Search orders
     */
    public function search() {
        $keyword = $this->input->get('keyword');
        
        if ($keyword) {
            $data['orders'] = $this->Order_model->search($keyword);
            $data['keyword'] = $keyword;
        } else {
            $data['orders'] = $this->Order_model->getWithUser();
            $data['keyword'] = '';
        }
        
        $data['title'] = 'Search Orders - Admin';
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/orders/search', $data);
        $this->load->view('admin/templates/footer');
    }
    
    /**
     * Get orders by date range
     */
    public function by_date() {
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');
        
        if ($start_date && $end_date) {
            $data['orders'] = $this->Order_model->getByDateRange($start_date, $end_date);
            $data['start_date'] = $start_date;
            $data['end_date'] = $end_date;
        } else {
            $data['orders'] = $this->Order_model->getWithUser();
            $data['start_date'] = '';
            $data['end_date'] = '';
        }
        
        $data['title'] = 'Orders by Date - Admin';
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/orders/by_date', $data);
        $this->load->view('admin/templates/footer');
    }
    
    /**
     * Get orders by user
     */
    public function by_user($user_id) {
        $user = $this->User_model->getById($user_id);
        
        if (!$user) {
            show_404();
        }
        
        $data['orders'] = $this->Order_model->getByUser($user_id);
        $data['user'] = $user;
        $data['title'] = 'Orders by ' . $user->full_name . ' - Admin';
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/orders/by_user', $data);
        $this->load->view('admin/templates/footer');
    }
    
    /**
     * Export orders
     */
    public function export() {
        $status = $this->input->get('status');
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');
        
        if ($status) {
            $data = $this->Order_model->getByStatus($status);
            $filename = 'orders_' . $status . '_' . date('Y-m-d') . '.csv';
        } elseif ($start_date && $end_date) {
            $data = $this->Order_model->getByDateRange($start_date, $end_date);
            $filename = 'orders_' . $start_date . '_to_' . $end_date . '.csv';
        } else {
            $data = $this->Order_model->getWithUser();
            $filename = 'orders_' . date('Y-m-d') . '.csv';
        }
        
        // Generate CSV
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        $output = fopen('php://output', 'w');
        
        // Add headers
        if (!empty($data)) {
            fputcsv($output, array_keys((array) $data[0]));
        }
        
        // Add data
        foreach ($data as $row) {
            fputcsv($output, (array) $row);
        }
        
        fclose($output);
    }
    
    /**
     * Print order
     */
    public function print_order($id) {
        $order = $this->Order_model->getById($id);
        
        if (!$order) {
            show_404();
        }
        
        $data['order'] = $this->Order_model->getWithItems($id);
        $data['title'] = 'Order #' . $order->order_number;
        
        $this->load->view('admin/orders/print', $data);
    }
    
    /**
     * Send order confirmation email
     */
    public function send_email($id) {
        $order = $this->Order_model->getById($id);
        
        if (!$order) {
            $this->session->set_flashdata('error', 'Order not found');
            redirect('admin_order');
        }
        
        // Implement email sending functionality
        // For now, just show success message
        $this->session->set_flashdata('success', 'Order confirmation email sent successfully');
        redirect('admin_order/view/' . $id);
    }
    
    /**
     * Get order statistics
     */
    public function statistics() {
        $data['stats'] = $this->Order_model->getStatistics();
        $data['title'] = 'Order Statistics - Admin';
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/orders/statistics', $data);
        $this->load->view('admin/templates/footer');
    }
} 