<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model(['Order_model', 'Order_item_model']);
        $this->load->library(['session', 'form_validation']);
    }
    
    /**
     * Halaman sukses pembayaran
     */
    public function success($order_id = null) {
        if (!$this->session->userdata('user_id')) {
            redirect('login');
        }
        
        if (!$order_id) {
            redirect('dashboard');
        }
        
        $data['title'] = 'Pembayaran Berhasil - Ticket Concert';
        $data['order_id'] = $order_id;
        
        $this->load->view('templates/header', $data);
        $this->load->view('orders/success', $data);
        $this->load->view('templates/footer');
    }
    
    /**
     * Halaman daftar pesanan
     */
    public function index() {
        if (!$this->session->userdata('user_id')) {
            redirect('login');
        }
        
        $data['title'] = 'Pesanan Saya - Ticket Concert';
        $data['orders'] = $this->Order_model->get_orders_by_user($this->session->userdata('user_id'));
        
        $this->load->view('templates/header', $data);
        $this->load->view('orders/index', $data);
        $this->load->view('templates/footer');
    }
    
    /**
     * Detail pesanan
     */
    public function view($order_id) {
        if (!$this->session->userdata('user_id')) {
            redirect('login');
        }
        
        $data['title'] = 'Detail Pesanan - Ticket Concert';
        $data['order'] = $this->Order_model->get_order_by_id($order_id);
        
        if (!$data['order'] || $data['order']->user_id != $this->session->userdata('user_id')) {
            $this->session->set_flashdata('error', 'Pesanan tidak ditemukan.');
            redirect('orders');
        }
        
        $data['order_items'] = $this->Order_item_model->get_items_by_order($order_id);
        
        $this->load->view('templates/header', $data);
        $this->load->view('orders/view', $data);
        $this->load->view('templates/footer');
    }
    
    /**
     * Download tiket
     */
    public function download_ticket($order_id) {
        if (!$this->session->userdata('user_id')) {
            redirect('login');
        }
        
        $order = $this->Order_model->get_order_by_id($order_id);
        
        if (!$order || $order->user_id != $this->session->userdata('user_id')) {
            $this->session->set_flashdata('error', 'Pesanan tidak ditemukan.');
            redirect('orders');
        }
        
        // Generate PDF ticket (simulasi)
        $this->load->library('pdf');
        
        $data['order'] = $order;
        $data['order_items'] = $this->Order_item_model->get_items_by_order($order_id);
        
        $html = $this->load->view('orders/ticket_pdf', $data, true);
        
        $this->pdf->loadHtml($html);
        $this->pdf->setPaper('A4', 'portrait');
        $this->pdf->render();
        
        $filename = 'ticket_' . $order_id . '.pdf';
        $this->pdf->stream($filename, array('Attachment' => 0));
    }
} 