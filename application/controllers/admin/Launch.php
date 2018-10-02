<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Launch extends RM_Controller {
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
				$this->data['title'] = 'Launch';
				$breadcrumb[] = array('name' => 'Launch', 'url' => '');
				$this->data['breadcrumb'] = $breadcrumb;
				$this->data['current_page'] = 'launch';

				$this->data['css_files'] = array(
					base_url('assets/global/plugins/datatables/datatables.min.css'),
					base_url('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css'),
					base_url('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css'),
					base_url('assets/global/plugins/select2/css/select2.min.css'),
					base_url('assets/global/plugins/select2/css/select2-bootstrap.min.css'),
				);

				$this->data['js_files'] = array(
					base_url('assets/global/scripts/datatable.js'),
					base_url('assets/global/plugins/datatables/datatables.min.js'),
					base_url('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js'),
					base_url('seatassets/js/table-datatables-responsive.js'),
					base_url('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js'),
					base_url('assets/global/plugins/select2/js/select2.full.min.js'),
					base_url('assets/global/plugins/jquery-validation/js/jquery.validate.min.js'),
				);

				$join_arr_left = array(
					'launch_route lr' => 'lr.route_id = l.route_id',
					'via_place vp_1' => 'vp_1.ID = lr.place_1',
					'via_place vp_2' => 'vp_2.ID = lr.place_2',
				);
				$order_by = 'launch_name ';
				$order = 'ASC ';
				$sort = $order_by.' '.$order;
				$result = $this->common->get_all( 'launch l', '', 'l.*, lr.route, lr.route_path, vp_1.place_name as place_1, vp_2.place_name as place_2', $sort, '', '', $join_arr_left );
				$this->data['launch_rows'] = $result;

        $this->load->view('templates/header', $this->data);
				$this->load->view('templates/sidebar', $this->data);
        $this->load->view('admin/launch/launch', $this->data);
        $this->load->view('templates/footer', $this->data);
		}

		public function SettingLaunch($launch_solt_id = NULL)
		{
			$launch_id = decrypt($launch_solt_id)*1;
			if( !is_int($launch_id) || !$launch_id ) {
				$this->session->set_flashdata('delete_msg','Can not be edited');
				redirect('admin/launch');
			}else{
				$this->data['css_files'] = array(
					base_url('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css'),
					base_url('assets/global/plugins/select2/css/select2.min.css'),
					base_url('assets/global/plugins/select2/css/select2-bootstrap.min.css'),
					base_url('assets/global/plugins/jquery-nestable/jquery.nestable.css'),
				);

				$this->data['js_files'] = array(
					base_url('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js'),
					base_url('assets/global/plugins/select2/js/select2.full.min.js'),
					base_url('assets/global/plugins/jquery-nestable/jquery.nestable.js'),
					base_url('assets/pages/scripts/ui-nestable.min.js'),
					base_url('assets/global/plugins/jquery-validation/js/jquery.validate.min.js'),
				);

				// Start: Process launch cabin
				$this->process_launch_settings();
				// End: Process launch cabin

				$this->data['launch_arr'] = $this->get_launch_arr();

				$this->data['title'] = 'Launch Settings';
				$breadcrumb[] = array('name' => 'Launch', 'url' => 'admin/launch');
				$breadcrumb[] = array('name' => 'Settings', 'url' => '');
				$this->data['breadcrumb'] = $breadcrumb;
				$this->data['current_page'] = 'launch_settings';

				$launch_details = $this->common->get( 'launch', array( 'ID' => $launch_id ), 'array' );
				$this->data['launch_data'] = $launch_details;

				$this->load->view('templates/header', $this->data);
				$this->load->view('templates/sidebar', $this->data);
				$this->load->view('admin/launch/launch-settings', $this->data);
				$this->load->view('templates/footer', $this->data);
			}

		}

		public function process_launch_settings(){
			//Add New Company
			if(($this->input->post('update_launch_settings') !== NULL)){
					$this->form_validation->set_rules('launch_supervisor', 'Supervisor', 'trim|required');
					$this->form_validation->set_rules('launch_booking_manager', 'Booking Manager', 'trim');

					$launch_id = $this->input->post('settings_launch_id');
					$launch_supervisor = $this->input->post('launch_supervisor');

					$route_path = '';
					$route_search = '';

					if( !$this->form_validation->run() ) {
						$error_message_array = $this->form_validation->error_array();
						$this->session->set_flashdata('error_msg_arr', $error_message_array);
					}else{
							//Supervisor updated
							$meta_id = $this->common->update_launch_meta($launch_id, 'launch_supervisor', $launch_supervisor);
							$this->session->set_flashdata('success_msg','Update done!');
							redirect('admin/launch/SettingLaunch/'.encrypt($launch_id));
					}
			}
		}

		public function cabin($display = 'all-cabins', $cabin_solt_id = NULL)
		{

				$this->data['css_files'] = array(
					base_url('assets/global/plugins/datatables/datatables.min.css'),
					base_url('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css'),
					base_url('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css'),
					base_url('assets/global/plugins/select2/css/select2.min.css'),
					base_url('assets/global/plugins/select2/css/select2-bootstrap.min.css'),
				);

				$this->data['js_files'] = array(
					base_url('assets/global/scripts/datatable.js'),
					base_url('assets/global/plugins/datatables/datatables.min.js'),
					base_url('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js'),
					base_url('seatassets/js/table-datatables-responsive.js'),
					base_url('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js'),
					base_url('assets/global/plugins/select2/js/select2.full.min.js'),
					base_url('assets/global/plugins/jquery-validation/js/jquery.validate.min.js'),
				);

				$this->data['launch_arr'] = $this->get_launch_arr();

				if($display == 'all-cabins'){
						//$cabin_solt_id parameter will work as launch ID for this display mode
						$launch_id = decrypt($cabin_solt_id)*1;
						if(($launch_id > 0) && ($cabin_solt_id != NULL)){
							$this->data['title'] = 'Launch Cabin';
							$breadcrumb[] = array('name' => 'Launch', 'url' => 'admin/launch');
							$breadcrumb[] = array('name' => 'Cabin', 'url' => '');
							$this->data['breadcrumb'] = $breadcrumb;
							$this->data['current_page'] = 'cabin';
							$result = $this->common->get_all( 'launch_cabin', array('launch_id' => $launch_id ) );
							$this->data['launch_cabin_rows'] = $result;
						}else{
							$this->data['title'] = 'Launch Cabin';
							$breadcrumb[] = array('name' => 'Launch', 'url' => 'admin/launch');
							$breadcrumb[] = array('name' => 'Cabin', 'url' => '');
							$this->data['breadcrumb'] = $breadcrumb;
							$this->data['current_page'] = 'cabin';
							$result = $this->common->get_all( 'launch_cabin' );
							$this->data['launch_cabin_rows'] = $result;
						}

				}

				if($display == 'register'){
						$this->data['title'] = 'Add New Cabin';
						$breadcrumb[] = array('name' => 'Launch', 'url' => 'admin/launch');
						$breadcrumb[] = array('name' => 'Cabin', 'url' => 'admin/launch/cabin');
						$breadcrumb[] = array('name' => 'Add New', 'url' => '');
						$this->data['breadcrumb'] = $breadcrumb;
						$this->data['current_page'] = 'cabin_register';
				}

				if($display == 'edit'){
					//Get route ID of this Entry
					$cabin_id = decrypt($cabin_solt_id)*1;
					if( !is_int($cabin_id) || !$cabin_id ) {
						$this->session->set_flashdata('delete_msg','Can not be edited');
						redirect('admin/launch/cabin');
					}else{
							$cabin_details = $this->common->get( 'launch_cabin', array( 'ID' => $cabin_id ), 'array' );
							$this->data['cabin_data'] = $cabin_details;
							$this->data['title'] = 'Edit Cabin';
							$breadcrumb[] = array('name' => 'Launch', 'url' => 'admin/launch');
							$breadcrumb[] = array('name' => 'Cabin', 'url' => 'admin/launch/cabin');
							$breadcrumb[] = array('name' => 'Edit Cabin', 'url' => '');
							$this->data['breadcrumb'] = $breadcrumb;
							$this->data['current_page'] = 'cabin_edit';
						}
				}

				if($display == 'delete'){
					//Get route ID of this Entry
					$cabin_id = decrypt($cabin_solt_id)*1;
					if( !is_int($cabin_id) || !$cabin_id ) {
						$this->session->set_flashdata('delete_msg','Can not be deleted!');
						redirect('admin/launch/cabin');
					}else{
						$this->common->delete( 'launch_cabin', array( 'ID' =>  $cabin_id ) );
						$this->session->set_flashdata('delete_msg','Cabin has been deleted!');
						redirect('admin/launch/cabin');
						}
				}

				// Start: Process launch cabin
				$this->process_launch_cabin();
				// End: Process launch cabin

				$this->load->view('templates/header', $this->data);
				$this->load->view('templates/sidebar', $this->data);
				$this->load->view('admin/launch/cabin/'.$display, $this->data);
				$this->load->view('templates/footer', $this->data);
		}

		//Process Cabin Info
    private function process_launch_cabin(){
      //Add New Company
      if(($this->input->post('register_new_cabin') !== NULL) || ($this->input->post('update_cabin') !== NULL)){
          $this->form_validation->set_rules('launch_id', 'Select Launch', 'trim|required');
					$this->form_validation->set_rules('cabin_fare', 'Cabin Fare', 'trim|required|numeric');
					$this->form_validation->set_rules('floor', 'Floor', 'trim|required|htmlspecialchars');
					$this->form_validation->set_rules('cabin_class', 'Cabin class', 'trim|required|htmlspecialchars');
          $this->form_validation->set_rules('cabin_info', 'Cabin Info', 'trim|htmlspecialchars');
					$this->form_validation->set_rules('cabin_type', 'Cabin Type', 'trim|required|htmlspecialchars');
					$this->form_validation->set_rules('allow_person', 'Number of tickets', 'trim|required|integer');
					$this->form_validation->set_rules('is_allow', 'Available for booked', 'trim|required|htmlspecialchars');

					if($this->input->post('update_cabin') !== NULL){
						$this->form_validation->set_rules('cabin_number', 'Cabin Number', 'trim|required|htmlspecialchars|min_length[2]');
					}else{
						$this->form_validation->set_rules('cabin_number', 'Cabin Number', 'trim|required|htmlspecialchars|callback_cabin_number_check|min_length[2]');
					}

          if( !$this->form_validation->run() ) {
  					$error_message_array = $this->form_validation->error_array();
  					$this->session->set_flashdata('error_msg_arr', $error_message_array);
  				}else{

						if($this->input->post('cabin_type') == 'Double'){
							$cabin_number = trim($this->input->post('cabin_number'));
							$cabin_fare = trim($this->input->post('cabin_fare'));
							$allow_person = trim($this->input->post('allow_person'));
							$cabin_number_a = $cabin_number . '-A';
							$cabin_number_b = $cabin_number . '-B';
							$cabin_fare_a = round($cabin_fare / 2);
							$cabin_fare_b = round($cabin_fare / 2);
							$cabin_ticket_a = round($allow_person / 2);
							$cabin_ticket_b = round($allow_person / 2);
							$pair_number = $cabin_number;
						}

            $data_arr = array(
              'launch_id'=> trim($this->input->post('launch_id')),
              'cabin_number'=> trim($this->input->post('cabin_number')),
              'cabin_fare'=> trim($this->input->post('cabin_fare')),
              'floor'=> trim($this->input->post('floor')),
              'cabin_class'=> trim($this->input->post('cabin_class')),
							'cabin_info'=> trim($this->input->post('cabin_info')),
							'cabin_type'=> trim($this->input->post('cabin_type')),
							'allow_person'=> trim($this->input->post('allow_person')),
							'is_allow'=> trim($this->input->post('is_allow')),
            );

            if(($this->input->post('update_cabin_id') !== NULL) && ($this->input->post('update_cabin') !== NULL)){
                $cabin_id = $this->input->post('update_cabin_id');
                $this->common->update( 'launch_cabin', $data_arr, array( 'ID' =>  $cabin_id ) );
      					$this->session->set_flashdata('success_msg','Updated done!');
                redirect('admin/launch/cabin');
            }else{

							//Process if double cabin
							if($this->input->post('cabin_type') == 'Double'){
								$data_arr['cabin_number'] = $cabin_number_a;
								$data_arr['cabin_fare'] = $cabin_fare_a;
								$data_arr['allow_person'] = $cabin_ticket_a;
	              $cabin_id = $this->common->insert( 'launch_cabin', $data_arr );
								$this->common->update( 'launch_cabin', array( 'pair_number' =>  $pair_number ), array( 'ID' =>  $cabin_id ) );

								$data_arr['cabin_number'] = $cabin_number_b;
								$data_arr['cabin_fare'] = $cabin_fare_b;
								$data_arr['allow_person'] = $cabin_ticket_b;
	              $cabin_id = $this->common->insert( 'launch_cabin', $data_arr );
								$this->common->update( 'launch_cabin', array( 'pair_number' =>  $pair_number ), array( 'ID' =>  $cabin_id ) );
							}else{
								$cabin_id = $this->common->insert( 'launch_cabin', $data_arr );
							}



              $this->session->set_flashdata('success_msg','Added done!');
              redirect('admin/launch/cabin');
            }



  				}
      }

    }//EOF process cabin info


		public function cabin_number_check()
		{
			$cabin_number = $this->common->get( 'launch_cabin', array( 'launch_id' => trim($this->input->post('launch_id')), 'cabin_number' => trim($this->input->post('cabin_number'))) );
			if(!empty($cabin_number)){
					$this->form_validation->set_message('cabin_number_check', 'This cabin number already exists, please try with new one.');
					return FALSE;
			}
			else
				return TRUE;
		}

		public function route($display = 'route', $route_solt_id = 0)
		{

				$this->data['css_files'] = array(
					base_url('assets/global/plugins/datatables/datatables.min.css'),
					base_url('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css'),
	        base_url('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css'),
	        base_url('assets/global/plugins/select2/css/select2.min.css'),
	        base_url('assets/global/plugins/select2/css/select2-bootstrap.min.css'),
					base_url('assets/global/plugins/jquery-nestable/jquery.nestable.css'),
	      );

	      $this->data['js_files'] = array(
					base_url('assets/global/scripts/datatable.js'),
					base_url('assets/global/plugins/datatables/datatables.min.js'),
					base_url('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js'),
					base_url('seatassets/js/table-datatables-responsive.js'),
	        base_url('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js'),
	        base_url('assets/global/plugins/select2/js/select2.full.min.js'),
					base_url('assets/global/plugins/jquery-nestable/jquery.nestable.js'),
					base_url('assets/pages/scripts/ui-nestable.min.js'),
	        base_url('assets/global/plugins/jquery-validation/js/jquery.validate.min.js'),
	      );

				if($display == 'route'){
		        $this->data['title'] = 'Launch Route'; // Capitalize the first letter
						$breadcrumb[] = array('name' => 'Launch', 'url' => 'admin/launch');
						$breadcrumb[] = array('name' => 'Route', 'url' => '');
						$this->data['breadcrumb'] = $breadcrumb;
						$this->data['current_page'] = 'route';
						$join_arr_left = array(
							'via_place vp_1' => 'vp_1.ID = lr.place_1',
							'via_place vp_2' => 'vp_2.ID = lr.place_2',
						);
						$order_by = 'route ';
						$order = 'ASC ';
						$sort = $order_by.' '.$order;
						$result = $this->common->get_all( 'launch_route lr', '', 'lr.*, vp_1.place_name as place_1, vp_2.place_name as place_2', $sort, '', '', $join_arr_left );
						$this->data['launch_rows'] = $result;
						$this->data['launch_route_rows'] = $result;
				}

				if($display == 'edit'){
					//Get route ID of this Entry
		      $row_id = decrypt($route_solt_id)*1;
					if( !is_int($row_id) || !$row_id ) {
		        $this->session->set_flashdata('delete_msg','Can not be edited');
						redirect('admin/launch/route');
					}else{
							$route_details = $this->common->get( 'launch_route', array( 'route_id' => $row_id ), 'array' );
							$this->data['route_data'] = $route_details;
			        $this->data['title'] = 'Edit Route';
							$breadcrumb[] = array('name' => 'Launch', 'url' => 'admin/launch');
							$breadcrumb[] = array('name' => 'Route', 'url' => 'admin/launch/route');
							$breadcrumb[] = array('name' => 'Edit Route', 'url' => '');
							$this->data['breadcrumb'] = $breadcrumb;
							$this->data['current_page'] = 'route_edit';
						}
				}

				if($display == 'delete'){
					//Get route ID of this Entry
		      $row_id = decrypt($route_solt_id)*1;
					if( !is_int($row_id) || !$row_id ) {
		        $this->session->set_flashdata('delete_msg','Can not be deleted!');
						redirect('admin/launch/route');
					}else{
						$this->common->delete( 'launch_route', array( 'route_id' =>  $row_id ) );
						$this->session->set_flashdata('delete_msg','Route has been deleted!');
						redirect('admin/launch/route');
						}
				}

				if($display == 'register'){
						$this->data['title'] = 'Add Route';
						$breadcrumb[] = array('name' => 'Launch', 'url' => 'admin/launch');
						$breadcrumb[] = array('name' => 'Route', 'url' => 'admin/launch/route');
						$breadcrumb[] = array('name' => 'Add Route', 'url' => '');
						$this->data['breadcrumb'] = $breadcrumb;
						$this->data['current_page'] = 'route_add';
				}

				// Start: Process launch route
				$this->process_launch_route();
				// End: Process launch route

        $this->load->view('templates/header', $this->data);
				$this->load->view('templates/sidebar', $this->data);
        $this->load->view('admin/launch/route/'.$display, $this->data);
        $this->load->view('templates/footer', $this->data);
		}

		//Process Route Info
    private function process_launch_route(){
      //Add New Company
      if(($this->input->post('register_new_route') !== NULL) || ($this->input->post('update_route') !== NULL)){
          $this->form_validation->set_rules('route', 'Route Name', 'trim|required|htmlspecialchars|min_length[4]');
          $this->form_validation->set_rules('place_1', 'Place Start', 'trim|required');
          $this->form_validation->set_rules('place_2', 'Place End', 'trim|required');

					$route_path = '';
					$route_search = '';

					$route_via_comma_places = '';
					$route_via_dash_places = '';
					if($this->input->post('route_via_places') !== NULL){
						$route_via_places = $this->input->post('route_via_places');
						$route_via_dash_places = implode('-', $route_via_places);
						$route_via_comma_places = implode(', ', $route_via_places);
					}

					$route_path_reorder_dash_str = '';
					$route_path_reorder_comma_str = '';
					if($this->input->post('route_path_order') !== NULL){
						$route_path_order_arr = json_decode($this->input->post('route_path_order'));
						$route_path_reorder = array();
						foreach ($route_path_order_arr as $reorder_place) {
							$route_path_reorder[] = $reorder_place->id;
						}
						$route_path_reorder_dash_str = implode('-', $route_path_reorder);
						$route_path_reorder_comma_str = implode(', ', $route_path_reorder);
					}

					if($this->input->post('update_route') !== NULL){
							$route_path = $route_path_reorder_dash_str;
							$route_search = $route_path_reorder_comma_str;
							if($this->input->post('route_via_places') !== NULL){
								$route_path = $route_via_dash_places;
								$route_search = $route_via_comma_places;
							}
					}else{
							$route_path = $route_via_dash_places;
							$route_search = $route_via_comma_places;
					}

          if( !$this->form_validation->run() ) {
  					$error_message_array = $this->form_validation->error_array();
  					$this->session->set_flashdata('error_msg_arr', $error_message_array);
  				}else{
            $data_arr = array(
              'route'=> trim($this->input->post('route')),
              'place_1'=> trim($this->input->post('place_1')),
              'place_2'=> trim($this->input->post('place_2')),
              'route_path'=> trim($route_path),
							'route_search'=> trim($route_search),
            );

            if(($this->input->post('update_route_id') !== NULL) && ($this->input->post('update_route') !== NULL)){
                $route_id = $this->input->post('update_route_id');
                $this->common->update( 'launch_route', $data_arr, array( 'route_id' =>  $route_id ) );
      					$this->session->set_flashdata('success_msg','Updated done!');
                redirect('admin/launch/route');
            }else{
              $route_id = $this->common->insert( 'launch_route', $data_arr );
              $this->session->set_flashdata('success_msg','Added done! Please re-order route path!');
              redirect('admin/launch/route/edit/'.encrypt($route_id));
            }



  				}
      }

    }//EOF process route info



		public function schedule($display = 'schedule', $schedule_solt_id = 0)
		{

				$this->data['css_files'] = array(
					base_url('assets/global/plugins/datatables/datatables.min.css'),
					base_url('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css'),
	        base_url('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css'),
	        base_url('assets/global/plugins/select2/css/select2.min.css'),
	        base_url('assets/global/plugins/select2/css/select2-bootstrap.min.css'),
					base_url('assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css'),
					base_url('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css'),
	      );

	      $this->data['js_files'] = array(
					base_url('assets/global/scripts/datatable.js'),
					base_url('assets/global/plugins/datatables/datatables.min.js'),
					base_url('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js'),
					base_url('seatassets/js/table-datatables-responsive.js'),
	        base_url('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js'),
	        base_url('assets/global/plugins/select2/js/select2.full.min.js'),
	        base_url('assets/global/plugins/jquery-validation/js/jquery.validate.min.js'),
					base_url('assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js'),
					base_url('assets/pages/scripts/components-date-time-pickers.min.js'),
					base_url('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js'),
	      );

				$this->data['launch_arr'] = $this->get_launch_arr();
				$this->data['launch_route_arr'] = $this->get_launch_route_arr();

				if($display == 'schedule'){
						$this->data['title'] = 'Launch schedule';
						$breadcrumb[] = array('name' => 'Launch', 'url' => 'admin/launch');
						$breadcrumb[] = array('name' => 'Schedule', 'url' => '');
						$this->data['breadcrumb'] = $breadcrumb;
						$this->data['current_page'] = 'schedule';

						$join_arr_left = array(
							'launch_route lr' => 'ls.route_id = lr.route_id',
							'launch l' => 'ls.launch_id = l.ID',
						);
						$order_by = 'sche_id ';
						$order = 'DESC ';
						$sort = $order_by.' '.$order;
						$result = $this->common->get_all( 'launch_schedule ls', '', 'ls.*, l.launch_name, lr.route_path', $sort, '', '', $join_arr_left );
						$this->data['launch_schedule_rows'] = $result;
				}

				if($display == 'register'){
						$this->data['title'] = 'Add schedule';
						$breadcrumb[] = array('name' => 'Launch', 'url' => 'admin/launch');
						$breadcrumb[] = array('name' => 'Schedule', 'url' => 'admin/launch/schedule');
						$breadcrumb[] = array('name' => 'Add Schedule', 'url' => '');
						$this->data['breadcrumb'] = $breadcrumb;
						$this->data['current_page'] = 'schedule_add';
				}

				if($display == 'edit'){
					//Get route ID of this Entry
		      $schedule_id = decrypt($schedule_solt_id)*1;
					if( !is_int($schedule_id) || !$schedule_id ) {
		        $this->session->set_flashdata('delete_msg','Can not be edited');
						redirect('admin/launch/schedule');
					}else{
							$schedule_details = $this->common->get( 'launch_schedule', array( 'sche_id' => $schedule_id ), 'array' );
							$this->data['schedule_data'] = $schedule_details;
							$schedule_launch_details = $this->common->get( 'launch', array( 'ID' => $schedule_details['launch_id'] ), 'array' );
							$this->data['schedule_launch_data'] = $schedule_launch_details;
			        $this->data['title'] = 'Edit Schedule';
							$breadcrumb[] = array('name' => 'Launch', 'url' => 'admin/launch');
							$breadcrumb[] = array('name' => 'Schedule', 'url' => 'admin/launch/schedule');
							$breadcrumb[] = array('name' => 'Edit Schedule', 'url' => '');
							$this->data['breadcrumb'] = $breadcrumb;
							$this->data['current_page'] = 'schedule_edit';
						}
				}

				if($display == 'delete'){
					//Get route ID of this Entry
		      $schedule_id = decrypt($schedule_solt_id)*1;
					if( !is_int($schedule_id) || !$schedule_id ) {
		        $this->session->set_flashdata('delete_msg','Can not be deleted!');
						redirect('admin/launch/schedule');
					}else{
						$this->common->delete( 'launch_schedule', array( 'sche_id' =>  $schedule_id ) );
						$this->session->set_flashdata('delete_msg','Schedule has been deleted!');
						redirect('admin/launch/schedule');
						}
				}

				// Start: Process launch schedule
				$this->process_launch_schedule();
				// End: Process launch schedule

        $this->load->view('templates/header', $this->data);
				$this->load->view('templates/sidebar', $this->data);
        $this->load->view('admin/launch/schedule/'.$display, $this->data);
        $this->load->view('templates/footer', $this->data);
		}

		//Process schedule Info
    private function process_launch_schedule(){
      //Add New Company
      if(($this->input->post('register_new_schedule') !== NULL) || ($this->input->post('update_schedule') !== NULL)){

					$this->form_validation->set_rules('launch_id', 'Select Launch', 'trim|required');
          $this->form_validation->set_rules('date', 'Travel Date', 'trim|required|min_length[10]');
          $this->form_validation->set_rules('route_id', 'Select Route', 'trim|required');
					$this->form_validation->set_rules('time_start', 'Leaving time', 'trim|required|htmlspecialchars');
          $this->form_validation->set_rules('time_end', 'Arrival Time', 'trim|required|htmlspecialchars');
					$this->form_validation->set_rules('start_from', 'Start From', 'trim|required|htmlspecialchars');
					$this->form_validation->set_rules('destination_to', 'Destination To', 'trim|required|htmlspecialchars');


					$route_id = $this->input->post('route_id');
					$launch_route_array = $this->get_launch_route_arr();
					$route_name = '';
					$route_path = '';
					if(isset($launch_route_array[$route_id]['route'])){
						$route_name = $launch_route_array[$route_id]['route'];
						$route_path = $launch_route_array[$route_id]['route_path'];
					}


          if( !$this->form_validation->run() ) {
  					$error_message_array = $this->form_validation->error_array();
  					$this->session->set_flashdata('error_msg_arr', $error_message_array);
  				}else{
            $data_arr = array(
              'launch_id'=> trim($this->input->post('launch_id')),
              'date'=> trim($this->input->post('date')),
              'route_id'=> trim($this->input->post('route_id')),
							'start_from'=> trim($this->input->post('start_from')),
							'destination_to'=> trim($this->input->post('destination_to')),
              'start_time'=> trim($this->input->post('time_start')),
              'destination_time'=> trim($this->input->post('time_end')),
							'updated_at' => date('Y-m-d H:i:s'),
							'updated_by' => $this->session->userdata('user_id'),
            );

            if(($this->input->post('update_schedule_id') !== NULL) && ($this->input->post('update_schedule') !== NULL)){
                $sche_id = $this->input->post('update_schedule_id');
                $this->common->update( 'launch_schedule', $data_arr, array( 'sche_id' =>  $sche_id ) );
      					$this->session->set_flashdata('success_msg','Updated done!');
								redirect('admin/launch/schedule/edit/'.encrypt($sche_id));
								exit;
            }else{
              $sche_id = $this->common->insert( 'launch_schedule', $data_arr );
              $this->session->set_flashdata('success_msg','Added done! Please Update Dropping Time');
							redirect('admin/launch/schedule/edit/'.encrypt($sche_id));
							exit;
            }

  				}
      }


			if((isset($_POST['update_droping_place_time'])) && (isset($_POST['update_schedule_id']))){
				$place_time_to_drop = $this->input->post('place_time_to_drop');
				$route_places_to_drop = $this->input->post('route_places_to_drop');
				$route_places_to_drop = explode(',', $route_places_to_drop);
				$place_vs_time = array_combine($route_places_to_drop, $place_time_to_drop);
				$place_vs_time_data = json_encode($place_vs_time);
				//$place_vs_time_data = json_decode($place_vs_time_data, TRUE);
				$update_schedule_id = $this->input->post('update_schedule_id');

				$time_data_arr = array(
					'dropping_place_time' => $place_vs_time_data,
				);

				$this->common->update( 'launch_schedule', $time_data_arr, array( 'sche_id' =>  $update_schedule_id ) );
				$this->session->set_flashdata('success_msg','Update done!');
				redirect('admin/launch/schedule/edit/'.encrypt($update_schedule_id));
				exit;
			}

    }//EOF process schedule info


		public function register(){

			$this->data['css_files'] = array(
				base_url('assets/global/plugins/select2/css/select2.min.css'),
				base_url('assets/global/plugins/select2/css/select2-bootstrap.min.css'),
				base_url('assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css'),
			);
			$this->data['js_files'] = array(
				base_url('assets/global/plugins/select2/js/select2.full.min.js'),
				base_url('assets/global/plugins/jquery-validation/js/jquery.validate.min.js'),
				base_url('assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js'),
				base_url('assets/pages/scripts/components-date-time-pickers.min.js'),
			);


			//Start: Process area info
      $this->process_launch_register_info();
      //End: Process area info


			$this->data['launch_route_arr'] = $this->get_launch_route_arr();

			$this->data['title'] = 'Register New Launch';
			$breadcrumb[] = array('name' => 'Launch', 'url' => 'admin/launch');
			$breadcrumb[] = array('name' => 'New Launch', 'url' => '');
			$this->data['breadcrumb'] = $breadcrumb;
			$this->data['current_page'] = 'register_launch';

			$this->load->view('templates/header', $this->data);
			$this->load->view('templates/sidebar', $this->data);
			$this->load->view('admin/launch/register', $this->data);
			$this->load->view('templates/footer', $this->data);

		}

		public function edit($launch_salt_id = 0){
			//Get launch ID
			$launch_id = decrypt($launch_salt_id)*1;
			if( !is_int($launch_id) || !$launch_id ) {
					redirect('admin/launch');
			}

			$this->data['launch_id'] = $launch_id;

			$this->data['css_files'] = array(
				base_url('assets/global/plugins/select2/css/select2.min.css'),
				base_url('assets/global/plugins/select2/css/select2-bootstrap.min.css'),
				base_url('assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css'),
			);
			$this->data['js_files'] = array(
				base_url('assets/global/plugins/select2/js/select2.full.min.js'),
				base_url('assets/global/plugins/jquery-validation/js/jquery.validate.min.js'),
				base_url('assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js'),
				base_url('assets/pages/scripts/components-date-time-pickers.min.js'),
			);


			//Start: Process area info
      $this->process_launch_register_info();
      //End: Process area info


			$this->data['launch_route_arr'] = $this->get_launch_route_arr();

			$this->data['title'] = 'Edit Launch';
			$breadcrumb[] = array('name' => 'Launch', 'url' => 'admin/launch');
			$breadcrumb[] = array('name' => 'Edit Launch', 'url' => '');
			$this->data['breadcrumb'] = $breadcrumb;
			$this->data['current_page'] = 'edit_launch';

			$this->load->view('templates/header', $this->data);
			$this->load->view('templates/sidebar', $this->data);
			$this->load->view('admin/launch/edit', $this->data);
			$this->load->view('templates/footer', $this->data);

		}


		public function delete($launch_salt_id = 0)
		{

				//Get launch ID
				$launch_id = decrypt($launch_salt_id)*1;
				if( !is_int($launch_id) || !$launch_id ) {
						redirect('admin/launch');
				}else{
						$this->common->delete( 'launch', array( 'ID' =>  $launch_id ) );
						$this->session->set_flashdata('delete_msg','Launch has been deleted!');
						redirect('admin/launch');
				}

		}

		//Process Launch Register
		private function process_launch_register_info(){
			//Add New launch or update launch info
			if((isset($_POST['register_new_launch'])) || (isset($_POST['update_launch']))){
					$this->form_validation->set_rules('launch_name', 'Launch name', 'trim|required|htmlspecialchars|min_length[2]');
					$this->form_validation->set_rules('time_start_place_1', 'Place one leaving time', 'trim|required|htmlspecialchars');
					$this->form_validation->set_rules('time_end_place_1', 'Place one arrival time', 'trim|required|htmlspecialchars');
					$this->form_validation->set_rules('time_start_place_2', 'Place two leaving time', 'trim|required|htmlspecialchars|min_length[2]');
					$this->form_validation->set_rules('time_end_place_2', 'Place two arrival time', 'trim|required|htmlspecialchars|min_length[2]');
					$this->form_validation->set_rules('company_id', 'Company Name', 'trim|required|htmlspecialchars');
					$this->form_validation->set_rules('route_id', 'Route', 'trim|required|htmlspecialchars');
					$this->form_validation->set_rules('total_cabin', 'Total Cabin', 'trim|required|htmlspecialchars');
					$this->form_validation->set_rules('total_capacity', 'Total Capacity', 'trim|required|htmlspecialchars');
					$this->form_validation->set_rules('register_info', 'Register Info', 'trim|htmlspecialchars');

					$route_id = $this->input->post('route_id');
					$launch_route_array = $this->get_launch_route_arr();
					$route_name = '';
					$route_path = '';
					$place_1 = '';
					$place_2 = '';
					if(isset($launch_route_array[$route_id]['route'])){
						$route_name = $launch_route_array[$route_id]['route'];
						$route_path = $launch_route_array[$route_id]['route_path'];
						$place_1 = $launch_route_array[$route_id]['place_1'];
						$place_2 = $launch_route_array[$route_id]['place_2'];
					}

					$data_arr = array(
						'launch_name'=> trim($this->input->post('launch_name')),
						'place_1'=> $place_1,
						'time_start_place_1'=> trim($this->input->post('time_start_place_1')),
						'time_end_place_1'=> trim($this->input->post('time_end_place_1')),
						'place_2'=> $place_2,
						'time_start_place_2'=> trim($this->input->post('time_start_place_2')),
						'time_end_place_2'=> trim($this->input->post('time_end_place_2')),
						'company_id'=> trim($this->input->post('company_id')),
						'route_id'=> trim($this->input->post('route_id')),
						'total_cabin'=> trim($this->input->post('total_cabin')),
						'total_capacity'=> trim($this->input->post('total_capacity')),
						'register_info'=> trim($this->input->post('register_info')),
					);

					if( !$this->form_validation->run() ) {
						$error_message_array = $this->form_validation->error_array();
						$this->session->set_flashdata('error_msg_arr', $error_message_array);
					}elseif((isset($_POST['update_launch_id'])) && (isset($_POST['update_launch']))){
						$launch_id = $this->input->post('update_launch_id');
						$this->common->update( 'launch', $data_arr, array( 'ID' =>  $launch_id ) );
						$this->session->set_flashdata('success_msg','Update done!');
						redirect('admin/launch/edit/'.encrypt($launch_id));
						exit;
					}else{
						$launch_id = $this->common->insert( 'launch', $data_arr );
						$this->session->set_flashdata('success_msg','Added done! Please update dropping time.');
						redirect('admin/launch/edit/'.encrypt($launch_id));
						exit;
					}
			}


			if((isset($_POST['update_droping_time_p1_to_p2'])) && (isset($_POST['update_launch_id']))){
				$place_1_drop = $this->input->post('place_1_drop');
				$p1_to_p2 = $this->input->post('p1_to_p2');
				$p1_to_p2 = explode(',', $p1_to_p2);
				$place_vs_time = array_combine($p1_to_p2, $place_1_drop);
				$place_vs_time_data = json_encode($place_vs_time);
				//$place_vs_time_data = json_decode($place_vs_time_data, TRUE);
				$update_launch_id = $this->input->post('update_launch_id');

				$time_data_arr = array(
					'dropping_p1_to_p2' => $place_vs_time_data,
				);

				$this->common->update( 'launch', $time_data_arr, array( 'ID' =>  $update_launch_id ) );
				$this->session->set_flashdata('success_msg','Update done!');
				redirect('admin/launch/edit/'.encrypt($update_launch_id));
				exit;
			}

			if((isset($_POST['update_droping_time_p2_to_p1'])) && (isset($_POST['update_launch_id']))){
				$place_2_drop = $this->input->post('place_2_drop');
				$p2_to_p1 = $this->input->post('p2_to_p1');
				$p2_to_p1 = explode(',', $p2_to_p1);
				$place_vs_time = array_combine($p2_to_p1, $place_2_drop);
				$place_vs_time_data = json_encode($place_vs_time);
				//$place_vs_time_data = json_decode($place_vs_time_data, TRUE);
				$update_launch_id = $this->input->post('update_launch_id');

				$time_data_arr = array(
					'dropping_p2_to_p1' => $place_vs_time_data,
				);

				$this->common->update( 'launch', $time_data_arr, array( 'ID' =>  $update_launch_id ) );
				$this->session->set_flashdata('success_msg','Update done!');
				redirect('admin/launch/edit/'.encrypt($update_launch_id));
				exit;
			}

		}//EOF process launch regisetr


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

}
