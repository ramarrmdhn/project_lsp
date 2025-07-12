<?php
/**
 * Database Migration System
 * Auto-create tables based on configuration
 */

class DatabaseMigration {
    
    private $CI;
    private $tables = [];
    
    public function __construct() {
        $this->CI =& get_instance();
        $this->CI->load->database();
        $this->CI->load->dbforge();
        
        // Define all tables structure
        $this->defineTables();
    }
    
    /**
     * Define all tables structure
     */
    private function defineTables() {
        
        // Users table
        $this->tables['users'] = [
            'fields' => [
                'id' => [
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ],
                'username' => [
                    'type' => 'VARCHAR',
                    'constraint' => 100,
                    'unique' => TRUE
                ],
                'email' => [
                    'type' => 'VARCHAR',
                    'constraint' => 255,
                    'unique' => TRUE
                ],
                'password' => [
                    'type' => 'VARCHAR',
                    'constraint' => 255
                ],
                'full_name' => [
                    'type' => 'VARCHAR',
                    'constraint' => 255
                ],
                'phone' => [
                    'type' => 'VARCHAR',
                    'constraint' => 20
                ],
                'address' => [
                    'type' => 'TEXT',
                    'null' => TRUE
                ],
                'role' => [
                    'type' => 'ENUM',
                    'constraint' => ['user', 'admin'],
                    'default' => 'user'
                ],
                'status' => [
                    'type' => 'ENUM',
                    'constraint' => ['active', 'blocked'],
                    'default' => 'active'
                ],
                'created_at' => [
                    'type' => 'DATETIME',
                    'default' => 'CURRENT_TIMESTAMP'
                ],
                'updated_at' => [
                    'type' => 'DATETIME',
                    'default' => 'CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
                ]
            ],
            'keys' => [
                'PRIMARY KEY' => ['id']
            ]
        ];
        
        // Concerts table
        $this->tables['concerts'] = [
            'fields' => [
                'id' => [
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ],
                'title' => [
                    'type' => 'VARCHAR',
                    'constraint' => 255
                ],
                'artist' => [
                    'type' => 'VARCHAR',
                    'constraint' => 255
                ],
                'venue' => [
                    'type' => 'VARCHAR',
                    'constraint' => 255
                ],
                'date_time' => [
                    'type' => 'DATETIME'
                ],
                'description' => [
                    'type' => 'TEXT'
                ],
                'image' => [
                    'type' => 'VARCHAR',
                    'constraint' => 255,
                    'null' => TRUE
                ],
                'status' => [
                    'type' => 'ENUM',
                    'constraint' => ['upcoming', 'active', 'completed', 'cancelled'],
                    'default' => 'upcoming'
                ],
                'created_at' => [
                    'type' => 'DATETIME',
                    'default' => 'CURRENT_TIMESTAMP'
                ],
                'updated_at' => [
                    'type' => 'DATETIME',
                    'default' => 'CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
                ]
            ],
            'keys' => [
                'PRIMARY KEY' => ['id']
            ]
        ];
        
        // Tickets table
        $this->tables['tickets'] = [
            'fields' => [
                'id' => [
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ],
                'concert_id' => [
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE
                ],
                'category' => [
                    'type' => 'VARCHAR',
                    'constraint' => 100
                ],
                'price' => [
                    'type' => 'DECIMAL',
                    'constraint' => '10,2'
                ],
                'quantity_available' => [
                    'type' => 'INT',
                    'constraint' => 11,
                    'default' => 0
                ],
                'quantity_sold' => [
                    'type' => 'INT',
                    'constraint' => 11,
                    'default' => 0
                ],
                'status' => [
                    'type' => 'ENUM',
                    'constraint' => ['available', 'sold_out', 'inactive'],
                    'default' => 'available'
                ],
                'created_at' => [
                    'type' => 'DATETIME',
                    'default' => 'CURRENT_TIMESTAMP'
                ],
                'updated_at' => [
                    'type' => 'DATETIME',
                    'default' => 'CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
                ]
            ],
            'keys' => [
                'PRIMARY KEY' => ['id'],
                'FOREIGN KEY' => ['concert_id' => 'concerts(id)']
            ]
        ];
        
        // Orders table
        $this->tables['orders'] = [
            'fields' => [
                'id' => [
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ],
                'order_number' => [
                    'type' => 'VARCHAR',
                    'constraint' => 50,
                    'unique' => TRUE
                ],
                'user_id' => [
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE
                ],
                'total_amount' => [
                    'type' => 'DECIMAL',
                    'constraint' => '10,2'
                ],
                'status' => [
                    'type' => 'ENUM',
                    'constraint' => ['pending', 'paid', 'completed', 'cancelled', 'expired'],
                    'default' => 'pending'
                ],
                'payment_method' => [
                    'type' => 'VARCHAR',
                    'constraint' => 100
                ],
                'order_date' => [
                    'type' => 'DATETIME',
                    'default' => 'CURRENT_TIMESTAMP'
                ],
                'expired_at' => [
                    'type' => 'DATETIME'
                ],
                'created_at' => [
                    'type' => 'DATETIME',
                    'default' => 'CURRENT_TIMESTAMP'
                ],
                'updated_at' => [
                    'type' => 'DATETIME',
                    'default' => 'CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
                ]
            ],
            'keys' => [
                'PRIMARY KEY' => ['id'],
                'FOREIGN KEY' => ['user_id' => 'users(id)']
            ]
        ];
        
        // Order items table
        $this->tables['order_items'] = [
            'fields' => [
                'id' => [
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ],
                'order_id' => [
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE
                ],
                'ticket_id' => [
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE
                ],
                'quantity' => [
                    'type' => 'INT',
                    'constraint' => 11
                ],
                'price_per_ticket' => [
                    'type' => 'DECIMAL',
                    'constraint' => '10,2'
                ],
                'subtotal' => [
                    'type' => 'DECIMAL',
                    'constraint' => '10,2'
                ],
                'created_at' => [
                    'type' => 'DATETIME',
                    'default' => 'CURRENT_TIMESTAMP'
                ]
            ],
            'keys' => [
                'PRIMARY KEY' => ['id'],
                'FOREIGN KEY' => [
                    'order_id' => 'orders(id)',
                    'ticket_id' => 'tickets(id)'
                ]
            ]
        ];
        
        // Payments table
        $this->tables['payments'] = [
            'fields' => [
                'id' => [
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ],
                'order_id' => [
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE
                ],
                'payment_number' => [
                    'type' => 'VARCHAR',
                    'constraint' => 100,
                    'unique' => TRUE
                ],
                'amount' => [
                    'type' => 'DECIMAL',
                    'constraint' => '10,2'
                ],
                'payment_method' => [
                    'type' => 'VARCHAR',
                    'constraint' => 100
                ],
                'status' => [
                    'type' => 'ENUM',
                    'constraint' => ['pending', 'paid', 'failed', 'expired'],
                    'default' => 'pending'
                ],
                'payment_date' => [
                    'type' => 'DATETIME',
                    'null' => TRUE
                ],
                'proof_of_payment' => [
                    'type' => 'VARCHAR',
                    'constraint' => 255,
                    'null' => TRUE
                ],
                'notes' => [
                    'type' => 'TEXT',
                    'null' => TRUE
                ],
                'created_at' => [
                    'type' => 'DATETIME',
                    'default' => 'CURRENT_TIMESTAMP'
                ],
                'updated_at' => [
                    'type' => 'DATETIME',
                    'default' => 'CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
                ]
            ],
            'keys' => [
                'PRIMARY KEY' => ['id'],
                'FOREIGN KEY' => ['order_id' => 'orders(id)']
            ]
        ];
        
        // Notifications table
        $this->tables['notifications'] = [
            'fields' => [
                'id' => [
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ],
                'user_id' => [
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'null' => TRUE
                ],
                'type' => [
                    'type' => 'VARCHAR',
                    'constraint' => 100
                ],
                'title' => [
                    'type' => 'VARCHAR',
                    'constraint' => 255
                ],
                'message' => [
                    'type' => 'TEXT'
                ],
                'is_read' => [
                    'type' => 'TINYINT',
                    'constraint' => 1,
                    'default' => 0
                ],
                'created_at' => [
                    'type' => 'DATETIME',
                    'default' => 'CURRENT_TIMESTAMP'
                ]
            ],
            'keys' => [
                'PRIMARY KEY' => ['id'],
                'FOREIGN KEY' => ['user_id' => 'users(id)']
            ]
        ];
    }
    
    /**
     * Run migration to create all tables
     */
    public function migrate() {
        $created_tables = [];
        $errors = [];
        
        foreach ($this->tables as $table_name => $table_structure) {
            try {
                if ($this->createTable($table_name, $table_structure)) {
                    $created_tables[] = $table_name;
                }
            } catch (Exception $e) {
                $errors[] = "Error creating table {$table_name}: " . $e->getMessage();
            }
        }
        
        return [
            'success' => empty($errors),
            'created_tables' => $created_tables,
            'errors' => $errors
        ];
    }
    
    /**
     * Create single table
     */
    private function createTable($table_name, $structure) {
        // Check if table exists
        if ($this->CI->db->table_exists($table_name)) {
            return true; // Table already exists
        }
        
        // Add fields
        $this->CI->dbforge->add_field($structure['fields']);
        
        // Add keys
        foreach ($structure['keys'] as $key_type => $key_fields) {
            if ($key_type === 'PRIMARY KEY') {
                $this->CI->dbforge->add_key($key_fields, TRUE);
            } else if ($key_type === 'FOREIGN KEY') {
                foreach ($key_fields as $field => $reference) {
                    $this->CI->dbforge->add_field("CONSTRAINT fk_{$table_name}_{$field} FOREIGN KEY ({$field}) REFERENCES {$reference}");
                }
            }
        }
        
        // Create table
        $result = $this->CI->dbforge->create_table($table_name, TRUE);
        
        return $result;
    }
    
    /**
     * Drop all tables (for testing/reset)
     */
    public function dropAllTables() {
        $dropped_tables = [];
        
        foreach (array_keys($this->tables) as $table_name) {
            if ($this->CI->db->table_exists($table_name)) {
                $this->CI->dbforge->drop_table($table_name);
                $dropped_tables[] = $table_name;
            }
        }
        
        return $dropped_tables;
    }
    
    /**
     * Check if all tables exist
     */
    public function checkTables() {
        $missing_tables = [];
        
        foreach (array_keys($this->tables) as $table_name) {
            if (!$this->CI->db->table_exists($table_name)) {
                $missing_tables[] = $table_name;
            }
        }
        
        return [
            'all_exist' => empty($missing_tables),
            'missing_tables' => $missing_tables
        ];
    }
} 