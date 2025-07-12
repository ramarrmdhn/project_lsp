<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library(['session', 'form_validation']);
    }
    
    /**
     * Login page
     */
    public function login() {
        // Redirect if already logged in
        if ($this->session->userdata('user_id')) {
            redirect('home/dashboard');
        }
        
        if ($this->input->post()) {
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'required');
            
            if ($this->form_validation->run()) {
                $email = $this->input->post('email');
                $password = $this->input->post('password');
                
                $user = $this->User_model->authenticate($email, $password);
                
                if ($user) {
                    if ($user->status === 'blocked') {
                        $this->session->set_flashdata('error', 'Your account has been blocked. Please contact administrator.');
                        redirect('auth/login');
                    }
                    
                    // Set session data
                    $this->session->set_userdata([
                        'user_id' => $user->id,
                        'username' => $user->username,
                        'email' => $user->email,
                        'role' => $user->role,
                        'full_name' => $user->full_name
                    ]);
                    
                    // Redirect based on role
                    if ($user->role === 'admin') {
                        redirect('admin/dashboard');
                    } else {
                        redirect('home/dashboard');
                    }
                } else {
                    $this->session->set_flashdata('error', 'Invalid email or password.');
                    redirect('auth/login');
                }
            }
        }
        
        $data['title'] = 'Login - Ticket Concert';
        $this->load->view('auth/login', $data);
    }
    
    /**
     * Register page
     */
    public function register() {
        // Redirect if already logged in
        if ($this->session->userdata('user_id')) {
            redirect('home/dashboard');
        }
        
        if ($this->input->post()) {
            $this->form_validation->set_rules('username', 'Username', 'required|min_length[3]|max_length[50]|is_unique[users.username]');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
            $this->form_validation->set_rules('full_name', 'Full Name', 'required');
            $this->form_validation->set_rules('phone', 'Phone', 'required');
            
            if ($this->form_validation->run()) {
                $user_data = [
                    'username' => $this->input->post('username'),
                    'email' => $this->input->post('email'),
                    'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                    'full_name' => $this->input->post('full_name'),
                    'phone' => $this->input->post('phone'),
                    'address' => $this->input->post('address'),
                    'role' => 'user',
                    'status' => 'active'
                ];
                
                $user_id = $this->User_model->create($user_data);
                
                if ($user_id) {
                    // Auto login after registration
                    $user = $this->User_model->getById($user_id);
                    $this->session->set_userdata([
                        'user_id' => $user->id,
                        'username' => $user->username,
                        'email' => $user->email,
                        'role' => $user->role,
                        'full_name' => $user->full_name
                    ]);
                    
                    $this->session->set_flashdata('success', 'Registration successful! Welcome to Ticket Concert.');
                    redirect('home/dashboard');
                } else {
                    $this->session->set_flashdata('error', 'Registration failed. Please try again.');
                    redirect('auth/register');
                }
            }
        }
        
        $data['title'] = 'Register - Ticket Concert';
        $this->load->view('auth/register', $data);
    }
    
    /**
     * Logout
     */
    public function logout() {
        $this->session->sess_destroy();
        redirect('home');
    }
    
    /**
     * Forgot password
     */
    public function forgot_password() {
        if ($this->input->post()) {
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            
            if ($this->form_validation->run()) {
                $email = $this->input->post('email');
                $user = $this->User_model->getByEmail($email);
                
                if ($user) {
                    // Generate reset token
                    $reset_token = bin2hex(random_bytes(32));
                    $reset_expires = date('Y-m-d H:i:s', strtotime('+1 hour'));
                    
                    $this->User_model->update($user->id, [
                        'reset_token' => $reset_token,
                        'reset_expires' => $reset_expires
                    ]);
                    
                    // Send reset email (implement email functionality)
                    $this->session->set_flashdata('success', 'Password reset instructions have been sent to your email.');
                    redirect('auth/login');
                } else {
                    $this->session->set_flashdata('error', 'Email not found in our system.');
                    redirect('auth/forgot_password');
                }
            }
        }
        
        $data['title'] = 'Forgot Password - Ticket Concert';
        $this->load->view('auth/forgot_password', $data);
    }
    
    /**
     * Reset password
     */
    public function reset_password($token = null) {
        if (!$token) {
            redirect('auth/login');
        }
        
        $user = $this->db->where('reset_token', $token)
                         ->where('reset_expires >', date('Y-m-d H:i:s'))
                         ->get('users')->row();
        
        if (!$user) {
            $this->session->set_flashdata('error', 'Invalid or expired reset token.');
            redirect('auth/login');
        }
        
        if ($this->input->post()) {
            $this->form_validation->set_rules('password', 'New Password', 'required|min_length[6]');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
            
            if ($this->form_validation->run()) {
                $this->User_model->update($user->id, [
                    'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                    'reset_token' => null,
                    'reset_expires' => null
                ]);
                
                $this->session->set_flashdata('success', 'Password has been reset successfully. You can now login.');
                redirect('auth/login');
            }
        }
        
        $data['title'] = 'Reset Password - Ticket Concert';
        $data['token'] = $token;
        $this->load->view('auth/reset_password', $data);
    }
    
    /**
     * Check if email exists (AJAX)
     */
    public function check_email() {
        $email = $this->input->post('email');
        $exists = $this->User_model->emailExists($email);
        
        echo json_encode(['exists' => $exists]);
    }
    
    /**
     * Check if username exists (AJAX)
     */
    public function check_username() {
        $username = $this->input->post('username');
        $exists = $this->User_model->usernameExists($username);
        
        echo json_encode(['exists' => $exists]);
    }
} 