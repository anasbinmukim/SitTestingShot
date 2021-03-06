<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class RM_Controller extends CI_Controller
{
	var $user = FALSE;
	var $site_settings = false;
	protected $data = array();

	function __construct() {
		parent::__construct();
		$this->data['user_role'] = 'guest';
		$this->data['front_js_flag']['site_public'] = 'true';
		$this->data['front_js_flag']['allow_seat_select_per_cart'] = 2;
		$this->data['site_title'] = $this->common->get_app_option('site_title');
		$this->data['site_tagline'] = $this->common->get_app_option('site_tagline');
		$this->data['site_logo'] = base_url('seatassets/images/logo-seat-booking-bd-1.png');
		if( $this->common->get_app_option('site_logo') && file_exists( getcwd().'/files/media/'.$this->common->get_app_option('site_logo') ) ){
			$this->data['site_logo'] = base_url( 'files/media/'.$this->common->get_app_option('site_logo') );
		}
		$this->data['title'] = 'Online Reservation in Bangladesh';
		$this->data['current_page'] = 'home';
		$this->user = $this->session->userdata('user_id') ? $this->common->get( 'users', array( 'ID' => $this->session->userdata('user_id'), 'is_active' => 1 ) ) : FALSE;
		if ( $this->session->userdata('logged_in') ) {
			$this->data['profile_photo'] = base_url('seatassets/images/placeholder-profile-photo.jpg');
			$user_profile = $this->common->get( 'users', array( 'ID' => $this->session->userdata('user_id') ) );
			if(!empty($user_profile)){
					$profile_photo = $user_profile->profile_photo;
					if( $profile_photo && file_exists( getcwd().'/files/profile/'.$profile_photo ) ){
							$this->data['profile_photo'] = base_url( 'files/profile/'.$profile_photo );
					}
			}
			$this->data['display_name'] = $user_profile->display_name;
			$this->data['first_name'] = $user_profile->first_name;
			$this->data['last_name'] = $user_profile->last_name;
			$this->data['occupation'] = $user_profile->occupation;
			$this->data['user_role'] = $user_profile->user_role;
			$this->data['user_level'] = $user_profile->user_level;


			if($user_profile->user_role == ROLE_ADMINISTRATOR){
				$this->data['allow_pair_cabin_booked'] = TRUE;
				$this->data['front_js_flag']['allow_seat_select_per_cart'] = 5;
			}else{
				$this->data['allow_pair_cabin_booked'] = FALSE;
			}

		}else{
			$this->data['user_role'] = FALSE;
			$this->data['user_level'] = FALSE;
		}
	}
}
