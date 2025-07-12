<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart_model extends CI_Model {
    
    protected $table = 'cart';
    
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * Get cart items by user
     */
    public function getByUser($user_id) {
        return $this->db->where('user_id', $user_id)
                        ->order_by('created_at', 'ASC')
                        ->get($this->table)->result();
    }
    
    /**
     * Get cart item by ID
     */
    public function getById($id) {
        return $this->db->where('id', $id)->get($this->table)->row();
    }
    
    /**
     * Add item to cart
     */
    public function add($data) {
        // Check if item already exists in cart
        $existing = $this->db->where('user_id', $data['user_id'])
                             ->where('ticket_id', $data['ticket_id'])
                             ->get($this->table)->row();
        
        if ($existing) {
            // Update quantity
            $new_quantity = $existing->quantity + $data['quantity'];
            return $this->update($existing->id, ['quantity' => $new_quantity]);
        } else {
            // Add new item
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');
            
            $this->db->insert($this->table, $data);
            return $this->db->insert_id();
        }
    }
    
    /**
     * Update cart item
     */
    public function update($id, $data) {
        $data['updated_at'] = date('Y-m-d H:i:s');
        
        return $this->db->where('id', $id)->update($this->table, $data);
    }
    
    /**
     * Remove item from cart
     */
    public function remove($id) {
        return $this->db->where('id', $id)->delete($this->table);
    }
    
    /**
     * Clear user's cart
     */
    public function clear($user_id) {
        return $this->db->where('user_id', $user_id)->delete($this->table);
    }
    
    /**
     * Get cart with ticket info
     */
    public function getWithTicket($user_id) {
        $this->db->select('cart.*, tickets.category, tickets.description, tickets.price, tickets.quantity as available_quantity, concerts.title as concert_title, concerts.artist, concerts.venue, concerts.date_time')
                 ->from($this->table)
                 ->join('tickets', 'cart.ticket_id = tickets.id', 'left')
                 ->join('concerts', 'tickets.concert_id = concerts.id', 'left')
                 ->where('cart.user_id', $user_id)
                 ->order_by('cart.created_at', 'ASC');
        
        return $this->db->get()->result();
    }
    
    /**
     * Get cart total
     */
    public function getTotal($user_id) {
        $items = $this->getWithTicket($user_id);
        $total = 0;
        
        foreach ($items as $item) {
            $total += $item->price * $item->quantity;
        }
        
        return $total;
    }
    
    /**
     * Get cart item count
     */
    public function getItemCount($user_id) {
        return $this->db->where('user_id', $user_id)
                        ->count_all_results($this->table);
    }
    
    /**
     * Check if ticket is in cart
     */
    public function isInCart($user_id, $ticket_id) {
        return $this->db->where('user_id', $user_id)
                        ->where('ticket_id', $ticket_id)
                        ->get($this->table)->num_rows() > 0;
    }
    
    /**
     * Update cart item quantity
     */
    public function updateQuantity($id, $quantity) {
        if ($quantity <= 0) {
            return $this->remove($id);
        }
        
        return $this->update($id, ['quantity' => $quantity]);
    }
    
    /**
     * Validate cart items (check availability)
     */
    public function validateCart($user_id) {
        $items = $this->getWithTicket($user_id);
        $errors = [];
        
        foreach ($items as $item) {
            if ($item->quantity > $item->available_quantity) {
                $errors[] = "Only {$item->available_quantity} tickets available for {$item->concert_title} - {$item->category}";
            }
        }
        
        return $errors;
    }
    
    /**
     * Get cart summary
     */
    public function getSummary($user_id) {
        $items = $this->getWithTicket($user_id);
        $summary = [
            'item_count' => count($items),
            'total_amount' => 0,
            'items' => []
        ];
        
        foreach ($items as $item) {
            $subtotal = $item->price * $item->quantity;
            $summary['total_amount'] += $subtotal;
            $summary['items'][] = [
                'id' => $item->id,
                'ticket_id' => $item->ticket_id,
                'concert_title' => $item->concert_title,
                'category' => $item->category,
                'quantity' => $item->quantity,
                'price' => $item->price,
                'subtotal' => $subtotal
            ];
        }
        
        return $summary;
    }
} 