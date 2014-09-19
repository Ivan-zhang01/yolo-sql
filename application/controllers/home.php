<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
    
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
            
            $views[$db_name] = $this->db->select('views.*')
                    ->where('table_schema', $db_name)
                    ->get('views')
                    ->result();
            
            // Get stored procedures
            $procedures[$db_name] = $this->db->select('routines.*')
                    ->where('routine_type', 'PROCEDURE')
                    ->where('routine_schema', $db_name)
                    ->get('routines')
                    ->result();
            
            // Get stored functions
            $functions[$db_name] = $this->db->select('routines.*')
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
        $this->data['used'] = $this->db->query('SELECT DATABASE() as used')->row()->used;
        //$_SESSION['used'] = $this->db->query('SELECT DATABASE() as used')->row()->used;
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
        header('Content-Type: application/json');
        session_start();
        $this->view = false;
        
        // Execute statements
        $this->db->query('USE ' . $_SESSION['used']);
        $result = $this->db->query($_POST['content']);
        
        if (empty($result) && $result === false)
        {
            // Errors
            $err_no   = $this->db->_error_number();
            $err_mess = $this->db->_error_message();
            
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode("$err_no: $err_mess"));
        }
        else if ($result === true)
        {
            // Write type queries
            
        }
        else if (!empty($result))
        {
            // Read type queries
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($result));
        }
        
        /*if ($result === false) {
            $errNo   = $this->db->_error_number();
            $errMess = $this->db->_error_message();
            echo json_encode("$errNo: $errMess");
        } else if ($result === true) {
            echo json_encode($result->result());
        }*/
    }
}