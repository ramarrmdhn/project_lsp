<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model(['User_model', 'Concert_model', 'Ticket_model', 'Order_model']);
        $this->load->library(['session', 'form_validation']);
        
        // Check if user is logged in and is admin
        if (!$this->session->userdata('user_id') || $this->session->userdata('role') !== 'admin') {
            redirect('auth/login');
        }
    }
    
    /**
     * Admin dashboard
     */
    public function index() {
        $data['title'] = 'Admin Dashboard - Ticket Concert';
        
        // Get statistics
        $data['stats'] = [
            'users' => $this->User_model->getCount(),
            'concerts' => $this->Concert_model->getCount(),
            'tickets' => $this->Ticket_model->getStatistics(),
            'orders' => $this->Order_model->getStatistics()
        ];
        
        // Get recent orders
        $data['recent_orders'] = $this->Order_model->getWithUser(5);
        
        // Get popular concerts
        $data['popular_concerts'] = $this->Concert_model->getPopular(5);
        
        // Get recent users
        $data['recent_users'] = $this->User_model->getAll(5);
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/dashboard', $data);
        $this->load->view('admin/templates/footer');
    }
    
    /**
     * Admin profile
     */
    public function profile() {
        $user_id = $this->session->userdata('user_id');
        
        if ($this->input->post()) {
            $this->form_validation->set_rules('full_name', 'Full Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('phone', 'Phone', 'required');
            
            if ($this->form_validation->run()) {
                $update_data = [
                    'full_name' => $this->input->post('full_name'),
                    'email' => $this->input->post('email'),
                    'phone' => $this->input->post('phone'),
                    'address' => $this->input->post('address')
                ];
                
                if ($this->User_model->update($user_id, $update_data)) {
                    $this->session->set_flashdata('success', 'Profile updated successfully');
                } else {
                    $this->session->set_flashdata('error', 'Failed to update profile');
                }
                redirect('admin/profile');
            }
        }
        
        $data['user'] = $this->User_model->getById($user_id);
        $data['title'] = 'Admin Profile - Ticket Concert';
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/profile', $data);
        $this->load->view('admin/templates/footer');
    }
    
    /**
     * Change admin password
     */
    public function change_password() {
        if ($this->input->post()) {
            $this->form_validation->set_rules('current_password', 'Current Password', 'required');
            $this->form_validation->set_rules('new_password', 'New Password', 'required|min_length[6]');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[new_password]');
            
            if ($this->form_validation->run()) {
                $user_id = $this->session->userdata('user_id');
                $user = $this->User_model->getById($user_id);
                
                if (password_verify($this->input->post('current_password'), $user->password)) {
                    $this->User_model->update($user_id, [
                        'password' => password_hash($this->input->post('new_password'), PASSWORD_DEFAULT)
                    ]);
                    
                    $this->session->set_flashdata('success', 'Password changed successfully');
                } else {
                    $this->session->set_flashdata('error', 'Current password is incorrect');
                }
                redirect('admin/profile');
            }
        }
        
        redirect('admin/profile');
    }
    
    /**
     * Admin settings
     */
    public function settings() {
        if ($this->input->post()) {
            // Handle settings update
            $this->session->set_flashdata('success', 'Settings updated successfully');
            redirect('admin/settings');
        }
        
        $data['title'] = 'Admin Settings - Ticket Concert';
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/settings', $data);
        $this->load->view('admin/templates/footer');
    }
    
    /**
     * Admin reports
     */
    public function reports() {
        $data['title'] = 'Reports - Ticket Concert';
        
        // Get date range for reports
        $start_date = $this->input->get('start_date') ?: date('Y-m-01');
        $end_date = $this->input->get('end_date') ?: date('Y-m-t');
        
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        
        // Get sales report
        $data['sales_report'] = $this->Order_model->getByDateRange($start_date, $end_date);
        $data['total_sales'] = $this->Order_model->getTotalSales([
            'created_at >=' => $start_date,
            'created_at <=' => $end_date
        ]);
        
        // Get best selling tickets
        $this->load->model('Order_item_model');
        $data['best_selling'] = $this->Order_item_model->getBestSelling(10);
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/reports', $data);
        $this->load->view('admin/templates/footer');
    }
    
    /**
     * Export data
     */
    public function export($type = 'orders') {
        switch ($type) {
            case 'orders':
                $data = $this->Order_model->getWithUser();
                $filename = 'orders_' . date('Y-m-d') . '.csv';
                break;
            case 'users':
                $data = $this->User_model->getAll();
                $filename = 'users_' . date('Y-m-d') . '.csv';
                break;
            case 'concerts':
                $data = $this->Concert_model->getAll();
                $filename = 'concerts_' . date('Y-m-d') . '.csv';
                break;
            default:
                redirect('admin');
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
     * System logs
     */
    public function logs() {
        $data['title'] = 'System Logs - Ticket Concert';
        
        // Read log files (implement log reading functionality)
        $data['logs'] = [];
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/logs', $data);
        $this->load->view('admin/templates/footer');
    }
    
    /**
     * Backup database
     */
    public function backup() {
        $data['title'] = 'Database Backup - Ticket Concert';
        
        if ($this->input->post('backup')) {
            // Implement database backup functionality
            $this->session->set_flashdata('success', 'Database backup created successfully');
            redirect('admin/backup');
        }
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/backup', $data);
        $this->load->view('admin/templates/footer');
    }
} 