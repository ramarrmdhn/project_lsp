<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Concert_model extends CI_Model {
    
    protected $table = 'concerts';
    
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * Get all concerts
     */
    public function getAll($limit = null, $offset = null) {
        if ($limit) {
            $this->db->limit($limit, $offset);
        }
        $this->db->order_by('date_time', 'ASC');
        return $this->db->get($this->table)->result();
    }
    
    /**
     * Get concert by ID
     */
    public function getById($id) {
        return $this->db->where('id', $id)->get($this->table)->row();
    }
    
    /**
     * Create new concert
     */
    public function create($data) {
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    
    /**
     * Update concert
     */
    public function update($id, $data) {
        $data['updated_at'] = date('Y-m-d H:i:s');
        
        return $this->db->where('id', $id)->update($this->table, $data);
    }
    
    /**
     * Delete concert
     */
    public function delete($id) {
        return $this->db->where('id', $id)->delete($this->table);
    }
    
    /**
     * Get active concerts
     */
    public function getActive() {
        return $this->db->where('status', 'active')
                        ->where('date_time >=', date('Y-m-d H:i:s'))
                        ->order_by('date_time', 'ASC')
                        ->get($this->table)->result();
    }
    
    /**
     * Get upcoming concerts
     */
    public function getUpcoming() {
        return $this->db->where('status', 'upcoming')
                        ->where('date_time >=', date('Y-m-d H:i:s'))
                        ->order_by('date_time', 'ASC')
                        ->get($this->table)->result();
    }
    
    /**
     * Get concerts by status
     */
    public function getByStatus($status) {
        return $this->db->where('status', $status)
                        ->order_by('date_time', 'ASC')
                        ->get($this->table)->result();
    }
    
    /**
     * Search concerts
     */
    public function search($keyword) {
        $this->db->like('title', $keyword);
        $this->db->or_like('artist', $keyword);
        $this->db->or_like('venue', $keyword);
        $this->db->or_like('description', $keyword);
        
        return $this->db->order_by('date_time', 'ASC')
                        ->get($this->table)->result();
    }
    
    /**
     * Get concerts by date range
     */
    public function getByDateRange($start_date, $end_date) {
        return $this->db->where('date_time >=', $start_date)
                        ->where('date_time <=', $end_date)
                        ->order_by('date_time', 'ASC')
                        ->get($this->table)->result();
    }
    
    /**
     * Get concerts by artist
     */
    public function getByArtist($artist) {
        return $this->db->like('artist', $artist)
                        ->order_by('date_time', 'ASC')
                        ->get($this->table)->result();
    }
    
    /**
     * Get concerts by venue
     */
    public function getByVenue($venue) {
        return $this->db->like('venue', $venue)
                        ->order_by('date_time', 'ASC')
                        ->get($this->table)->result();
    }
    
    /**
     * Update concert status
     */
    public function updateStatus($id, $status) {
        return $this->update($id, ['status' => $status]);
    }
    
    /**
     * Get concert count
     */
    public function getCount($where = []) {
        if (!empty($where)) {
            $this->db->where($where);
        }
        return $this->db->count_all_results($this->table);
    }
    
    /**
     * Get concerts with tickets
     */
    public function getWithTickets() {
        $this->db->select('concerts.*, COUNT(tickets.id) as ticket_count')
                 ->from($this->table)
                 ->join('tickets', 'concerts.id = tickets.concert_id', 'left')
                 ->group_by('concerts.id')
                 ->order_by('concerts.date_time', 'ASC');
        
        return $this->db->get()->result();
    }
    
    /**
     * Get popular concerts (by ticket sales)
     */
    public function getPopular($limit = 10) {
        $this->db->select('concerts.*, SUM(order_items.quantity) as total_sold')
                 ->from($this->table)
                 ->join('tickets', 'concerts.id = tickets.concert_id', 'left')
                 ->join('order_items', 'tickets.id = order_items.ticket_id', 'left')
                 ->join('orders', 'order_items.order_id = orders.id', 'left')
                 ->where('orders.status', 'paid')
                 ->group_by('concerts.id')
                 ->order_by('total_sold', 'DESC')
                 ->limit($limit);
        
        return $this->db->get()->result();
    }
} 