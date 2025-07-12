<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Concert extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model(['Concert_model', 'Ticket_model']);
        $this->load->library(['session', 'form_validation']);
    }
    
    /**
     * List all concerts
     */
    public function index() {
        $data['title'] = 'Concerts - Ticket Concert';
        $data['concerts'] = $this->Concert_model->getActive();
        
        $this->load->view('templates/header', $data);
        $this->load->view('concerts/index', $data);
        $this->load->view('templates/footer');
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
        $data['tickets'] = $this->Ticket_model->getAvailableByConcert($id);
        $data['title'] = $concert->title . ' - Ticket Concert';
        
        $this->load->view('templates/header', $data);
        $this->load->view('concerts/view', $data);
        $this->load->view('templates/footer');
    }
    
    /**
     * Search concerts
     */
    public function search() {
        $keyword = $this->input->get('keyword');
        $artist = $this->input->get('artist');
        $venue = $this->input->get('venue');
        $date_from = $this->input->get('date_from');
        $date_to = $this->input->get('date_to');
        
        $data['concerts'] = [];
        
        if ($keyword) {
            $data['concerts'] = $this->Concert_model->search($keyword);
        } elseif ($artist) {
            $data['concerts'] = $this->Concert_model->getByArtist($artist);
        } elseif ($venue) {
            $data['concerts'] = $this->Concert_model->getByVenue($venue);
        } elseif ($date_from && $date_to) {
            $data['concerts'] = $this->Concert_model->getByDateRange($date_from, $date_to);
        } else {
            $data['concerts'] = $this->Concert_model->getActive();
        }
        
        $data['keyword'] = $keyword;
        $data['artist'] = $artist;
        $data['venue'] = $venue;
        $data['date_from'] = $date_from;
        $data['date_to'] = $date_to;
        $data['title'] = 'Search Results - Ticket Concert';
        
        $this->load->view('templates/header', $data);
        $this->load->view('concerts/search', $data);
        $this->load->view('templates/footer');
    }
    
    /**
     * Get concerts by category
     */
    public function category($category) {
        $data['concerts'] = $this->Concert_model->getByStatus($category);
        $data['category'] = ucfirst($category);
        $data['title'] = ucfirst($category) . ' Concerts - Ticket Concert';
        
        $this->load->view('templates/header', $data);
        $this->load->view('concerts/category', $data);
        $this->load->view('templates/footer');
    }
    
    /**
     * Get upcoming concerts
     */
    public function upcoming() {
        $data['concerts'] = $this->Concert_model->getUpcoming();
        $data['title'] = 'Upcoming Concerts - Ticket Concert';
        
        $this->load->view('templates/header', $data);
        $this->load->view('concerts/upcoming', $data);
        $this->load->view('templates/footer');
    }
    
    /**
     * Get popular concerts
     */
    public function popular() {
        $data['concerts'] = $this->Concert_model->getPopular(20);
        $data['title'] = 'Popular Concerts - Ticket Concert';
        
        $this->load->view('templates/header', $data);
        $this->load->view('concerts/popular', $data);
        $this->load->view('templates/footer');
    }
    
    /**
     * Get concerts by artist
     */
    public function artist($artist_name) {
        $data['concerts'] = $this->Concert_model->getByArtist($artist_name);
        $data['artist'] = $artist_name;
        $data['title'] = $artist_name . ' Concerts - Ticket Concert';
        
        $this->load->view('templates/header', $data);
        $this->load->view('concerts/artist', $data);
        $this->load->view('templates/footer');
    }
    
    /**
     * Get concerts by venue
     */
    public function venue($venue_name) {
        $data['concerts'] = $this->Concert_model->getByVenue($venue_name);
        $data['venue'] = $venue_name;
        $data['title'] = 'Concerts at ' . $venue_name . ' - Ticket Concert';
        
        $this->load->view('templates/header', $data);
        $this->load->view('concerts/venue', $data);
        $this->load->view('templates/footer');
    }
    
    /**
     * Get concert tickets (AJAX)
     */
    public function get_tickets($concert_id) {
        $tickets = $this->Ticket_model->getAvailableByConcert($concert_id);
        echo json_encode($tickets);
    }
    
    /**
     * Get ticket details (AJAX)
     */
    public function get_ticket($ticket_id) {
        $ticket = $this->Ticket_model->getById($ticket_id);
        echo json_encode($ticket);
    }
} 