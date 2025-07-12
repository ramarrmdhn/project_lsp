<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model(['Concert_model', 'User_model']);
        $this->load->library(['session', 'form_validation']);
    }
    
    /**
     * Homepage - List all concerts
     */
    public function index() {
        $data['title'] = 'Home - Ticket Concert';
        $data['concerts'] = $this->Concert_model->getActive();
        $data['upcoming'] = $this->Concert_model->getUpcoming();
        $data['popular'] = $this->Concert_model->getPopular(5);
        
        $this->load->view('templates/header', $data);
        $this->load->view('home/index', $data);
        $this->load->view('templates/footer');
    }
    
    /**
     * Search concerts
     */
    public function search() {
        $keyword = $this->input->get('keyword');
        
        if ($keyword) {
            $data['concerts'] = $this->Concert_model->search($keyword);
            $data['keyword'] = $keyword;
        } else {
            $data['concerts'] = $this->Concert_model->getActive();
            $data['keyword'] = '';
        }
        
        $data['title'] = 'Search Results - Ticket Concert';
        
        $this->load->view('templates/header', $data);
        $this->load->view('home/search', $data);
        $this->load->view('templates/footer');
    }
    
    /**
     * User dashboard (after login)
     */
    public function dashboard() {
        // Check if user is logged in
        if (!$this->session->userdata('user_id')) {
            redirect('auth/login');
        }
        
        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->User_model->getById($user_id);
        $data['title'] = 'Dashboard - Ticket Concert';
        
        // Load order model to get user orders
        $this->load->model('Order_model');
        $data['recent_orders'] = $this->Order_model->getByUser($user_id, 5);
        
        $this->load->view('templates/header', $data);
        $this->load->view('home/dashboard', $data);
        $this->load->view('templates/footer');
    }
    
    /**
     * About page
     */
    public function about() {
        $data['title'] = 'About Us - Ticket Concert';
        
        $this->load->view('templates/header', $data);
        $this->load->view('home/about', $data);
        $this->load->view('templates/footer');
    }
    
    /**
     * Contact page
     */
    public function contact() {
        $data['title'] = 'Contact Us - Ticket Concert';
        
        if ($this->input->post()) {
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('subject', 'Subject', 'required');
            $this->form_validation->set_rules('message', 'Message', 'required');
            
            if ($this->form_validation->run()) {
                // Send email (implement email functionality)
                $this->session->set_flashdata('success', 'Your message has been sent successfully!');
                redirect('home/contact');
            }
        }
        
        $this->load->view('templates/header', $data);
        $this->load->view('home/contact', $data);
        $this->load->view('templates/footer');
    }
    
    /**
     * Terms and conditions
     */
    public function terms() {
        $data['title'] = 'Terms & Conditions - Ticket Concert';
        
        $this->load->view('templates/header', $data);
        $this->load->view('home/terms', $data);
        $this->load->view('templates/footer');
    }
    
    /**
     * Privacy policy
     */
    public function privacy() {
        $data['title'] = 'Privacy Policy - Ticket Concert';
        
        $this->load->view('templates/header', $data);
        $this->load->view('home/privacy', $data);
        $this->load->view('templates/footer');
    }
    
    /**
     * FAQ page
     */
    public function faq() {
        $data['title'] = 'FAQ - Ticket Concert';
        
        $this->load->view('templates/header', $data);
        $this->load->view('home/faq', $data);
        $this->load->view('templates/footer');
    }
} 