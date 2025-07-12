<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_concert extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model(['Concert_model', 'Ticket_model']);
        $this->load->library(['session', 'form_validation']);
        
        // Check if user is logged in and is admin
        if (!$this->session->userdata('user_id') || $this->session->userdata('role') !== 'admin') {
            redirect('auth/login');
        }
    }
    
    /**
     * List all concerts
     */
    public function index() {
        $data['concerts'] = $this->Concert_model->getAll();
        $data['title'] = 'Manage Concerts - Admin';
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/concerts/index', $data);
        $this->load->view('admin/templates/footer');
    }
    
    /**
     * Add new concert
     */
    public function add() {
        if ($this->input->post()) {
            $this->form_validation->set_rules('title', 'Title', 'required');
            $this->form_validation->set_rules('artist', 'Artist', 'required');
            $this->form_validation->set_rules('venue', 'Venue', 'required');
            $this->form_validation->set_rules('date_time', 'Date & Time', 'required');
            $this->form_validation->set_rules('description', 'Description', 'required');
            $this->form_validation->set_rules('status', 'Status', 'required');
            
            if ($this->form_validation->run()) {
                $concert_data = [
                    'title' => $this->input->post('title'),
                    'artist' => $this->input->post('artist'),
                    'venue' => $this->input->post('venue'),
                    'date_time' => $this->input->post('date_time'),
                    'description' => $this->input->post('description'),
                    'status' => $this->input->post('status'),
                    'image' => $this->input->post('image'),
                    'capacity' => $this->input->post('capacity'),
                    'price_range' => $this->input->post('price_range')
                ];
                
                $concert_id = $this->Concert_model->create($concert_data);
                
                if ($concert_id) {
                    $this->session->set_flashdata('success', 'Concert added successfully');
                    redirect('admin_concert');
                } else {
                    $this->session->set_flashdata('error', 'Failed to add concert');
                }
            }
        }
        
        $data['title'] = 'Add Concert - Admin';
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/concerts/add', $data);
        $this->load->view('admin/templates/footer');
    }
    
    /**
     * Edit concert
     */
    public function edit($id) {
        $concert = $this->Concert_model->getById($id);
        
        if (!$concert) {
            show_404();
        }
        
        if ($this->input->post()) {
            $this->form_validation->set_rules('title', 'Title', 'required');
            $this->form_validation->set_rules('artist', 'Artist', 'required');
            $this->form_validation->set_rules('venue', 'Venue', 'required');
            $this->form_validation->set_rules('date_time', 'Date & Time', 'required');
            $this->form_validation->set_rules('description', 'Description', 'required');
            $this->form_validation->set_rules('status', 'Status', 'required');
            
            if ($this->form_validation->run()) {
                $concert_data = [
                    'title' => $this->input->post('title'),
                    'artist' => $this->input->post('artist'),
                    'venue' => $this->input->post('venue'),
                    'date_time' => $this->input->post('date_time'),
                    'description' => $this->input->post('description'),
                    'status' => $this->input->post('status'),
                    'image' => $this->input->post('image'),
                    'capacity' => $this->input->post('capacity'),
                    'price_range' => $this->input->post('price_range')
                ];
                
                if ($this->Concert_model->update($id, $concert_data)) {
                    $this->session->set_flashdata('success', 'Concert updated successfully');
                    redirect('admin_concert');
                } else {
                    $this->session->set_flashdata('error', 'Failed to update concert');
                }
            }
        }
        
        $data['concert'] = $concert;
        $data['title'] = 'Edit Concert - Admin';
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/concerts/edit', $data);
        $this->load->view('admin/templates/footer');
    }
    
    /**
     * Delete concert
     */
    public function delete($id) {
        $concert = $this->Concert_model->getById($id);
        
        if (!$concert) {
            $this->session->set_flashdata('error', 'Concert not found');
            redirect('admin_concert');
        }
        
        // Check if concert has tickets
        $tickets = $this->Ticket_model->getByConcert($id);
        if (!empty($tickets)) {
            $this->session->set_flashdata('error', 'Cannot delete concert with existing tickets');
            redirect('admin_concert');
        }
        
        if ($this->Concert_model->delete($id)) {
            $this->session->set_flashdata('success', 'Concert deleted successfully');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete concert');
        }
        
        redirect('admin_concert');
    }
    
    /**
     * View concert details
     */
    public function view($id) {
        $concert = $this->Concert_model->getById($id);
        
        if (!$concert) {
            show_404();
        }
        
        $data['concert'] = $concert;
        $data['tickets'] = $this->Ticket_model->getByConcert($id);
        $data['title'] = 'Concert Details - Admin';
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/concerts/view', $data);
        $this->load->view('admin/templates/footer');
    }
    
    /**
     * Manage tickets for a concert
     */
    public function tickets($concert_id) {
        $concert = $this->Concert_model->getById($concert_id);
        
        if (!$concert) {
            show_404();
        }
        
        $data['concert'] = $concert;
        $data['tickets'] = $this->Ticket_model->getByConcert($concert_id);
        $data['title'] = 'Manage Tickets - ' . $concert->title;
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/concerts/tickets', $data);
        $this->load->view('admin/templates/footer');
    }
    
    /**
     * Add ticket to concert
     */
    public function add_ticket($concert_id) {
        $concert = $this->Concert_model->getById($concert_id);
        
        if (!$concert) {
            show_404();
        }
        
        if ($this->input->post()) {
            $this->form_validation->set_rules('category', 'Category', 'required');
            $this->form_validation->set_rules('price', 'Price', 'required|numeric');
            $this->form_validation->set_rules('quantity', 'Quantity', 'required|numeric');
            $this->form_validation->set_rules('description', 'Description', 'required');
            
            if ($this->form_validation->run()) {
                $ticket_data = [
                    'concert_id' => $concert_id,
                    'category' => $this->input->post('category'),
                    'price' => $this->input->post('price'),
                    'quantity' => $this->input->post('quantity'),
                    'description' => $this->input->post('description'),
                    'status' => 'available'
                ];
                
                if ($this->Ticket_model->create($ticket_data)) {
                    $this->session->set_flashdata('success', 'Ticket added successfully');
                    redirect('admin_concert/tickets/' . $concert_id);
                } else {
                    $this->session->set_flashdata('error', 'Failed to add ticket');
                }
            }
        }
        
        $data['concert'] = $concert;
        $data['title'] = 'Add Ticket - ' . $concert->title;
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/concerts/add_ticket', $data);
        $this->load->view('admin/templates/footer');
    }
    
    /**
     * Edit ticket
     */
    public function edit_ticket($ticket_id) {
        $ticket = $this->Ticket_model->getById($ticket_id);
        
        if (!$ticket) {
            show_404();
        }
        
        if ($this->input->post()) {
            $this->form_validation->set_rules('category', 'Category', 'required');
            $this->form_validation->set_rules('price', 'Price', 'required|numeric');
            $this->form_validation->set_rules('quantity', 'Quantity', 'required|numeric');
            $this->form_validation->set_rules('description', 'Description', 'required');
            
            if ($this->form_validation->run()) {
                $ticket_data = [
                    'category' => $this->input->post('category'),
                    'price' => $this->input->post('price'),
                    'quantity' => $this->input->post('quantity'),
                    'description' => $this->input->post('description'),
                    'status' => $this->input->post('status')
                ];
                
                if ($this->Ticket_model->update($ticket_id, $ticket_data)) {
                    $this->session->set_flashdata('success', 'Ticket updated successfully');
                    redirect('admin_concert/tickets/' . $ticket->concert_id);
                } else {
                    $this->session->set_flashdata('error', 'Failed to update ticket');
                }
            }
        }
        
        $data['ticket'] = $ticket;
        $data['concert'] = $this->Concert_model->getById($ticket->concert_id);
        $data['title'] = 'Edit Ticket - Admin';
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/concerts/edit_ticket', $data);
        $this->load->view('admin/templates/footer');
    }
    
    /**
     * Delete ticket
     */
    public function delete_ticket($ticket_id) {
        $ticket = $this->Ticket_model->getById($ticket_id);
        
        if (!$ticket) {
            $this->session->set_flashdata('error', 'Ticket not found');
            redirect('admin_concert');
        }
        
        if ($this->Ticket_model->delete($ticket_id)) {
            $this->session->set_flashdata('success', 'Ticket deleted successfully');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete ticket');
        }
        
        redirect('admin_concert/tickets/' . $ticket->concert_id);
    }
    
    /**
     * Update concert status
     */
    public function update_status($id, $status) {
        $concert = $this->Concert_model->getById($id);
        
        if (!$concert) {
            $this->session->set_flashdata('error', 'Concert not found');
            redirect('admin_concert');
        }
        
        if ($this->Concert_model->updateStatus($id, $status)) {
            $this->session->set_flashdata('success', 'Concert status updated successfully');
        } else {
            $this->session->set_flashdata('error', 'Failed to update concert status');
        }
        
        redirect('admin_concert');
    }
} 