<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        
        // Load migration library
        require_once APPPATH . 'libraries/DatabaseMigration.php';
    }
    
    /**
     * Run database migration
     */
    public function index() {
        $migration = new DatabaseMigration();
        $result = $migration->migrate();
        
        if ($result['success']) {
            echo "<h2>Database Migration Successful!</h2>";
            echo "<p>Created tables:</p>";
            echo "<ul>";
            foreach ($result['created_tables'] as $table) {
                echo "<li>{$table}</li>";
            }
            echo "</ul>";
            
            // Create default admin user
            $this->createDefaultAdmin();
            
        } else {
            echo "<h2>Database Migration Failed!</h2>";
            echo "<p>Errors:</p>";
            echo "<ul>";
            foreach ($result['errors'] as $error) {
                echo "<li>{$error}</li>";
            }
            echo "</ul>";
        }
    }
    
    /**
     * Check database status
     */
    public function status() {
        $migration = new DatabaseMigration();
        $status = $migration->checkTables();
        
        echo "<h2>Database Status</h2>";
        if ($status['all_exist']) {
            echo "<p style='color: green;'>✓ All tables exist</p>";
        } else {
            echo "<p style='color: red;'>✗ Missing tables:</p>";
            echo "<ul>";
            foreach ($status['missing_tables'] as $table) {
                echo "<li>{$table}</li>";
            }
            echo "</ul>";
        }
    }
    
    /**
     * Reset database (drop all tables)
     */
    public function reset() {
        $migration = new DatabaseMigration();
        $dropped_tables = $migration->dropAllTables();
        
        echo "<h2>Database Reset</h2>";
        echo "<p>Dropped tables:</p>";
        echo "<ul>";
        foreach ($dropped_tables as $table) {
            echo "<li>{$table}</li>";
        }
        echo "</ul>";
    }
    
    /**
     * Create default admin user
     */
    private function createDefaultAdmin() {
        $this->load->model('User_model');
        
        // Check if admin exists
        $admin = $this->User_model->getByEmail('admin@ticketconcert.com');
        
        if (!$admin) {
            $admin_data = [
                'username' => 'admin',
                'email' => 'admin@ticketconcert.com',
                'password' => password_hash('admin123', PASSWORD_DEFAULT),
                'full_name' => 'System Administrator',
                'role' => 'admin',
                'status' => 'active'
            ];
            
            $this->User_model->create($admin_data);
            echo "<p style='color: green;'>✓ Default admin created (admin@ticketconcert.com / admin123)</p>";
        } else {
            echo "<p style='color: blue;'>ℹ Admin user already exists</p>";
        }
    }
} 