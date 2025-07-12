<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_user extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library(['session', 'form_validation']);
        
        // Check if user is logged in and is admin
        if (!$this->session->userdata('user_id') || $this->session->userdata('role') !== 'admin') {
            redirect('auth/login');
        }
    }
    
    /**
     * List all users
     */
    public function index() {
        $data['users'] = $this->User_model->getAll();
        $data['title'] = 'Manage Users - Admin';
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/users/index', $data);
        $this->load->view('admin/templates/footer');
    }
    
    /**
     * Add new user
     */
    public function add() {
        if ($this->input->post()) {
            $this->form_validation->set_rules('username', 'Username', 'required|min_length[3]|max_length[50]|is_unique[users.username]');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
            $this->form_validation->set_rules('full_name', 'Full Name', 'required');
            $this->form_validation->set_rules('phone', 'Phone', 'required');
            $this->form_validation->set_rules('role', 'Role', 'required');
            
            if ($this->form_validation->run()) {
                $user_data = [
                    'username' => $this->input->post('username'),
                    'email' => $this->input->post('email'),
                    'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                    'full_name' => $this->input->post('full_name'),
                    'phone' => $this->input->post('phone'),
                    'address' => $this->input->post('address'),
                    'role' => $this->input->post('role'),
                    'status' => 'active'
                ];
                
                $user_id = $this->User_model->create($user_data);
                
                if ($user_id) {
                    $this->session->set_flashdata('success', 'User added successfully');
                    redirect('admin_user');
                } else {
                    $this->session->set_flashdata('error', 'Failed to add user');
                }
            }
        }
        
        $data['title'] = 'Add User - Admin';
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/users/add', $data);
        $this->load->view('admin/templates/footer');
    }
    
    /**
     * Edit user
     */
    public function edit($id) {
        $user = $this->User_model->getById($id);
        
        if (!$user) {
            show_404();
        }
        
        if ($this->input->post()) {
            $this->form_validation->set_rules('username', 'Username', 'required|min_length[3]|max_length[50]');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('full_name', 'Full Name', 'required');
            $this->form_validation->set_rules('phone', 'Phone', 'required');
            $this->form_validation->set_rules('role', 'Role', 'required');
            
            // Check if username is unique (excluding current user)
            $existing_username = $this->User_model->getByUsername($this->input->post('username'));
            if ($existing_username && $existing_username->id != $id) {
                $this->form_validation->set_message('username', 'Username already exists');
                $this->form_validation->set_rules('username', 'Username', 'is_unique[users.username]');
            }
            
            // Check if email is unique (excluding current user)
            $existing_email = $this->User_model->getByEmail($this->input->post('email'));
            if ($existing_email && $existing_email->id != $id) {
                $this->form_validation->set_message('email', 'Email already exists');
                $this->form_validation->set_rules('email', 'Email', 'is_unique[users.email]');
            }
            
            if ($this->form_validation->run()) {
                $user_data = [
                    'username' => $this->input->post('username'),
                    'email' => $this->input->post('email'),
                    'full_name' => $this->input->post('full_name'),
                    'phone' => $this->input->post('phone'),
                    'address' => $this->input->post('address'),
                    'role' => $this->input->post('role'),
                    'status' => $this->input->post('status')
                ];
                
                // Update password if provided
                if ($this->input->post('password')) {
                    $this->form_validation->set_rules('password', 'Password', 'min_length[6]');
                    $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'matches[password]');
                    
                    if ($this->form_validation->run()) {
                        $user_data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
                    }
                }
                
                if ($this->User_model->update($id, $user_data)) {
                    $this->session->set_flashdata('success', 'User updated successfully');
                    redirect('admin_user');
                } else {
                    $this->session->set_flashdata('error', 'Failed to update user');
                }
            }
        }
        
        $data['user'] = $user;
        $data['title'] = 'Edit User - Admin';
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/users/edit', $data);
        $this->load->view('admin/templates/footer');
    }
    
    /**
     * Delete user
     */
    public function delete($id) {
        $user = $this->User_model->getById($id);
        
        if (!$user) {
            $this->session->set_flashdata('error', 'User not found');
            redirect('admin_user');
        }
        
        // Prevent admin from deleting themselves
        if ($id == $this->session->userdata('user_id')) {
            $this->session->set_flashdata('error', 'You cannot delete your own account');
            redirect('admin_user');
        }
        
        if ($this->User_model->delete($id)) {
            $this->session->set_flashdata('success', 'User deleted successfully');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete user');
        }
        
        redirect('admin_user');
    }
    
    /**
     * View user details
     */
    public function view($id) {
        $user = $this->User_model->getById($id);
        
        if (!$user) {
            show_404();
        }
        
        $data['user'] = $user;
        $data['title'] = 'User Details - Admin';
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/users/view', $data);
        $this->load->view('admin/templates/footer');
    }
    
    /**
     * Block user
     */
    public function block($id) {
        $user = $this->User_model->getById($id);
        
        if (!$user) {
            $this->session->set_flashdata('error', 'User not found');
            redirect('admin_user');
        }
        
        // Prevent admin from blocking themselves
        if ($id == $this->session->userdata('user_id')) {
            $this->session->set_flashdata('error', 'You cannot block your own account');
            redirect('admin_user');
        }
        
        if ($this->User_model->block($id)) {
            $this->session->set_flashdata('success', 'User blocked successfully');
        } else {
            $this->session->set_flashdata('error', 'Failed to block user');
        }
        
        redirect('admin_user');
    }
    
    /**
     * Unblock user
     */
    public function unblock($id) {
        $user = $this->User_model->getById($id);
        
        if (!$user) {
            $this->session->set_flashdata('error', 'User not found');
            redirect('admin_user');
        }
        
        if ($this->User_model->unblock($id)) {
            $this->session->set_flashdata('success', 'User unblocked successfully');
        } else {
            $this->session->set_flashdata('error', 'Failed to unblock user');
        }
        
        redirect('admin_user');
    }
    
    /**
     * Reset user password
     */
    public function reset_password($id) {
        $user = $this->User_model->getById($id);
        
        if (!$user) {
            $this->session->set_flashdata('error', 'User not found');
            redirect('admin_user');
        }
        
        $new_password = $this->generateRandomPassword();
        
        if ($this->User_model->resetPassword($id, $new_password)) {
            $this->session->set_flashdata('success', 'Password reset successfully. New password: ' . $new_password);
        } else {
            $this->session->set_flashdata('error', 'Failed to reset password');
        }
        
        redirect('admin_user');
    }
    
    /**
     * Search users
     */
    public function search() {
        $keyword = $this->input->get('keyword');
        
        if ($keyword) {
            $data['users'] = $this->User_model->search($keyword);
            $data['keyword'] = $keyword;
        } else {
            $data['users'] = $this->User_model->getAll();
            $data['keyword'] = '';
        }
        
        $data['title'] = 'Search Users - Admin';
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/users/search', $data);
        $this->load->view('admin/templates/footer');
    }
    
    /**
     * Get users by role
     */
    public function by_role($role) {
        $data['users'] = $this->User_model->getByRole($role);
        $data['role'] = ucfirst($role);
        $data['title'] = ucfirst($role) . ' Users - Admin';
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/users/by_role', $data);
        $this->load->view('admin/templates/footer');
    }
    
    /**
     * Get active users
     */
    public function active() {
        $data['users'] = $this->User_model->getActive();
        $data['title'] = 'Active Users - Admin';
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/users/active', $data);
        $this->load->view('admin/templates/footer');
    }
    
    /**
     * Generate random password
     */
    private function generateRandomPassword($length = 8) {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*';
        $password = '';
        
        for ($i = 0; $i < $length; $i++) {
            $password .= $chars[rand(0, strlen($chars) - 1)];
        }
        
        return $password;
    }
} 