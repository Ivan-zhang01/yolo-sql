<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
    
    private function write_query_response($query_result) {
        $ret = array();
        
        if ($query_result === false) {
            // Errors
            $err_no   = $this->db->_error_number();
            $err_mess = $this->db->_error_message();
            
            $ret['status'] = false;
            $ret['content'] = "$err_no: $err_mess";
        } else {
            $ret['status'] = true;
            $ret['content'] = 'Schema created successfully.';
        }
        
        return $ret;
    }
    
    public function index() {
        session_start();
        
        // Get database names
        $databases = $this->db->query('SHOW DATABASES')->result();
        
        // Get tables
        $tables = array();
        $views = array();
        $procedures = array();
        $functions = array();
        
        foreach ($databases as $database) {
            $db_name = $database->Database;
            $this->db->query('USE ' . $db_name);
            
            // Get tables
            $tables[$db_name] = $this->db->query('SHOW TABLES')->result();
            
            // Get views
            $this->db->query('USE information_schema');
            
            $views[$db_name] = $this->db->select('views.table_name')
                    ->where('table_schema', $db_name)
                    ->get('views')
                    ->result();
            
            // Get stored procedures
            $procedures[$db_name] = $this->db->select('routines.routine_name')
                    ->where('routine_type', 'PROCEDURE')
                    ->where('routine_schema', $db_name)
                    ->get('routines')
                    ->result();
            
            // Get stored functions
            $functions[$db_name] = $this->db->select('routines.routine_name')
                    ->where('routine_type', 'FUNCTION')
                    ->where('routine_schema', $db_name)
                    ->get('routines')
                    ->result();
        }
        
        $this->data['databases'] = $databases;
        $this->data['tables'] = $tables;
        $this->data['views'] = $views;
        $this->data['procedures'] = $procedures;
        $this->data['functions'] = $functions;
        
        // Check this
        if (!isset($_SESSION['used'])) {
            $_SESSION['used'] = $this->db->query('SELECT DATABASE() as used')->row()->used;
        }
    }
    
    public function use_database() {
        session_start();
        $this->view = false;
        
        // Change database
        $this->db->query('USE ' . $_POST['db_name']);
        $_SESSION['used'] = $this->db->query('SELECT DATABASE() as used')->row()->used;
        
        // Send the output
        $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($_SESSION['used']));
    }
    
    public function execute_statements() {
        session_start();
        $this->output->set_content_type('application/json');
        $this->view = false;
        $ret = array();
        
        // Execute statements
        $statements = array_filter(explode(';', $_POST['content']));
        $this->db->query('USE ' . $_SESSION['used']);
        
        foreach ($statements as $statement) {
            $result = $this->db->query($statement);
            
            if ($result === false) {
                // Errors
                $err_no = $this->db->_error_number();
                $err_mess = $this->db->_error_message();
            
                $ret['status'] = false;
                $ret['content'] = "$err_no: $err_mess";
            } else if ($result === true) {
                // Write type queries
                $ret['status'] = true;
                $ret['type'] = 'w';
                $ret['content'] = $this->db->affected_rows();
            } else {
                // Read type queries
                $ret['status'] = true;
                $ret['type'] = 'r';
                $ret['content'] = $result->result();

                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($ret));
            }
        }
        
        $this->output->set_output(json_encode($ret));
    }
    
    public function create_schema() {
        session_start();
        $this->view = false;
        
        // Create database
        $result = $this->db->query('CREATE SCHEMA ' . $_POST['schema']);
        $ret = $this->write_query_response($result);
        
        // Send the output
        $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($ret));
    }
    
    public function drop_schema() {
        session_start();
        $this->view = false;
        
        // Create database
        $result = $this->db->query('DROP SCHEMA ' . $_POST['schema']);
        $ret = $this->write_query_response($result);
        
        // Send the output
        $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($ret));
    }
    
    public function create_table() {
        session_start();
        $this->view = false;
        
        // Create table
        $result = $this->db->query($_POST['sql']);
        $ret = $this->write_query_response($result);
        
        $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($ret));
    }
    
    public function drop_table() {
        session_start();
        $this->view = false;
        
        // Create database
        $result = $this->db->query('DROP TABLE ' . $_POST['table']);
        $ret = $this->write_query_response($result);
        
        // Send the output
        $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($ret));
    }
    
    public function truncate_table() {
        session_start();
        $this->view = false;
        
        // Create database
        $result = $this->db->query('TRUNCATE TABLE ' . $_POST['table']);
        $ret = $this->write_query_response($result);
        
        // Send the output
        $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($ret));
    }
    
    public function create_er_diagram() {
        
    }
}