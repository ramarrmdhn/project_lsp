<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_item_model extends CI_Model {
    
    protected $table = 'order_items';
    
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * Get all order items
     */
    public function getAll($limit = null, $offset = null) {
        if ($limit) {
            $this->db->limit($limit, $offset);
        }
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get($this->table)->result();
    }
    
    /**
     * Get order item by ID
     */
    public function getById($id) {
        return $this->db->where('id', $id)->get($this->table)->row();
    }
    
    /**
     * Create new order item
     */
    public function create($data) {
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    
    /**
     * Update order item
     */
    public function update($id, $data) {
        $data['updated_at'] = date('Y-m-d H:i:s');
        
        return $this->db->where('id', $id)->update($this->table, $data);
    }
    
    /**
     * Delete order item
     */
    public function delete($id) {
        return $this->db->where('id', $id)->delete($this->table);
    }
    
    /**
     * Get order items by order
     */
    public function getByOrder($order_id) {
        return $this->db->where('order_id', $order_id)
                        ->order_by('created_at', 'ASC')
                        ->get($this->table)->result();
    }
    
    /**
     * Get order items with ticket info
     */
    public function getWithTicket($order_id) {
        $this->db->select('order_items.*, tickets.category, tickets.description, tickets.price as ticket_price')
                 ->from($this->table)
                 ->join('tickets', 'order_items.ticket_id = tickets.id', 'left')
                 ->where('order_items.order_id', $order_id)
                 ->order_by('order_items.created_at', 'ASC');
        
        return $this->db->get()->result();
    }
    
    /**
     * Get order items with concert info
     */
    public function getWithConcert($order_id) {
        $this->db->select('order_items.*, tickets.category, tickets.description, tickets.price as ticket_price, concerts.title as concert_title, concerts.artist, concerts.venue, concerts.date_time')
                 ->from($this->table)
                 ->join('tickets', 'order_items.ticket_id = tickets.id', 'left')
                 ->join('concerts', 'tickets.concert_id = concerts.id', 'left')
                 ->where('order_items.order_id', $order_id)
                 ->order_by('order_items.created_at', 'ASC');
        
        return $this->db->get()->result();
    }
    
    /**
     * Get order items by ticket
     */
    public function getByTicket($ticket_id) {
        return $this->db->where('ticket_id', $ticket_id)
                        ->order_by('created_at', 'DESC')
                        ->get($this->table)->result();
    }
    
    /**
     * Get total quantity sold for a ticket
     */
    public function getTotalSold($ticket_id) {
        $result = $this->db->select_sum('quantity')
                           ->where('ticket_id', $ticket_id)
                           ->get($this->table)->row();
        return $result ? $result->quantity : 0;
    }
    
    /**
     * Get order items statistics
     */
    public function getStatistics() {
        $stats = [];
        
        // Total items sold
        $result = $this->db->select_sum('quantity')->get($this->table)->row();
        $stats['total_items'] = $result ? $result->quantity : 0;
        
        // Total revenue
        $result = $this->db->select_sum('subtotal')->get($this->table)->row();
        $stats['total_revenue'] = $result ? $result->subtotal : 0;
        
        return $stats;
    }
    
    /**
     * Get best selling tickets
     */
    public function getBestSelling($limit = 10) {
        $this->db->select('tickets.category, tickets.description, SUM(order_items.quantity) as total_sold, SUM(order_items.subtotal) as total_revenue')
                 ->from($this->table)
                 ->join('tickets', 'order_items.ticket_id = tickets.id', 'left')
                 ->group_by('tickets.id')
                 ->order_by('total_sold', 'DESC')
                 ->limit($limit);
        
        return $this->db->get()->result();
    }
    
    /**
     * Get order items by date range
     */
    public function getByDateRange($start_date, $end_date) {
        return $this->db->where('created_at >=', $start_date)
                        ->where('created_at <=', $end_date)
                        ->order_by('created_at', 'DESC')
                        ->get($this->table)->result();
    }
} 