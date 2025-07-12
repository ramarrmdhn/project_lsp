<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BandTrokan extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model(['Concert_model', 'Ticket_model', 'Cart_model']);
        $this->load->library(['session', 'form_validation']);
    }
    
    /**
     * Halaman detail konser Band Trokan
     */
    public function index() {
        $data['title'] = 'Band Trokan Live in Concert - Ticket Concert';
        
        // Data konser Band Trokan
        $data['concert'] = (object) [
            'id' => 1,
            'title' => 'Band Trokan Live in Concert',
            'artist' => 'Band Trokan',
            'venue' => 'Gelora Bung Karno, Jakarta',
            'date_time' => '2024-06-15 19:00:00',
            'status' => 'active',
            'available_tickets' => 500,
            'capacity' => 80000,
            'description' => 'Nikmati pengalaman musik yang tak terlupakan bersama Band Trokan dalam konser live mereka yang spektakuler!',
            'image' => 'band_trokan.jpg'
        ];
        
        // Data tiket
        $data['tickets'] = [
            (object) [
                'id' => 'vip',
                'category' => 'VIP',
                'description' => 'Area terdepan, akses eksklusif, merchandise gratis',
                'price' => 1500000,
                'available' => 100
            ],
            (object) [
                'id' => 'regular',
                'category' => 'Regular',
                'description' => 'Area tengah, pengalaman musik yang nyaman',
                'price' => 800000,
                'available' => 300
            ],
            (object) [
                'id' => 'economy',
                'category' => 'Economy',
                'description' => 'Area belakang, harga terjangkau',
                'price' => 500000,
                'available' => 100
            ]
        ];
        
        $this->load->view('templates/header', $data);
        $this->load->view('concerts/band_trokan', $data);
        $this->load->view('templates/footer');
    }
    
    /**
     * Menambahkan tiket ke keranjang
     */
    public function add_to_cart() {
        // Validasi input
        $this->form_validation->set_rules('tickets[vip]', 'VIP Tickets', 'numeric|greater_than_equal_to[0]');
        $this->form_validation->set_rules('tickets[regular]', 'Regular Tickets', 'numeric|greater_than_equal_to[0]');
        $this->form_validation->set_rules('tickets[economy]', 'Economy Tickets', 'numeric|greater_than_equal_to[0]');
        
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', 'Silakan pilih jumlah tiket yang valid.');
            redirect('band-trokan');
        }
        
        $tickets = $this->input->post('tickets');
        $total_tickets = 0;
        
        // Hitung total tiket
        foreach ($tickets as $type => $quantity) {
            $total_tickets += intval($quantity);
        }
        
        if ($total_tickets == 0) {
            $this->session->set_flashdata('error', 'Silakan pilih minimal 1 tiket.');
            redirect('band-trokan');
        }
        
        // Simpan ke keranjang
        $cart_data = [
            'concert_id' => 1,
            'concert_title' => 'Band Trokan Live in Concert',
            'artist' => 'Band Trokan',
            'venue' => 'Gelora Bung Karno, Jakarta',
            'concert_date' => '2024-06-15 19:00:00',
            'tickets' => $tickets,
            'total_tickets' => $total_tickets
        ];
        
        $this->session->set_userdata('band_trokan_cart', $cart_data);
        $this->session->set_flashdata('success', 'Tiket berhasil ditambahkan ke keranjang!');
        redirect('cart');
    }
    
    /**
     * Halaman pembayaran
     */
    public function checkout() {
        if (!$this->session->userdata('user_id')) {
            $this->session->set_flashdata('error', 'Silakan login terlebih dahulu untuk melanjutkan pembayaran.');
            redirect('login');
        }
        
        $cart_data = $this->session->userdata('band_trokan_cart');
        if (!$cart_data) {
            redirect('band-trokan');
        }
        
        $data['title'] = 'Pembayaran - Band Trokan Concert';
        $data['cart_data'] = $cart_data;
        
        $this->load->view('templates/header', $data);
        $this->load->view('band_trokan/checkout', $data);
        $this->load->view('templates/footer');
    }
    
    /**
     * Proses pembayaran
     */
    public function process_payment() {
        if (!$this->session->userdata('user_id')) {
            redirect('login');
        }
        
        $this->form_validation->set_rules('payment_method', 'Metode Pembayaran', 'required');
        $this->form_validation->set_rules('delivery_method', 'Metode Pengiriman', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', 'Silakan pilih metode pembayaran dan pengiriman.');
            redirect('band-trokan/checkout');
        }
        
        $cart_data = $this->session->userdata('band_trokan_cart');
        if (!$cart_data) {
            redirect('band-trokan');
        }
        
        // Proses pembayaran (simulasi)
        $payment_data = [
            'user_id' => $this->session->userdata('user_id'),
            'concert_id' => 1,
            'payment_method' => $this->input->post('payment_method'),
            'delivery_method' => $this->input->post('delivery_method'),
            'total_amount' => $this->calculate_total($cart_data['tickets']),
            'status' => 'pending'
        ];
        
        // Simpan order (simulasi)
        $order_id = 'TRK' . date('Ymd') . rand(1000, 9999);
        
        $this->session->set_flashdata('success', 'Pembayaran berhasil! Order ID: ' . $order_id);
        $this->session->unset_userdata('band_trokan_cart');
        
        redirect('orders/success/' . $order_id);
    }
    
    /**
     * Hitung total harga
     */
    private function calculate_total($tickets) {
        $prices = [
            'vip' => 1500000,
            'regular' => 800000,
            'economy' => 500000
        ];
        
        $total = 0;
        foreach ($tickets as $type => $quantity) {
            $total += intval($quantity) * $prices[$type];
        }
        
        return $total;
    }
} 