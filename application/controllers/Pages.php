<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends RM_Controller {
		public function __construct()
		{
						parent::__construct();
						$this->load->helper('url_helper');
						$this->load->helper('url');
		}
		public function view($page = 'home')
		{
						if ( ! $this->session->userdata('logged_in') ) {
							//redirect('/login');
						}

		        if ( ! file_exists(APPPATH.'views/pages/'.$page.'.php'))
		        {
		                // Whoops, we don't have a page for that!
		                show_404();
		        }

						$this->data['my_account_balance'] = 0;
						if ( $this->session->userdata('logged_in') ) {
							$this->data['my_account_balance'] = $this->common->get_user_meta($this->session->userdata('user_id'), 'account_balance');
						}


		        $this->data['title'] = ucfirst($page); // Capitalize the first letter

		        $this->load->view('theme/header', $this->data);
						//$this->load->view('theme/sidebar', $this->data);
		        $this->load->view('pages/'.$page, $this->data);
		        $this->load->view('theme/footer', $this->data);
		}
}
