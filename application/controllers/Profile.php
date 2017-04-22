<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends RM_Controller {
		public function __construct()
		{
						parent::__construct();
						$this->load->helper('file');
		}
		public function index()
		{
						if ( ! $this->session->userdata('logged_in') ) {
							redirect('/login/');
						}

						// $this->data['page_title'] = 'Edit My Profle';
						// $this->data['menu'] = 'admin';
						// $this->data['submenu'] = 'profile';

						$this->data['css_files'] = array(
						  base_url('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css'),
						  base_url('assets/pages/css/profile.min.css'),
						);

						$this->data['js_files'] = array(
						  base_url('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js'),
						  base_url('assets/global/plugins/jquery.sparkline.min.js'),
						  base_url('assets/pages/scripts/profile.min.js'),
						);

						if(isset($_GET['psection']) && ($_GET['psection'] == 'personal-info')){
							$this->data['profile_section'] = 'personal-info';
						}elseif(isset($_GET['psection']) && ($_GET['psection'] == 'profile-photo')){
							$this->data['profile_section'] = 'profile-photo';
						}elseif(isset($_GET['psection']) && ($_GET['psection'] == 'profile-settings')){
							$this->data['profile_section'] = 'profile-settings';
						}elseif(isset($_GET['psection']) && ($_GET['psection'] == 'update-password')){
							$this->data['profile_section'] = 'update-password';
						}else{
							$this->data['profile_section'] = 'personal-info';
						}

						//Start: Process profile personal info
						$this->update_personal_info();
						//End: Process profile personal info

						//Start: Process profile photo
						$this->update_profile_photo();
						//End: Process profile photo




						$this->load->view('templates/header',$this->data);
						$this->load->view('templates/sidebar', $this->data);
						$this->load->view('profile/profile',$this->data);
						$this->load->view('templates/footer',$this->data);
		}



		/*
		 * @Process personal info data
		 * @Return void
		 */
		private function update_personal_info(){
			if(isset($_POST['save_personal_info'])){

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

				$user_profile = $this->common->get( 'users', array( 'ID' => $this->session->userdata('user_id') ) );
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
					redirect('/profile/?psection=personal-info');
				}else{
					$this->common->update('users', $user_arr, array( 'ID' => $this->session->userdata('user_id') ));
					$this->common->update_user_meta($this->session->userdata('user_id'), 'bio_info', trim($this->input->post('bio_info')));
					$this->session->set_flashdata('success_msg','Updated done!');
					redirect('/profile/?psection=personal-info');
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

		/*
		 * @Process uploaded profile photo
		 * @Return void
		 */

		private function update_profile_photo(){
			if(isset($_POST['save_profile_photo'])){
				$config['upload_path'] = './files/media/';
				//$config['encrypt_name'] = TRUE;
				$config['max_size'] = 100;
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_width']  = '600';
				$config['max_height']  = '600';
				$config['file_name'] = 'profile-photo-'.$this->session->userdata('user_id').'-'.time().'.jpg';
				$this->load->library('upload', $config);

				//Get exiting photo if have and delete
				$user_profile = $this->common->get( 'users', array( 'ID' => $this->session->userdata('user_id') ) );
				if(!empty($user_profile)){
						$profile_photo = $user_profile->profile_photo;
						$profile_photopath = getcwd().'/files/media/'.$profile_photo;
						if( file_exists( $profile_photopath ) ){
								unlink($profile_photopath);
						}
				}

				//Upload new profile photo
				if ( $this->upload->do_upload('profile_photo') ) {
					$data = array('upload_data' => $this->upload->data());
					$_POST['profile_photo'] = $data['upload_data']['file_name'];
					$profile_photo_name = $_POST['profile_photo'];
					$this->common->update('users', array('profile_photo' => $profile_photo_name), array( 'ID' => $this->session->userdata('user_id') ));
					$this->session->set_flashdata('success_msg','Updated done!');
					redirect('/profile/?psection=profile-photo');
				}else{
					$this->session->set_flashdata('error_msg','Updated failed!');
				}
			}
		}

		public function image_thumb( $old_path = '', $new_path = '' ) {

			ini_set('memory_limit', '1024M');
					$pathinfo = pathinfo($old_path);
					$original = $old_path;
					if (!file_exists($original)) {
							show_404($original);
					}

					$width = 400;
					$height = 400;
					// only continue with a valid width and height
					if ( $width >= 0 && $height >= 0) {
							// initialize library
							$config["source_image"] = $old_path;
							$config['new_image'] = $new_path;
							$config["width"] = $width;
							$config["height"] = $height;
							$config["dynamic_output"] = FALSE; // always save as cache
							$this->load->library('image_lib');
							$this->image_lib->initialize($config);
							$this->image_lib->fit();
							$this->image_lib->clear();
					}
		}


}
