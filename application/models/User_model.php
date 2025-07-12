<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
    
    protected $table = 'users';
    
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * Get all users
     */
    public function getAll($limit = null, $offset = null) {
        if ($limit) {
            $this->db->limit($limit, $offset);
        }
        return $this->db->get($this->table)->result();
    }
    
    /**
     * Get user by ID
     */
    public function getById($id) {
        return $this->db->where('id', $id)->get($this->table)->row();
    }
    
    /**
     * Get user by email
     */
    public function getByEmail($email) {
        return $this->db->where('email', $email)->get($this->table)->row();
    }
    
    /**
     * Get user by username
     */
    public function getByUsername($username) {
        return $this->db->where('username', $username)->get($this->table)->row();
    }
    
    /**
     * Create new user
     */
    public function create($data) {
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    
    /**
     * Update user
     */
    public function update($id, $data) {
        $data['updated_at'] = date('Y-m-d H:i:s');
        
        return $this->db->where('id', $id)->update($this->table, $data);
    }
    
    /**
     * Delete user
     */
    public function delete($id) {
        return $this->db->where('id', $id)->delete($this->table);
    }
    
    /**
     * Authenticate user
     */
    public function authenticate($email, $password) {
        $user = $this->getByEmail($email);
        
        if ($user && password_verify($password, $user->password)) {
            return $user;
        }
        
        return false;
    }
    
    /**
     * Check if email exists
     */
    public function emailExists($email, $exclude_id = null) {
        if ($exclude_id) {
            $this->db->where('id !=', $exclude_id);
        }
        return $this->db->where('email', $email)->get($this->table)->num_rows() > 0;
    }
    
    /**
     * Check if username exists
     */
    public function usernameExists($username, $exclude_id = null) {
        if ($exclude_id) {
            $this->db->where('id !=', $exclude_id);
        }
        return $this->db->where('username', $username)->get($this->table)->num_rows() > 0;
    }
    
    /**
     * Get users by role
     */
    public function getByRole($role) {
        return $this->db->where('role', $role)->get($this->table)->result();
    }
    
    /**
     * Get active users
     */
    public function getActive() {
        return $this->db->where('status', 'active')->get($this->table)->result();
    }
    
    /**
     * Block user
     */
    public function block($id) {
        return $this->update($id, ['status' => 'blocked']);
    }
    
    /**
     * Unblock user
     */
    public function unblock($id) {
        return $this->update($id, ['status' => 'active']);
    }
    
    /**
     * Reset password
     */
    public function resetPassword($id, $new_password) {
        return $this->update($id, [
            'password' => password_hash($new_password, PASSWORD_DEFAULT)
        ]);
    }
    
    /**
     * Get user count
     */
    public function getCount($where = []) {
        if (!empty($where)) {
            $this->db->where($where);
        }
        return $this->db->count_all_results($this->table);
    }
    
    /**
     * Search users
     */
    public function search($keyword) {
        $this->db->like('username', $keyword);
        $this->db->or_like('email', $keyword);
        $this->db->or_like('full_name', $keyword);
        
        return $this->db->get($this->table)->result();
    }
} 