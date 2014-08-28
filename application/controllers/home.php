<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
      
    public function index() {
        // Get database, tables, procedures, functions and views
        $databases = $this->db->query('SHOW DATABASES')->result();
        
        $this->data['databases'] = $databases;
    }
    
}