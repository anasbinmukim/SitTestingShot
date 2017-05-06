<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends RM_Controller {
		public function __construct()
		{
				parent::__construct();
				if( !$this->session->userdata('logged_in') ) {
					redirect('login');
				}
				$this->common->check_user_exists();
		}
		public function index()
		{
        $this->data['title'] = 'Booking';

        $this->load->view('templates/header', $this->data);
				$this->load->view('templates/sidebar', $this->data);
        $this->load->view('booking/booking', $this->data);
        $this->load->view('templates/footer', $this->data);
		}

		public function launch($launch_id = null, $schedule_id = null)
		{

				// Start: Process launch schedule
				$this->process_launch_schedule_search();
				// End: Process launch schedule

				$this->data['css_files'] = array(
					base_url('assets/global/plugins/datatables/datatables.min.css'),
					base_url('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css'),
					base_url('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css'),
				);

				$this->data['js_files'] = array(
					base_url('assets/global/scripts/datatable.js'),
					base_url('assets/global/plugins/datatables/datatables.min.js'),
					base_url('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js'),
					base_url('seatassets/js/table-datatables-responsive.js'),
					base_url('assets/pages/scripts/components-date-time-pickers.min.js'),
					base_url('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js'),
				);

				$this->data['launch_arr'] = $this->get_launch_arr();
				$this->data['launch_route_arr'] = $this->get_launch_route_arr();

				$schedule_condition = '1=1 ';
				$today = date('Y-m-d');
				$schedule_condition .= ' AND date >= "'.$today.'"';


				if($launch_id > 0){
					$schedule_condition .= ' AND launch_id = "'.$launch_id.'"';
					$result = $this->common->get_all('launch_schedule', $schedule_condition);
					$this->data['launch_schedule_rows'] = $result;
					$this->data['title'] = 'Launch Booking';
					$this->load->view('templates/header', $this->data);
					$this->load->view('templates/sidebar', $this->data);
					$this->load->view('booking/launch/search-form', $this->data);
					$this->load->view('booking/launch/launch', $this->data);
					$this->load->view('templates/footer', $this->data);
				}else{
					$result = $this->common->get_all('launch_schedule', $schedule_condition);
					$this->data['launch_schedule_rows'] = $result;
					$this->data['title'] = 'Cabin Booking';
					$this->load->view('templates/header', $this->data);
					$this->load->view('templates/sidebar', $this->data);
					$this->load->view('booking/launch/search-form', $this->data);
					$this->load->view('booking/launch/launch', $this->data);
					$this->load->view('templates/footer', $this->data);
				}



		}//EOF launch booking

		//Process launch schedule search
		private function process_launch_schedule_search(){
				if(($this->input->post('launch_booking_search') !== NULL)){
						//get launch ID
						if(($this->input->post('launch_id') !== NULL)){
								$launch_id = $this->input->post('launch_id');
						}else{
								$launch_id = 'id';
						}

						if(($this->input->post('travel_date') !== NULL)){
								$travel_date = $this->input->post('travel_date');
						}else{
								$travel_date = 'date';
						}

						if(($this->input->post('start_from') !== NULL)){
								$start_from = $this->input->post('start_from');
						}else{
								$start_from = 'from';
						}

						if(($this->input->post('destination_to') !== NULL)){
								$destination_to = $this->input->post('destination_to');
						}else{
								$destination_to = 'to';
						}
						redirect('/booking/launch/'.$launch_id.'/'.$travel_date.'/'.$start_from.'/'.$destination_to);
						exit;

				}
		}//EOF process launch schedule search




		public function get_launch_arr() {
			$launchs = $this->common->get_all( 'launch');
			$result_launch = array();
			foreach ($launchs as $launch) {
				if(($launch->ID != '') && ($launch->ID > 0)){
						$launch_id = $launch->ID;
						$result_launch[$launch_id] = array(
								'ID' => $launch->ID,
								'launch_name' => $launch->launch_name,
								'company_id' => $launch->company_id
						);
				}
			}
			return $result_launch;
		}

		public function get_launch_route_arr() {
			$routes = $this->common->get_all( 'launch_route');

			$result_routes = array();
			foreach ($routes as $route) {
				if(($route->route_id != '') && ($route->route_id > 0)){
						$route_id = $route->route_id;
						$result_routes[$route_id] = array(
								'route' => $route->route,
								'route_path' => $route->route_path,
								'place_1' => $route->place_1,
								'place_2' => $route->place_2
						);
				}
			}
			return $result_routes;
		}

}
