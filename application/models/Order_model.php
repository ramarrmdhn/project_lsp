<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_model extends CI_Model {
    
    protected $table = 'orders';
    
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * Get all orders
     */
    public function getAll($limit = null, $offset = null) {
        if ($limit) {
            $this->db->limit($limit, $offset);
        }
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get($this->table)->result();
    }
    
    /**
     * Get order by ID
     */
    public function getById($id) {
        return $this->db->where('id', $id)->get($this->table)->row();
    }
    
    /**
     * Create new order
     */
    public function create($data) {
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    
    /**
     * Update order
     */
    public function update($id, $data) {
        $data['updated_at'] = date('Y-m-d H:i:s');
        
        return $this->db->where('id', $id)->update($this->table, $data);
    }
    
    /**
     * Delete order
     */
    public function delete($id) {
        return $this->db->where('id', $id)->delete($this->table);
    }
    
    /**
     * Get orders by user
     */
    public function getByUser($user_id, $limit = null) {
        $this->db->where('user_id', $user_id);
        if ($limit) {
            $this->db->limit($limit);
        }
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get($this->table)->result();
    }
    
    /**
     * Get orders by status
     */
    public function getByStatus($status, $limit = null) {
        $this->db->where('status', $status);
        if ($limit) {
            $this->db->limit($limit);
        }
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get($this->table)->result();
    }
    
    /**
     * Get order with items
     */
    public function getWithItems($order_id) {
        $order = $this->getById($order_id);
        if ($order) {
            $this->load->model('Order_item_model');
            $order->items = $this->Order_item_model->getByOrder($order_id);
        }
        return $order;
    }
    
    /**
     * Get orders with user info
     */
    public function getWithUser($limit = null, $offset = null) {
        $this->db->select('orders.*, users.username, users.full_name, users.email')
                 ->from($this->table)
                 ->join('users', 'orders.user_id = users.id', 'left')
                 ->order_by('orders.created_at', 'DESC');
        
        if ($limit) {
            $this->db->limit($limit, $offset);
        }
        
        return $this->db->get()->result();
    }
    
    /**
     * Update order status
     */
    public function updateStatus($id, $status) {
        return $this->update($id, ['status' => $status]);
    }
    
    /**
     * Get order count by status
     */
    public function getCountByStatus($status) {
        return $this->db->where('status', $status)
                        ->count_all_results($this->table);
    }
    
    /**
     * Get total sales amount
     */
    public function getTotalSales($where = []) {
        if (!empty($where)) {
            $this->db->where($where);
        }
        $this->db->where('status', 'paid');
        $result = $this->db->select_sum('total_amount')
                           ->get($this->table)->row();
        return $result ? $result->total_amount : 0;
    }
    
    /**
     * Get order statistics
     */
    public function getStatistics() {
        $stats = [];
        
        // Total orders
        $stats['total'] = $this->db->count_all_results($this->table);
        
        // Pending orders
        $stats['pending'] = $this->getCountByStatus('pending');
        
        // Paid orders
        $stats['paid'] = $this->getCountByStatus('paid');
        
        // Cancelled orders
        $stats['cancelled'] = $this->getCountByStatus('cancelled');
        
        // Total sales
        $stats['total_sales'] = $this->getTotalSales();
        
        return $stats;
    }
    
    /**
     * Search orders
     */
    public function search($keyword) {
        $this->db->like('order_number', $keyword);
        $this->db->or_like('customer_name', $keyword);
        $this->db->or_like('customer_email', $keyword);
        
        return $this->db->order_by('created_at', 'DESC')
                        ->get($this->table)->result();
    }
    
    /**
     * Get orders by date range
     */
    public function getByDateRange($start_date, $end_date) {
        return $this->db->where('created_at >=', $start_date)
                        ->where('created_at <=', $end_date)
                        ->order_by('created_at', 'DESC')
                        ->get($this->table)->result();
    }
    
    /**
     * Generate order number
     */
    public function generateOrderNumber() {
        $prefix = 'ORD';
        $date = date('Ymd');
        $random = strtoupper(substr(md5(uniqid()), 0, 6));
        return $prefix . $date . $random;
    }
} 