<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Launch extends RM_Controller {
		public function __construct()
		{
						parent::__construct();
		}
		public function index()
		{
        $this->data['title'] = 'Launch Booking'; // Capitalize the first letter

        $this->load->view('templates/header', $this->data);
				$this->load->view('templates/sidebar', $this->data);
        $this->load->view('launch/home', $this->data);
        $this->load->view('templates/footer', $this->data);
		}

		public function add_new_launch(){
			$this->data['title'] = 'Add New Launch'; // Capitalize the first letter

			$this->load->view('templates/header', $this->data);
			$this->load->view('templates/sidebar', $this->data);
			$this->load->view('launch/add_new_launch', $this->data);
			$this->load->view('templates/footer', $this->data);

		}
}
