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
        $this->data['title'] = 'Launch Booking'; // Capitalize the first letter

        $this->load->view('templates/header', $this->data);
				$this->load->view('templates/sidebar', $this->data);
        $this->load->view('launch/launch', $this->data);
        $this->load->view('templates/footer', $this->data);
		}

		public function route($display = 'route', $route_solt_id = 0)
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

				if($display == 'route'){
		        $this->data['title'] = 'Launch Route'; // Capitalize the first letter
						$result = $this->common->get_all( 'launch_route' );
						$this->data['launch_route_rows'] = $result;
				}

				if($display == 'edit'){
					//Get route ID of this Entry
		      $row_id = decrypt($route_solt_id)*1;
					if( !is_int($row_id) || !$row_id ) {
		        $this->session->set_flashdata('delete_msg','Can not be edited');
						redirect('/launch/route');
					}else{
							$route_details = $this->common->get( 'launch_route', array( 'route_id' => $row_id ), 'array' );
							$this->data['route_data'] = $route_details;
			        $this->data['title'] = 'Edit Route';
						}
				}

				if($display == 'delete'){
					//Get route ID of this Entry
		      $row_id = decrypt($route_solt_id)*1;
					if( !is_int($row_id) || !$row_id ) {
		        $this->session->set_flashdata('delete_msg','Can not be deleted!');
						redirect('/launch/route');
					}else{
						$this->common->delete( 'launch_route', array( 'route_id' =>  $row_id ) );
						$this->session->set_flashdata('delete_msg','Route has been deleted!');
						redirect('/launch/route');
						}
				}

				// Start: Process launch route
				$this->process_launch_route();
				// End: Process launch route

        $this->load->view('templates/header', $this->data);
				$this->load->view('templates/sidebar', $this->data);
        $this->load->view('launch/route/'.$display, $this->data);
        $this->load->view('templates/footer', $this->data);
		}

		//Process Route Info
    private function process_launch_route(){
      //Add New Company
      if(($this->input->post('register_new_route') !== NULL) || ($this->input->post('update_route') !== NULL)){
          $this->form_validation->set_rules('route', 'Route Name', 'trim|required|htmlspecialchars|min_length[4]');
          $this->form_validation->set_rules('place_1', 'Place Start', 'trim|required|htmlspecialchars|min_length[2]');
          $this->form_validation->set_rules('place_2', 'Place End', 'trim|required|htmlspecialchars|min_length[2]');
					$this->form_validation->set_rules('route_path', 'Route Path', 'trim|htmlspecialchars');
          $this->form_validation->set_rules('route_search', 'Route Search', 'trim|htmlspecialchars');

          if( !$this->form_validation->run() ) {
  					$error_message_array = $this->form_validation->error_array();
  					$this->session->set_flashdata('error_msg_arr', $error_message_array);
  				}else{
            $data_arr = array(
              'route'=> trim($this->input->post('route')),
              'place_1'=> trim($this->input->post('place_1')),
              'place_2'=> trim($this->input->post('place_2')),
              'route_path'=> trim($this->input->post('route_path')),
              'route_search'=> trim($this->input->post('route_search')),
            );

            if(($this->input->post('update_route_id') !== NULL) && ($this->input->post('update_route') !== NULL)){
                $route_id = $this->input->post('update_route_id');
                $this->common->update( 'launch_route', $data_arr, array( 'route_id' =>  $route_id ) );
      					$this->session->set_flashdata('success_msg','Updated done!');
                redirect('/launch/route');
            }else{
              $route_id = $this->common->insert( 'launch_route', $data_arr );
              $this->session->set_flashdata('success_msg','Added done!');
              redirect('/launch/route');
            }



  				}
      }

    }//EOF process route info


		public function register(){
			$this->data['title'] = 'Register New Launch'; // Capitalize the first letter

			$this->load->view('templates/header', $this->data);
			$this->load->view('templates/sidebar', $this->data);
			$this->load->view('launch/register_new_launch', $this->data);
			$this->load->view('templates/footer', $this->data);

		}


		public function manage_booking(){
			$this->data['title'] = 'Manage Booking'; // Capitalize the first letter

			$this->data['css_files'] = array(
				base_url('assets/global/plugins/datatables/datatables.min.css'),
				base_url('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css'),
				base_url('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css'),
			);
			$this->data['js_files'] = array(
				base_url('assets/global/scripts/datatable.js'),
				base_url('assets/global/plugins/datatables/datatables.min.js'),
				base_url('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js'),
				base_url('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js'),
				base_url('seatassets/js/table-launch-booking-ajax.js?ver=1.0.1'),
			);

			//$this->manage_booking_rowdata();

			$this->load->view('templates/header', $this->data);
			$this->load->view('templates/sidebar', $this->data);
			$this->load->view('launch/manage_booking', $this->data);
			$this->load->view('templates/footer', $this->data);

		}


		public function manage_booking_rowdata(){
			$iTotalRecords = 178;
		  $iDisplayLength = intval($_REQUEST['length']);
		  $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
		  $iDisplayStart = intval($_REQUEST['start']);
		  $sEcho = intval($_REQUEST['draw']);

		  $records = array();
		  $records["data"] = array();

		  $end = $iDisplayStart + $iDisplayLength;
		  $end = $end > $iTotalRecords ? $iTotalRecords : $end;

		  $status_list = array(
		    array("success" => "Pending"),
		    array("info" => "Closed"),
		    array("danger" => "On Hold"),
		    array("warning" => "Fraud")
		  );

		  for($i = $iDisplayStart; $i < $end; $i++) {
		    $status = $status_list[rand(0, 2)];
		    $id = ($i + 1);
		    $records["data"][] = array(
		      '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input name="id[]" type="checkbox" class="checkboxes" value="'.$id.'"/><span></span></label>',
		      $id,
		      '12/09/2013',
		      'Jhon Doe',
		      'Jhon Doe',
		      '450.60$',
		      rand(1, 10),
		      '<span class="label label-sm label-'.(key($status)).'">'.(current($status)).'</span>',
		      '<a href="javascript:;" class="btn btn-sm btn-outline grey-salsa"><i class="fa fa-search"></i> View</a>',
		   );
		  }

		  if (isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action") {
		    $records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
		    $records["customActionMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
		  }

		  $records["draw"] = $sEcho;
		  $records["recordsTotal"] = $iTotalRecords;
		  $records["recordsFiltered"] = $iTotalRecords;
			//print_r($records);
			header('Content-type: application/json');
		  echo json_encode($records);
		}
}
