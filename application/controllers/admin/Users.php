<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends RM_Controller {
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
					base_url('seatassets/js/users.js?ver=1.0.1'),
				);

				//$this->get_all();

				$this->load->view('templates/header', $this->data);
				$this->load->view('templates/sidebar', $this->data);
				$this->load->view('admin/users/index',$this->data);
				$this->load->view('templates/footer', $this->data);
		}


		public function get_all_users(){

			$keyword = '';
			if( isset( $_REQUEST['search']['value'] ) && $_REQUEST['search']['value'] != '' ) {
				$keyword = $_REQUEST['search']['value'];
			}

			$join_arr_left = array();


			$condition = '1=1 ';
			if( $keyword != '' ) {
				$condition .= ' AND (t.first_name LIKE "%'.$keyword.'%" OR t.last_name LIKE "%'.$keyword.'%" OR t.email LIKE "%'.$keyword.'%")';
			}

			if( isset($_REQUEST['name']) && $_REQUEST['name'] ) {
				$condition .= ' AND ( t.first_name LIKE "%'.$_REQUEST['name'].'%" OR t.last_name LIKE "%'.$_REQUEST['name'].'%" )';
			}

			if( isset($_REQUEST['email']) && $_REQUEST['email'] ) {
				$condition .= ' AND t.email LIKE "%'.$_REQUEST['email'].'%"';
			}

			if( isset($_REQUEST['user_role']) && $_REQUEST['user_role'] ) {
				$condition .= ' AND t.user_role LIKE "%'.$_REQUEST['user_role'].'%"';
			}

			if( isset($_REQUEST['is_active']) && $_REQUEST['is_active'] ) {
				$condition .= ' AND t.is_active = "'.$_REQUEST['is_active'].'"';
			}

			if( isset($_REQUEST['created_at']) && $_REQUEST['created_at'] ) {
				$bDate = new DateTime( $_REQUEST['created_at'] );
				$created_at = $bDate->format('Y-m-d');
				$condition .= ' AND DATE_FORMAT(`t`.`created_at`,"%Y-%m-%d") = "'.$created_at.'"';

			}


			$iTotalRecords = $this->common->get_total_count( 'users t', $condition, $join_arr_left );


		  $iDisplayLength = intval($_REQUEST['length']);
		  $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
		  $iDisplayStart = intval($_REQUEST['start']);
		  $sEcho = intval($_REQUEST['draw']);

		  $records = array();
		  $records["data"] = array();

			$limit = $iDisplayLength;
			$offset = $iDisplayStart;

			$columns = array(
				1 => 'name',
				2 => 'email',
				3 => 'user_role',
				4 => 'is_active',
				5 => 'reg_date',
			);

			$order_by = $columns[$_REQUEST['order'][0]['column']];
			$order = $_REQUEST['order'][0]['dir'];
			$sort = $order_by.' '.$order;

			$result = $this->common->get_all( 'users t', $condition, 't.*', $sort, $limit, $offset, $join_arr_left );

			//print_r($result);

		  $status_list = array(
		    array("success" => "Pending"),
		    array("info" => "Closed"),
		    array("danger" => "On Hold"),
		    array("warning" => "Fraud")
		  );

			$status_list = array(
		    array("success" => "Pending"),
		    array("info" => "Closed"),
		    array("danger" => "On Hold"),
		    array("warning" => "Fraud")
		  );

			foreach( $result as $row ) {
				if( $row->profile_photo && file_exists( getcwd().'/files/media/'.$row->profile_photo ) ){
						$image = '<img class="user-pic rounded" src="'.base_url('/files/media/'.$row->profile_photo).'" width="28">';
				} else {
						$image = '<img class="user-pic rounded" src="'.base_url('seatassets/images/placeholder-profile-photo.jpg').'" width="28">';
				}
				$user_first_last_name = $row->first_name.' '.$row->last_name;
				$user_email = '<a href="mailto:'.$row->email.'">'.$row->email.'</a>';
				$regsiterd_date = date('M d, Y', strtotime($row->created_at));
				$user_role = get_user_role($row->user_role);
				$status_name = get_user_status($row->is_active);
				$status_class = get_user_status_class($row->is_active);

				$status = '<span class="label label-sm label-'.$status_class.'">'.$status_name.'</span>';

				//$status = $status_list[rand(0, 2)];
				$records["data"][] = array(
					'<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input name="id[]" type="checkbox" class="checkboxes" value="'.$row->ID.'"/><span></span></label>',
					$image,
					$user_first_last_name,
					$user_email,
					$user_role,
					$status,
					$regsiterd_date,
					'<div class="center-block"><a href="'.site_url('admin/users/edit/'.encrypt($row->ID)).'" title="Edit"><i class="fa fa-edit font-blue-ebonyclay"></i></a>&nbsp;&nbsp;<a href="javascript:;" class="user-delete"  data-url="'.site_url('admin/users/delete/'.encrypt($row->ID)).'" title="Delete"><i class="fa fa-trash-o text-danger"></i></a></div>',
			 );
			}

/*
			foreach( $result as $row ) {
					if( $row->profile_photo && file_exists( getcwd().'/files/media/'.$row->profile_photo ) ){
							$image = '<img class="user-pic rounded" src="'.base_url('/files/media/'.$row->profile_photo).'" width="28">';
					} else {
							$image = '<img class="user-pic rounded" src="'.base_url('seatassets/images/placeholder-profile-photo.jpg').'" width="28">';
					}
					$actions =  '<div class="center-block"><a href="'.site_url('admin/users/edit/'.encrypt($row->ID)).'" title="Edit"><i class="fa fa-edit font-blue-ebonyclay"></i></a>&nbsp;&nbsp;<a href="javascript:;" class="user-delete"  data-url="'.site_url('admin/users/delete/'.encrypt($row->ID)).'" title="Delete"><i class="fa fa-trash-o text-danger"></i></a></div>';
					$status = $status_list[rand(0, 2)];
					$records["data"][] = array(
					  '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input name="id[]" type="checkbox" class="checkboxes" value="'.$row->ID.'"/><span></span></label>',
						$image,
					  $row->first_name.' '.$row->last_name,
						'<a href="mailto:'.$row->email.'">'.$row->email.'</a>',
					  '<span class="label label-sm label-'.(key($status)).'">'.(current($status)).'</span>',
						date('M d, Y', strtotime($row->created_at)),
					  $actions,
					);
			}
*/



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

		public function edit( $user_salt_id = 0) {
			$id = decrypt($user_salt_id)*1;
			if( !is_int($id) || !$id ) {
				redirect('/admin/users');
			}

		}

		public function get_all___()
		{


			$keyword = '';
			if( isset( $_REQUEST['search']['value'] ) && $_REQUEST['search']['value'] != '' ) {
				$keyword = $_REQUEST['search']['value'];
			}

			$join_arr_left = array();


			$condition = '';
			if( $keyword != '' ) {
				$condition .= ' AND (t.first_name LIKE "%'.$keyword.'%" OR t.last_name LIKE "%'.$keyword.'%" OR t.email LIKE "%'.$keyword.'%")';
			}

			if( isset($_REQUEST['name']) && $_REQUEST['name'] ) {
				$condition .= ' AND ( t.first_name LIKE "%'.$_REQUEST['name'].'%" OR t.last_name LIKE "%'.$_REQUEST['name'].'%" )';
			}

			if( isset($_REQUEST['email']) && $_REQUEST['email'] ) {
				$condition .= ' AND t.email LIKE "%'.$_REQUEST['email'].'%"';
			}

			if( isset($_REQUEST['is_active']) && $_REQUEST['is_active'] ) {
				$condition .= ' AND t.is_active = "'.$_REQUEST['is_active'].'"';
			}

			if( isset($_REQUEST['created_at']) && $_REQUEST['created_at'] ) {
				$bDate = new DateTime( $_REQUEST['created_at'] );
				$created_at = $bDate->format('Y-m-d');
				$condition .= ' AND DATE_FORMAT(`t`.`created_at`,"%Y-%m-%d") = "'.$created_at.'"';

			}


			$iTotalRecords = $this->common->get_total_count( 'users t', $condition, $join_arr_left );
			$_REQUEST['length'] = 20;
			$_REQUEST['start'] = 0;
			$_REQUEST['draw'] = 1;
			$iDisplayLength = intval($_REQUEST['length']);
			$iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
			$iDisplayStart = intval($_REQUEST['start']);
			$sEcho = intval($_REQUEST['draw']);

			$records = array();
			$records["data"] = array();

			$limit = $iDisplayLength;
			$offset = $iDisplayStart;

			$columns = array(
				1 => 'first_name',
				2 => 'email',
				4 => 'is_active',
				5 => 'created_at',
			);

			//$order_by = $columns[$_REQUEST['order'][0]['column']];
			//$order = $_REQUEST['order'][0]['dir'];
			//$sort = $order_by.' '.$order;
			$sort = 'email asc';

			$result = $this->common->get_all( 'users t', $condition, 't.*', $sort, $limit, $offset, $join_arr_left );

			//echo $this->db->last_query(); exit;

			foreach( $result as $row ) {

				if( $row->profile_photo && file_exists( getcwd().'/files/media/'.$row->profile_photo ) ){
									$image = '<img class="user-pic rounded" src="'.base_url('/files/media/'.$row->profile_photo).'" width="28">';
							} else {
									$image = '<img class="user-pic rounded" src="'.base_url('seatassets/images/placeholder-profile-photo.jpg').'" width="28">';
							}
								$actions =  '<div class="center-block"><a href="'.site_url('admin/users/edit/'.encrypt($row->ID)).'" title="Edit"><i class="fa fa-edit font-blue-ebonyclay"></i></a><a href="javascript:;" class="user-delete"  data-url="'.site_url('admin/users/delete/'.encrypt($row->ID)).'" title="Delete"><i class="fa fa-trash-o text-danger"></i></a></div>';



				$records["data"][] = array(
					$image,
					$row->first_name.' '.$row->last_name,
					'<a href="mailto:'.$row->email.'">'.$row->email.'</a>',
					get_user_status($row->is_active),
					date('M d, Y', strtotime($row->created_at)),
					$actions,
				);
			}



			$records["draw"] = $sEcho;
			$records["recordsTotal"] = $iTotalRecords;
			$records["recordsFiltered"] = $iTotalRecords;

			//print_r($records);

			header('Content-type: application/json');
			echo json_encode($records);
		}

}
