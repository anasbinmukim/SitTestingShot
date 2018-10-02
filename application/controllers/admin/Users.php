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
		public function all($user_role = NULL)
		{

				if(($user_role != NULL)){
					$this->data['title'] = 'All '. $user_role;
					$breadcrumb[] = array('name' => 'All Users', 'url' => '/admin/users/all');
					$breadcrumb[] = array('name' => 'All '.$user_role, 'url' => '');
					$this->data['breadcrumb'] = $breadcrumb;
					$this->data['current_page'] = 'user';
					$this->data['user_role'] = $user_role;
				}else{
					$this->data['title'] = 'All Users';
					$breadcrumb[] = array('name' => 'All Users', 'url' => '');
					$this->data['breadcrumb'] = $breadcrumb;
					$this->data['current_page'] = 'user';
					$this->data['user_role'] = '';
				}


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

				$this->load->view('templates/header', $this->data);
				$this->load->view('templates/sidebar', $this->data);
				$this->load->view('admin/users/all-users',$this->data);
				$this->load->view('templates/footer', $this->data);
		}

		function get_all($user_role = NULL)
		{


			$keyword = '';
			if( isset( $_REQUEST['search']['value'] ) && $_REQUEST['search']['value'] != '' ) {
				$keyword = $_REQUEST['search']['value'];
			}

			$join_arr_left = array();


			$condition = '1=1 AND t.deleted = 0 ';
			if( $keyword != '' ) {
				$condition .= ' AND (t.first_name LIKE "%'.$keyword.'%" OR t.last_name LIKE "%'.$keyword.'%" OR t.email LIKE "%'.$keyword.'%")';
			}

			if( isset($_REQUEST['name']) && $_REQUEST['name'] ) {
				$condition .= ' AND ( t.first_name LIKE "%'.$_REQUEST['name'].'%" OR t.last_name LIKE "%'.$_REQUEST['name'].'%" )';
			}

			if( isset($_REQUEST['email']) && $_REQUEST['email'] ) {
				$condition .= ' AND t.email LIKE "%'.$_REQUEST['email'].'%"';
			}

			if(($user_role != NULL)){
				$condition .= ' AND t.user_role LIKE "%'.$user_role.'%"';
			}else{
				if( isset($_REQUEST['user_role']) && $_REQUEST['user_role'] ) {
					$condition .= ' AND t.user_role LIKE "%'.$_REQUEST['user_role'].'%"';
				}
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
				1 => 'first_name',
				2 => 'email',
				3 => 'user_role',
				4 => 'is_active',
				5 => 'created_at',
			);


			$order_by = $columns[$_REQUEST['order'][0]['column']];
			$order = $_REQUEST['order'][0]['dir'];
			$sort = $order_by.' '.$order;

			$result = $this->common->get_all( 'users t', $condition, 't.*', $sort, $limit, $offset, $join_arr_left );

			foreach( $result as $row ) {

					if( $row->profile_photo && file_exists( getcwd().'/files/profile/'.$row->profile_photo ) ){
							$image = '<img class="user-pic rounded" src="'.base_url('/files/profile/'.$row->profile_photo).'" width="28">';
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

				$records["data"][] = array(
					$image,
					$user_first_last_name,
					$user_email,
					$user_role,
					$status,
					$regsiterd_date,
					'<div class="center-block"><a href="'.site_url('admin/users/edit/'.encrypt($row->ID)).'" title="Edit"><i class="fa fa-edit font-blue-ebonyclay"></i></a>&nbsp;&nbsp;<a href="javascript:;" class="user-delete"  data-url="'.site_url('admin/users/delete/'.encrypt($row->ID)).'" title="Delete"><i class="fa fa-trash-o text-danger"></i></a></div>',
				);
			}

			$records["draw"] = $sEcho;
			$records["recordsTotal"] = $iTotalRecords;
			$records["recordsFiltered"] = $iTotalRecords;

			header('Content-type: application/json');
			echo json_encode($records);
		}

		public function delete( $user_salt_id = 0 ) {
				if( $user_salt_id == '0' ) {
				}else {
						$user_id = decrypt($user_salt_id)*1;
						if( !is_int($user_id) || !$user_id ) {
						}else{
								$this->common->update( 'users', array('deleted' => 1, 'is_active' => 3), array( 'ID' =>  $user_id ) );
						}
				}
		}

		public function register() {

				$this->data['css_files'] = array(
					base_url('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css'),
					base_url('assets/pages/css/profile.min.css'),
				);

				$this->data['js_files'] = array(
					base_url('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js'),
					base_url('assets/global/plugins/jquery.sparkline.min.js'),
					base_url('assets/pages/scripts/profile.min.js'),
				);

				//Start: Process register new user
				$this->register_new_user();
				//End: Process register new user

				$this->data['title'] = 'New User';

				$this->load->view('templates/header', $this->data);
				$this->load->view('templates/sidebar', $this->data);
				$this->load->view('admin/users/register',$this->data);
				$this->load->view('templates/footer', $this->data);

		}


		private function register_new_user(){
			if(isset($_POST['add_new_user'])){
					$this->form_validation->set_rules('username', 'User Name', 'trim|required|min_length[4]|callback_username_check|htmlspecialchars',  array('is_unique' => 'This user name or phone number is already being used by someone.'));
					$this->form_validation->set_rules('first_name', 'First name', 'trim|required|htmlspecialchars');
					$this->form_validation->set_rules('last_name', 'Last name', 'trim|htmlspecialchars');
					$this->form_validation->set_rules('display_name', 'Display Name', 'trim|required|htmlspecialchars');
					$this->form_validation->set_rules('occupation', 'Occupation', 'trim|htmlspecialchars');
					$this->form_validation->set_rules('phone_home', 'Phone home', 'trim|htmlspecialchars');
					$this->form_validation->set_rules('phone_office', 'Phone office', 'trim|htmlspecialchars');
					$this->form_validation->set_rules('mobile', 'Mobile Number', 'trim|htmlspecialchars');
					$this->form_validation->set_rules('mobile_2', 'Alternate mobile number', 'trim|htmlspecialchars');
					$this->form_validation->set_rules('web_url', 'Website URL', 'trim|prep_url|htmlspecialchars');
					$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|callback_email_check',  array('is_unique' => 'This email is already being used by someone.'));
					$this->form_validation->set_rules('password', 'Password', 'trim|required|htmlspecialchars|min_length[4]');
					$this->form_validation->set_rules('conf_password', 'Re-Password', 'trim|required|htmlspecialchars|matches[password]');
					$this->form_validation->set_rules('user_role', 'User Role', 'trim|required|htmlspecialchars');

					$user_entered_password = md5( $this->config->item('encryption_key').trim($this->input->post('password')) );

					$user_arr = array(
						'user_name'=> trim($this->input->post('username')),
						'email'=> trim($this->input->post('email')),
						'first_name'=> trim($this->input->post('first_name')),
						'last_name' => trim($this->input->post('last_name')),
						'display_name' => trim($this->input->post('display_name')),
						'occupation' => trim($this->input->post('occupation')),
						'phone_home' => trim($this->input->post('phone_home')),
						'phone_office' => trim($this->input->post('phone_office')),
						'mobile' => trim($this->input->post('mobile')),
						'mobile_2' => trim($this->input->post('mobile_2')),
						'web_url' => trim($this->input->post('web_url')),
						'password'=> $user_entered_password,
						'is_active' => 1,
						'user_role' => trim($this->input->post('user_role')),
						'updated_at' => date('Y-m-d H:i:s'),
						'last_updated_by' => $this->session->userdata('user_id'),
					);




					if( !$this->form_validation->run() ) {
						$error_message_array = $this->form_validation->error_array();
						$this->session->set_flashdata('error_msg_arr', $error_message_array);
						$this->session->set_flashdata('error_msg', 'Added Failed!');
					}else{
						$this->common->insert('users', $user_arr);
						$this->session->set_flashdata('success_msg','Added done!');
						redirect('/admin/users');
					}
			}
		}




		public function edit( $user_salt_id = 0) {
				$user_id = decrypt($user_salt_id)*1;
				if( !is_int($user_id) || !$user_id ) {
					redirect('/admin/users');
				}

				$this->data['edit_user_id'] = $user_id;

				$this->data['css_files'] = array(
					base_url('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css'),
					base_url('assets/pages/css/profile.min.css'),
				);

				$this->data['js_files'] = array(
					base_url('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js'),
					base_url('assets/global/plugins/jquery.sparkline.min.js'),
					base_url('assets/pages/scripts/profile.min.js'),
				);

				//Start: Process edit profile info
				$this->update_edit_profile_info();
				//End: Process edit profile info

				$this->data['title'] = 'Edit Users';

				$this->load->view('templates/header', $this->data);
				$this->load->view('templates/sidebar', $this->data);
				$this->load->view('admin/users/edit',$this->data);
				$this->load->view('templates/footer', $this->data);

		}

		private function update_edit_profile_info(){
				if(isset($_POST['update_personal_info']) && isset($_POST['update_user_id'])){

					$this->form_validation->set_rules('first_name', 'First name', 'trim|required|htmlspecialchars');
					$this->form_validation->set_rules('last_name', 'Last name', 'trim|htmlspecialchars');
					$this->form_validation->set_rules('display_name', 'Display Name', 'trim|required|htmlspecialchars');
					$this->form_validation->set_rules('occupation', 'Occupation', 'trim|htmlspecialchars');
					$this->form_validation->set_rules('phone_home', 'Phone home', 'trim|htmlspecialchars');
					$this->form_validation->set_rules('phone_office', 'Phone office', 'trim|htmlspecialchars');
					$this->form_validation->set_rules('mobile', 'Mobile Number', 'trim|htmlspecialchars');
					$this->form_validation->set_rules('mobile_2', 'Alternate mobile number', 'trim|htmlspecialchars');
					$this->form_validation->set_rules('web_url', 'Website URL', 'trim|prep_url|htmlspecialchars');
					$this->form_validation->set_rules('bio_info', 'Bio Info', 'trim|htmlspecialchars');

					$update_user_id = $this->input->post('update_user_id');

					$user_profile = $this->common->get( 'users', array( 'ID' => $update_user_id ) );
					if($user_profile->email != $this->input->post('email')){
						$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|callback_email_check',  array('is_unique' => 'This email is already being used by someone.'));
					}

					$user_arr = array(
						'email'=> trim($this->input->post('email')),
						'first_name'=> trim($this->input->post('first_name')),
						'last_name' => trim($this->input->post('last_name')),
						'display_name' => trim($this->input->post('display_name')),
						'occupation' => trim($this->input->post('occupation')),
						'phone_home' => trim($this->input->post('phone_home')),
						'phone_office' => trim($this->input->post('phone_office')),
						'mobile' => trim($this->input->post('mobile')),
						'mobile_2' => trim($this->input->post('mobile_2')),
						'web_url' => trim($this->input->post('web_url')),
						'updated_at' => date('Y-m-d H:i:s'),
						'last_updated_by' => $this->session->userdata('user_id'),
					);
					if( !$this->form_validation->run() ) {
						$error_message_array = $this->form_validation->error_array();
						$this->session->set_flashdata('error_msg_arr', $error_message_array);
						$this->session->set_flashdata('error_msg', 'Updated Failed!');
					}else{
						$this->common->update('users', $user_arr, array( 'ID' => $update_user_id ));
						$this->common->update_user_meta($update_user_id, 'bio_info', trim($this->input->post('bio_info')));
						$this->session->set_flashdata('success_msg','Updated done! Please Reload!');
					}
				}

				//Reset user access info
				if(isset($_POST['update_user_access']) && isset($_POST['update_user_id'])){
						$this->form_validation->set_rules('is_active', 'User Status', 'trim|required|htmlspecialchars');
						$this->form_validation->set_rules('user_role', 'User Role', 'trim|required|htmlspecialchars');
						$update_user_id = $this->input->post('update_user_id');
						$user_arr = array(
							'is_active'=> $this->input->post('is_active'),
							'user_role'=> $this->input->post('user_role'),
						);
						if( !$this->form_validation->run() ) {
							$error_message_array = $this->form_validation->error_array();
							$this->session->set_flashdata('error_msg_arr', $error_message_array);
						}else{
							$this->common->update('users', $user_arr, array( 'ID' => $update_user_id ));
							$this->session->set_flashdata('success_msg','Access updated done!');
						}
				}

				//Reset user password
				if(isset($_POST['reset_password']) && isset($_POST['update_user_id'])){
						$this->form_validation->set_rules('password', 'Password', 'trim|required|htmlspecialchars|min_length[4]');
						$update_user_id = $this->input->post('update_user_id');
						$user_entered_password = md5( $this->config->item('encryption_key').trim($this->input->post('password')) );
						$user_arr = array(
							'password'=> $user_entered_password,
						);
						if( !$this->form_validation->run() ) {
							$error_message_array = $this->form_validation->error_array();
							$this->session->set_flashdata('error_msg_arr', $error_message_array);
						}else{
							$this->common->update('users', $user_arr, array( 'ID' => $update_user_id ));
							$this->session->set_flashdata('success_msg','Password updated done!');
						}
				}

				//update profile photo
				if(isset($_POST['update_user_photo']) && isset($_POST['update_user_id'])){
						$update_user_id = $this->input->post('update_user_id');
						$config['upload_path'] = './files/profile/';
						//$config['encrypt_name'] = TRUE;
						$config['max_size'] = 100;
						$config['allowed_types'] = 'gif|jpg|png';
						$config['max_width']  = '600';
						$config['max_height']  = '600';
						$config['file_name'] = 'photo-'.$update_user_id.'-'.time().'.jpg';
						$this->load->library('upload', $config);

						//Get exiting photo if have and delete
						$user_profile = $this->common->get( 'users', array( 'ID' => $update_user_id ) );
						if(!empty($user_profile)){
								$profile_photo = $user_profile->profile_photo;
								$profile_photopath = getcwd().'/files/profile/'.$profile_photo;
								if( file_exists( $profile_photopath ) ){
										//unlink($profile_photopath);
								}
						}

						//Upload new profile photo
						if ( $this->upload->do_upload('profile_photo') ) {
							$data = array('upload_data' => $this->upload->data());
							$_POST['profile_photo'] = $data['upload_data']['file_name'];
							$profile_photo_name = $_POST['profile_photo'];
							$this->common->update('users', array('profile_photo' => $profile_photo_name), array( 'ID' => $update_user_id ));
							$this->session->set_flashdata('success_msg','Updated done!');
						}else{
							$this->session->set_flashdata('error_msg','Updated failed!');
						}
				}
		}

		public function email_check()
		{
			$user = $this->common->get( 'users', array( 'email' => trim($this->input->post('email')) ) );
			if(!empty($user)){
					$this->form_validation->set_message('email_check', 'This email already exists, please try with new one.');
					return FALSE;
			}
			else
				return TRUE;
		}

		public function username_check()
		{
			$user = $this->common->get( 'users', array( 'user_name' => trim($this->input->post('username')) ) );
			if(!empty($user)){
					$this->form_validation->set_message('username_check', 'This user already exists, please try using new one.');
					return FALSE;
			}
			else
				return TRUE;
		}

}
