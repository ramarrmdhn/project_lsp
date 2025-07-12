<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library(['session', 'form_validation']);
        
        // Check if user is logged in
        if (!$this->session->userdata('user_id')) {
            redirect('auth/login');
        }
    }
    
    /**
     * View user profile
     */
    public function index() {
        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->User_model->getById($user_id);
        $data['title'] = 'My Profile - Ticket Concert';
        
        $this->load->view('templates/header', $data);
        $this->load->view('profile/index', $data);
        $this->load->view('templates/footer');
    }
    
    /**
     * Edit profile
     */
    public function edit() {
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
                    redirect('profile');
                } else {
                    $this->session->set_flashdata('error', 'Failed to update profile');
                }
            }
        }
        
        $data['user'] = $this->User_model->getById($user_id);
        $data['title'] = 'Edit Profile - Ticket Concert';
        
        $this->load->view('templates/header', $data);
        $this->load->view('profile/edit', $data);
        $this->load->view('templates/footer');
    }
    
    /**
     * Change password
     */
    public function change_password() {
        $user_id = $this->session->userdata('user_id');
        
        if ($this->input->post()) {
            $this->form_validation->set_rules('current_password', 'Current Password', 'required');
            $this->form_validation->set_rules('new_password', 'New Password', 'required|min_length[6]');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[new_password]');
            
            if ($this->form_validation->run()) {
                $user = $this->User_model->getById($user_id);
                
                if (password_verify($this->input->post('current_password'), $user->password)) {
                    $this->User_model->update($user_id, [
                        'password' => password_hash($this->input->post('new_password'), PASSWORD_DEFAULT)
                    ]);
                    
                    $this->session->set_flashdata('success', 'Password changed successfully');
                    redirect('profile');
                } else {
                    $this->session->set_flashdata('error', 'Current password is incorrect');
                }
            }
        }
        
        $data['title'] = 'Change Password - Ticket Concert';
        
        $this->load->view('templates/header', $data);
        $this->load->view('profile/change_password', $data);
        $this->load->view('templates/footer');
    }
    
    /**
     * Delete account
     */
    public function delete_account() {
        $user_id = $this->session->userdata('user_id');
        
        if ($this->input->post()) {
            $this->form_validation->set_rules('password', 'Password', 'required');
            
            if ($this->form_validation->run()) {
                $user = $this->User_model->getById($user_id);
                
                if (password_verify($this->input->post('password'), $user->password)) {
                    if ($this->User_model->delete($user_id)) {
                        $this->session->sess_destroy();
                        $this->session->set_flashdata('success', 'Account deleted successfully');
                        redirect('home');
                    } else {
                        $this->session->set_flashdata('error', 'Failed to delete account');
                    }
                } else {
                    $this->session->set_flashdata('error', 'Password is incorrect');
                }
            }
        }
        
        $data['title'] = 'Delete Account - Ticket Concert';
        
        $this->load->view('templates/header', $data);
        $this->load->view('profile/delete_account', $data);
        $this->load->view('templates/footer');
    }
} 