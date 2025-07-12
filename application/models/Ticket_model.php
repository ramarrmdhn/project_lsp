<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ticket_model extends CI_Model {
    
    protected $table = 'tickets';
    
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * Get all tickets
     */
    public function getAll($limit = null, $offset = null) {
        if ($limit) {
            $this->db->limit($limit, $offset);
        }
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get($this->table)->result();
    }
    
    /**
     * Get ticket by ID
     */
    public function getById($id) {
        return $this->db->where('id', $id)->get($this->table)->row();
    }
    
    /**
     * Create new ticket
     */
    public function create($data) {
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    
    /**
     * Update ticket
     */
    public function update($id, $data) {
        $data['updated_at'] = date('Y-m-d H:i:s');
        
        return $this->db->where('id', $id)->update($this->table, $data);
    }
    
    /**
     * Delete ticket
     */
    public function delete($id) {
        return $this->db->where('id', $id)->delete($this->table);
    }
    
    /**
     * Get tickets by concert
     */
    public function getByConcert($concert_id) {
        return $this->db->where('concert_id', $concert_id)
                        ->order_by('price', 'ASC')
                        ->get($this->table)->result();
    }
    
    /**
     * Get available tickets by concert
     */
    public function getAvailableByConcert($concert_id) {
        return $this->db->where('concert_id', $concert_id)
                        ->where('status', 'available')
                        ->where('quantity >', 0)
                        ->order_by('price', 'ASC')
                        ->get($this->table)->result();
    }
    
    /**
     * Get tickets by category
     */
    public function getByCategory($concert_id, $category) {
        return $this->db->where('concert_id', $concert_id)
                        ->where('category', $category)
                        ->where('status', 'available')
                        ->where('quantity >', 0)
                        ->get($this->table)->result();
    }
    
    /**
     * Update ticket quantity
     */
    public function updateQuantity($id, $quantity) {
        return $this->update($id, ['quantity' => $quantity]);
    }
    
    /**
     * Decrease ticket quantity (when sold)
     */
    public function decreaseQuantity($id, $amount = 1) {
        $ticket = $this->getById($id);
        if ($ticket && $ticket->quantity >= $amount) {
            $new_quantity = $ticket->quantity - $amount;
            $status = $new_quantity > 0 ? 'available' : 'sold_out';
            return $this->update($id, [
                'quantity' => $new_quantity,
                'status' => $status
            ]);
        }
        return false;
    }
    
    /**
     * Get ticket count by concert
     */
    public function getCountByConcert($concert_id) {
        return $this->db->where('concert_id', $concert_id)
                        ->count_all_results($this->table);
    }
    
    /**
     * Get available ticket count by concert
     */
    public function getAvailableCountByConcert($concert_id) {
        return $this->db->where('concert_id', $concert_id)
                        ->where('status', 'available')
                        ->where('quantity >', 0)
                        ->count_all_results($this->table);
    }
    
    /**
     * Search tickets
     */
    public function search($keyword) {
        $this->db->like('category', $keyword);
        $this->db->or_like('description', $keyword);
        
        return $this->db->order_by('created_at', 'DESC')
                        ->get($this->table)->result();
    }
    
    /**
     * Get tickets with concert info
     */
    public function getWithConcert($limit = null, $offset = null) {
        $this->db->select('tickets.*, concerts.title as concert_title, concerts.artist, concerts.venue, concerts.date_time')
                 ->from($this->table)
                 ->join('concerts', 'tickets.concert_id = concerts.id', 'left')
                 ->order_by('tickets.created_at', 'DESC');
        
        if ($limit) {
            $this->db->limit($limit, $offset);
        }
        
        return $this->db->get()->result();
    }
    
    /**
     * Get ticket statistics
     */
    public function getStatistics() {
        $stats = [];
        
        // Total tickets
        $stats['total'] = $this->db->count_all_results($this->table);
        
        // Available tickets
        $stats['available'] = $this->db->where('status', 'available')
                                      ->where('quantity >', 0)
                                      ->count_all_results($this->table);
        
        // Sold out tickets
        $stats['sold_out'] = $this->db->where('status', 'sold_out')
                                      ->count_all_results($this->table);
        
        return $stats;
    }
} 