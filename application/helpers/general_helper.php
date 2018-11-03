<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if( !function_exists('debug') ) {
    function debug($msg, $die=false) {
    	echo "<pre>";
    	print_r($msg);
    	echo "</pre>";
    	if($die) die();
    }
}

if( !function_exists('notification_add_new') ) {
  function notification_add_new( $user_id = null, $title, $description ) {
	$data_arr = array(
	  'title'=> trim($title),
	  'description'=> trim($description),          
	  'user_id'=> $user_id,
	  'create_date'=> date('Y-m-d H:i:s'),
	  'mark_status'=> 0
	);
	$CI = &get_instance();
	$CI->db->insert( 'notification', $data_arr );
  }
}

if( !function_exists('checked') ) {
  function checked( $checked, $current = true, $echo = true ) {
  	return __checked_selected_helper( $checked, $current, $echo, 'checked' );
  }
}

if( !function_exists('selected') ) {
  function selected( $selected, $current = true, $echo = true ) {
  	return __checked_selected_helper( $selected, $current, $echo, 'selected' );
  }
}

if( !function_exists('disabled') ) {
  function disabled( $disabled, $current = true, $echo = true ) {
  	return __checked_selected_helper( $disabled, $current, $echo, 'disabled' );
  }
}

if( !function_exists('readonly') ) {
  function readonly( $readonly, $current = true, $echo = true ) {
  	return __checked_selected_helper( $readonly, $current, $echo, 'readonly' );
  }
}

if( !function_exists('__checked_selected_helper') ) {
    function __checked_selected_helper( $helper, $current, $echo, $type ) {
    	if ( (string) $helper === (string) $current )
    		$result = " $type='$type'";
    	else
    		$result = '';

    	if ( $echo )
    		echo $result;

    	return $result;
    }
}

if( !function_exists('create_slug') ) {

	function create_slug( $title = '' ) {
		$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $title);
		$clean = strtolower(trim($clean, '-'));
		$clean = preg_replace("/[\/_|+ -]+/", '_', $clean);

		if ( slug_exists($clean, $id) ) {
			$clean = make_slug_unique($clean);
		}
		return $clean;
	}

}
if( !function_exists('slug_exists') ) {
	function slug_exists( $slug ) {
		$ci = &get_instance();
		$ci->db->from('processes');
		$ci->db->where('slug', $slug);
		return $ci->db->count_all_results();
	}
}
if( !function_exists('make_slug_unique') ) {
	function make_slug_unique( $slug ) {
		for ( $i=1; $i<100000; $i++ ) {
			$proposedslug = $slug .'-'. $i;
			if ( !slug_exists( $proposedslug ) ){
				return $proposedslug;
				break;
			}
		}
	}
}

if( !function_exists('random_string') ) {
	function random_string($stirng = 15){  //password_hash("rasmuslerdorf", PASSWORD_DEFAULT)

		$rnd_id = password_hash(uniqid(rand(),1), PASSWORD_DEFAULT);
		$rnd_id = strip_tags(stripslashes($rnd_id));
		$rnd_id = str_replace(".","",$rnd_id);
		$rnd_id = strrev(str_replace("/","",$rnd_id));
		$rnd_id = substr($rnd_id,0,$stirng);
		return $rnd_id;
	}
}

if ( !function_exists('username') ) {
	function username( $id = 0 ) {

		if( $id > 0 ) {
			$ci = &get_instance();
			$ci->db->select('username');
			$ci->db->where( 'id' , $id );
			$row = $ci->db->get('users')->row();
			if( count($row) > 0 ) {
				return $row->username;
			} else {
				return '';
			}
		} else {
			return '';
		}
	}
}

if ( !function_exists('get_users_by_role') ) {
	function get_users_by_role($role_name = 'subscriber') {
    $CI =& get_instance();
    $CI->load->database();
    $CI->db->where( 'user_role' , $role_name );
    //$CI->db->where( 'deleted' , 0 );
    $CI->db->order_by('display_name');
    $query = $CI->db->get('users');
    $users = $query->result_array();

    $result_users = array();
    foreach ($users as $user) {
      if(($user['user_name'] != '') && ($user['ID'] > 0)){
          $user_id = $user['ID'];
          $result_users[$user_id] = $user;
      }
    }
		return $result_users;
	}
}

if ( !function_exists('get_thana_arr') ) {
	function get_thana_arr() {
    $CI =& get_instance();
    $CI->load->database();
    $CI->db->order_by('thana_name');
    $query = $CI->db->get('place_thana');
    $thanas = $query->result_array();

    $result_thanas = array();
    foreach ($thanas as $thana) {
      if(($thana['thana_name'] != '') && ($thana['ID'] > 0)){
          $thana_id = $thana['ID'];
          $result_thanas[$thana_id] = $thana['thana_name'];
      }
    }
		return $result_thanas;
	}
}

if ( !function_exists('get_zone_arr') ) {
	function get_zone_arr() {
    $CI =& get_instance();
    $CI->load->database();
    $CI->db->order_by('zone_name');
    $query = $CI->db->get('place_zone');
    $zones = $query->result_array();

    $result_zones = array();
    foreach ($zones as $zone) {
      if(($zone['zone_name'] != '') && ($zone['ID'] > 0)){
          $zone_id = $zone['ID'];
          $result_zones[$zone_id] = $zone['zone_name'];
      }
    }
		return $result_zones;
	}
}

if ( !function_exists('get_via_places_arr') ) {
	function get_via_places_arr($type = 'launch') {

    $thana_arr = get_thana_arr();
    $condition = array('type'=> $type);
    $CI =& get_instance();
    $CI->load->database();
    $CI->db->where($condition);
    $CI->db->order_by('place_name');
    $query = $CI->db->get('via_place');
    $via_places = $query->result_array();

    $result_via_places = array();
    foreach ($via_places as $via_place) {
      if(($via_place['place_name'] != '') && ($via_place['ID'] > 0)){
          $place_id = $via_place['ID'];
          $place_name_detail = $via_place['place_name'].', '.$via_place['address'].', '.$thana_arr[$via_place['thana_id']];
          $result_via_places[$place_id] = array(
              'place_name' => $via_place['place_name'],
              'detail' => $place_name_detail
          );
      }
    }
		return $result_via_places;
	}
}


if ( !function_exists('get_thana_under_dist_arr') ) {
	function get_thana_under_dist_arr() {

    $district_arr = get_district_arr();

    $CI =& get_instance();
    $CI->load->database();
    $CI->db->order_by('thana_name');
    $query = $CI->db->get('place_thana');
    $thanas = $query->result_array();

    $result_thanas = array();
    foreach ($thanas as $thana) {
      if(($thana['thana_name'] != '') && ($thana['ID'] > 0)){
          $thana_id = $thana['ID'];
          $thana_name = $thana['thana_name'].' -> '.$district_arr[$thana['district_id']];
          $result_thanas[$thana_id] = $thana_name;
      }
    }
		return $result_thanas;
	}
}


if ( !function_exists('get_district_arr') ) {
	function get_district_arr() {
    $CI =& get_instance();
    $CI->load->database();
    $CI->db->order_by('district_name');
    $query = $CI->db->get('place_district');
    $districts = $query->result_array();

    $result_district = array();
    foreach ($districts as $district) {
      if(($district['district_name'] != '') && ($district['ID'] > 0)){
          $district_id = $district['ID'];
          $result_district[$district_id] = $district['district_name'];
      }
    }
		return $result_district;
	}
}

if ( !function_exists('get_divisions_arr') ) {
	function get_divisions_arr() {
    $CI =& get_instance();
    $CI->load->database();
    $CI->db->order_by('division_name');
    $query = $CI->db->get('place_division');
    $divisions = $query->result_array();

    $result_division = array();
    foreach ($divisions as $division) {
      if(($division['division_name'] != '') && ($division['ID'] > 0)){
        $division_id = $division['ID'];
        $result_division[$division_id] = $division['division_name'];
      }
    }
		return $result_division;
	}
}

if ( !function_exists('get_companies_arr') ) {
	function get_companies_arr() {
    $CI =& get_instance();
    $CI->load->database();
    $CI->db->order_by('company_name');
    $query = $CI->db->get('company');
    $companies = $query->result_array();

    $result_companies = array();
    foreach ($companies as $company) {
      if(($company['company_name'] != '') && ($company['ID'] > 0)){
        $company_id = $company['ID'];
        $result_companies[$company_id] = $company['company_name'];
      }
    }
		return $result_companies;
	}
}

if ( !function_exists('user_details') ) {
	function user_details( $id = 0 ) {
		$ci = &get_instance();
		$ci->db->where( 'id' , $id );
		$row = $ci->db->get('users')->row();
		return $row;
	}
}


if( !function_exists('get_settings_item') ) {

	function get_settings_item($key = '') {

		$ci = &get_instance();
		$ci->db->where('field', $key);
		$row = $ci->db->get('settings')->row();
		if( count($row) > 0 ) {
			return $row->value;
		} else {
			return '';
		}
	}

}
if( !function_exists('get_role_name') ) {

	function get_role_name( $id = '' ) {

		$ci = &get_instance();
		$ci->db->where('id', $id);
		$row = $ci->db->get('groups')->row();
		if( count($row) > 0 ) {
			return $row->title;
		} else {
			return '';
		}
	}

}

if( !function_exists('is_user_active') ) {
	function is_user_active( $id = 0 ) {
		$ci = &get_instance();
		$ci->db->where( 'id' , $id );
		$row = $ci->db->get('users')->row();

		if( count($row) > 0 ) {

			if( $row->expire_date < time() ) {
				return false;
			} else {
				return true;
			}

		} else {
			return false;
		}
	}
}




if ( !function_exists('get_user_status') ) {
	function get_user_status( $key  = 0) {
		$st_arr = array(
			1 => 'Active',
			2 => 'Inactive',
			3 => 'Deleted',
		);
		return $st_arr[$key];
	}
}

if ( !function_exists('get_via_place_type_arr') ) {
	function get_via_place_type_arr() {
		$st_arr = array(
			'launch' => 'Launch',
			'bus' => 'Bus',
			'air' => 'Air',
		);
		return $st_arr;
	}
}

if ( !function_exists('get_user_status_class') ) {
	function get_user_status_class( $key  = 0) {
		$st_arr = array(
			1 => 'success',
			2 => 'warning',
			3 => 'danger',
		);
		return $st_arr[$key];
	}
}

if ( !function_exists('get_launch_cabin_floor') ) {
	function get_launch_cabin_floor() {
		$st_arr = array(
			'1st' => 'First Floor',
			'2nd' => 'Second Floor',
			'3rd' => 'Third Floor',
      '4th' => 'Fourth Floor',
      '5th' => 'Fifth Floor',
		);
		return $st_arr;
	}
}

if ( !function_exists('seat_taka_format') ) {
	function seat_taka_format($amount) {
      $amount = '&#x9f3;'.number_format($amount, 2, '.', '');
		return $amount;
	}
}



if ( !function_exists('get_launch_cabin_type') ) {
	function get_launch_cabin_type( $key  = '') {
		$st_arr = array(
			'Single' => 'Single',
			'Double' => 'Double',
			'VIP' => 'VIP',
      'Green Place' => 'Green Place',
      'White Place' => 'White Place',
      'Duplex' => 'Duplex',
		);
    if($key != ''){
		    return $st_arr[$key];
    }else{
      return $st_arr;
    }
	}
}

if ( !function_exists('get_user_role') ) {
	function get_user_role( $key  = 'all') {
		$st_arr = array(
      'subscriber' => 'Subscriber',
			'agent' => 'Agent',
      'booking_manager' => 'Booking Manager',
      'supervisor' => 'Supervisor',
      'company_accountant' => 'Company Accountant',
      'company_manager' => 'Company Manager',
			'company_owner' => 'Company Owner',
      'doctor' => 'Doctor',
      'doctor_assistant' => 'Doctor Assistant',
      'app_support' => 'App Support',
      'app_accountant' => 'App Accountant',
      'administrator' => 'Administrator',
		);
		if ( $key  == 'all' ) {
			return $st_arr;
		} else {
			return $st_arr[$key];
		}

	}
}

if ( !function_exists('is_primary_set') ) {
	function is_primary_set( $user_id  = 0, $county_id = 0 ) {
		if ( $user_id > 0 && $county_id > 0 ) {

			$ci = &get_instance();
			$ci->db->where(array( 'county_id' => $county_id, 'user_id !=' => $user_id, 'is_primary'=>1 ));
			$row = $ci->db->get('county_assignments')->row();
			if( count($row) > 0 ) {
				return 1;
			} else {
				return 0;
			}

		}
	}
}

if ( !function_exists('get_months') ) {
	function get_months( $month_key = 0 ) {

		$arr_month = array(

			"01" => "Jan",
			"02" => "Feb",
			"03" => "Mar",
			"04" => "Apr",
			"05" => "May",
			"06" => "Jun",
			"07" => "Jul",
			"08" => "Aug",
			"09" => "Sep",
			"10" => "Oct",
			"11" => "Nov",
			"12" => "Dec",

		);

		if ( $month_key  == 0 ) {
			return $arr_month;
		} else {
			return $arr_month[$month_key];
		}
	}
}

if ( !function_exists('get_sale_window') ) {
	function get_sale_window( $key  = 0) {
		$st_arr = array(
			1 => '10AM',
			2 => '11AM',
			3 => '12PM',
			4 => '1PM',
		);
		if ( $key  == 0 ) {
			return $st_arr;
		} else {
			return $st_arr[$key];
		}
	}
}



if ( !function_exists('send_mail') ) {
	function send_mail( $name, $user_id = 0, $params = array() ){


		$ci = &get_instance();

		$settings = $ci->db->get('core')->row();

		$to_name = $to_email = '';
		if (false !== ($pos = strpos($user_id, '@'))) {
			$to_email = $user_id;
			if( $to_email == '' ) {
				return;
			}
		} else {

			$ci->db->where( 'id' , $user_id );
			$user = $ci->db->get('users')->row();

			if( count($user) == 0 ){
				return;
			}
			$to_name = $user->first_name.' '.$user->last_name;
			$to_email = $user->email;
		}

		$ci->db->where( 'slug' , $name );
		$model = $ci->db->get('emails')->row();

		if( count($model) == 0 ){
			return;
		}

		$template = $model->body;
		$subject = $model->subject;

		$template = str_replace(array_map(function($key) {
			return '[*' . $key . '*]';
		}, array_keys($params)), array_values($params), $template);

		$subject = str_replace(array_map(function($key) {
			return '[*' . $key . '*]';
		}, array_keys($params)), array_values($params), $subject);

		$ci->load->library('phpmailer');

		$ci->phpmailer->IsHTML(true);

		$is_smtp = $settings->is_smtp;

		if( $is_smtp == 1 ) {
			$ci->phpmailer->IsSMTP();
			$ci->phpmailer->SMTPSecure = $settings->connection_prefix;
			$ci->phpmailer->SMTPAuth   = true;
			$ci->phpmailer->Host       = $settings->smtp_host;
			$ci->phpmailer->Port       = $settings->smtp_port;
			$ci->phpmailer->Username   = $settings->smtp_username;
			$ci->phpmailer->Password   = $settings->smtp_password;
		}

		$ci->phpmailer->SetFrom( $settings->email, $settings->site_name );
		$ci->phpmailer->AddAddress( $to_email, $to_name );
		$ci->phpmailer->Subject = $subject;
		$ci->phpmailer->Body = $template;
		$ci->phpmailer->Send();
		$ci->phpmailer->ClearAddresses();
	}
}
