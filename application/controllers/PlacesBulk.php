<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PlacesBulk extends RM_Controller {

    public function __construct()
    {
            parent::__construct();
            $this->load->library('form_validation');
            if ( ! $this->session->userdata('logged_in') ) {
							redirect('/login/');
						}
    }

    public function index()
    {
        $this->data['title'] = 'Places';

        $this->load->view('templates/header',$this->data);
        $this->load->view('templates/sidebar', $this->data);
        $this->load->view('places/bulkplaces', $this->data);
        $this->load->view('templates/footer', $this->data);
    }


}
