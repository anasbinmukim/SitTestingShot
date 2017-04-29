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
