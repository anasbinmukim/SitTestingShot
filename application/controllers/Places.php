<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Places extends RM_Controller {

    public function __construct()
    {
            parent::__construct();
            if ( ! $this->session->userdata('logged_in') ) {
							redirect('/login/');
						}
    }

    public function index()
    {
        $this->data['title'] = 'Places';

        $this->load->view('templates/header',$this->data);
        $this->load->view('templates/sidebar', $this->data);
        $this->load->view('places/home', $this->data);
        $this->load->view('templates/footer', $this->data);
    }

    public function add_new()
    {

      if(isset($_GET['psection']) && ($_GET['psection'] == 'area')){
        $this->data['add_section'] = 'area';
      }elseif(isset($_GET['psection']) && ($_GET['psection'] == 'thana')){
        $this->data['add_section'] = 'thana';
      }elseif(isset($_GET['psection']) && ($_GET['psection'] == 'district')){
        $this->data['add_section'] = 'district';
      }elseif(isset($_GET['psection']) && ($_GET['psection'] == 'division')){
        $this->data['add_section'] = 'division';
      }elseif(isset($_GET['psection']) && ($_GET['psection'] == 'zone')){
        $this->data['add_section'] = 'zone';
      }else{
        $this->data['add_section'] = 'area';
      }

      $this->load->view('templates/header',$this->data);
      $this->load->view('templates/sidebar', $this->data);
      $this->load->view('places/add-new', $this->data);
      $this->load->view('templates/footer', $this->data);
    }

}
