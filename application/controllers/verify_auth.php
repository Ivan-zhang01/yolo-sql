<?php

class Verify_auth extends MY_Controller {
    
    public function index() {
        $this->view = false;
        
        $config['hostname'] = 'localhost';
        $config['username'] = $_POST['username'];
        $config['password'] = $_POST['password'];
        $config['database'] = '';
        $config['dbdriver'] = 'mysql';
        $config['dbprefix'] = '';
        $config['pconnect'] = FALSE;
        $config['db_debug'] = TRUE;
        $config['cache_on'] = FALSE;
        $config['cachedir'] = '';
        $config['char_set'] = 'utf8';
        $config['dbcollat'] = 'utf8_general_ci';
        
        $this->db = $this->load->database($config, TRUE);
        //$this->db->database
        redirect('/index.php/home/', 'refresh');
    }
    
}