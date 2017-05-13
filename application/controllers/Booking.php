<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends RM_Controller {

		public $booking_date_time;
		public $currently_logged_user;

		const BOOKING_STATUS_CONFIRM = 'Confirm';
		const BOOKING_STATUS_PENDING = 'Pending';

		public function __construct()
		{
				parent::__construct();
				$this->load->model('booking_model');
				$this->load->library('session');
				if( !$this->session->userdata('logged_in') ) {
					redirect('login');
				}
				$this->common->check_user_exists();

				$this->booking_date_time = date('Y-m-d H:i:s');
				$this->currently_logged_user = $this->session->userdata('user_id');
		}
		public function index()
		{
        $this->data['title'] = 'Booking';

        $this->load->view('templates/header', $this->data);
				$this->load->view('templates/sidebar', $this->data);
        $this->load->view('booking/booking', $this->data);
        $this->load->view('templates/footer', $this->data);
		}

		public function launchcabin($schedule_solt_id = NULL, $request_cabin_solt_ids = NULL, $cabin_item_solt_id = NULL, $booking_ref_number = NULL)
		{
				if(($this->input->post('submit_cabins_request') !== NULL) && ($this->input->post('cabin_ids') !== NULL)){
						$cabin_ids = $this->input->post('cabin_ids');
						$schedule_id = $this->input->post('schedule_id');
						$launch_id = $this->input->post('launch_id');
						$travel_date = $this->input->post('travel_date');
						$booking_ref_number = $this->session->userdata('user_id').'UT'.time().'TR'.mt_rand();
						$this->session->set_userdata('booking_ref_number', $booking_ref_number);
						$requested_cabin_cart_data = array();
							if(is_array($cabin_ids) && (count($cabin_ids)> 0)){
								//add data to hold this cabins for next few minutes
								foreach ($cabin_ids as $key => $cabin_solt_id) {
									$cabin_id = decrypt($cabin_solt_id)*1;
									$booked_item_data = array();
									$booked_item_data = array(
											'schedule_id' => $schedule_id,
											'launch_id' => $launch_id,
											'cabin_id' => $cabin_id,
											'travel_date' => $travel_date,
											'booking_ref_number' => $booking_ref_number,
											'booking_status' => self::BOOKING_STATUS_PENDING,
											'booking_time' => $this->booking_date_time,
									);
									//Add data to database
									$this->common->insert( 'launch_cabin_booked', $booked_item_data );

									$cabin_details = array();
									$cabin_details = $this->common->get( 'launch_cabin', array( 'ID' => $cabin_id ), 'array' );
									$requested_cabin_cart_data[$cabin_id] = $cabin_details;
								}
								$this->session->set_userdata('cabin_booking_cart_items', $requested_cabin_cart_data);
								$comma_cabin_ids = implode(",", $cabin_ids);
								$cabins_solt_ids = encrypt($comma_cabin_ids);
								$cart_items_url = '/booking/launchcabin/'.$schedule_solt_id.'/'.$cabins_solt_ids;
								$this->session->set_userdata('cart_items_url', $cart_items_url);
								redirect($cart_items_url);
								exit;
							}
				}

				//Cancle cabin booking request
				if(($this->input->post('submit_cabins_cancle_request') !== NULL) && ($this->input->post('request_cabin_solt_ids') !== NULL)){
						$request_cabin_solt_ids = $this->input->post('request_cabin_solt_ids');
						$request_cabin_comma_ids = decrypt($request_cabin_solt_ids);
						$request_cabin_ids = explode(",", $request_cabin_comma_ids);

						$booking_ref_number = $this->input->post('booking_ref_number');

						$cabin_booking_cart_items = $this->session->userdata('cabin_booking_cart_items');
						foreach ($cabin_booking_cart_items as $cabin_id => $cabin_details) {
							$this->common->delete( 'launch_cabin_booked', array( 'cabin_id' =>  $cabin_id, 'booking_ref_number' =>  $booking_ref_number ) );
						}

						//Reset all seasons for booking
						$this->session->unset_userdata('booking_ref_number');
						$this->session->unset_userdata('cabin_booking_cart_items');
						$this->session->unset_userdata('cart_items_url');

						redirect('/booking/launch');
						exit;
				}

				///Process launch cabin book now page
				$this->process_launch_cabin_booknow();

				$this->data['js_files'] = array(
					base_url('seatassets/js/bookseatprocess.js'),
					base_url('seatassets/js/jquery.number.js'),
				);

				$this->data['launch_arr'] = $this->get_launch_arr();
				$this->data['launch_route_arr'] = $this->get_launch_route_arr();

				$this->data['schedule_solt_id'] = $schedule_solt_id;
				$this->data['request_cabin_solt_ids'] = $request_cabin_solt_ids;

				//Get schedule_id
	      $schedule_id = decrypt($schedule_solt_id)*1;
				if( !is_int($schedule_id) || !$schedule_id ) {
		        $this->session->set_flashdata('delete_msg','Can not be booked');
						redirect('/booking/launch');
				}else{
		        $launch_schedule_data_details = $this->common->get( 'launch_schedule', array( 'sche_id' => $schedule_id ), 'array' );
		        $this->data['launch_schedule_data'] = $launch_schedule_data_details;
		        if (empty($this->data['launch_schedule_data']))
		        {
		            show_404();
		        }else{
								$schedule_id = $launch_schedule_data_details['sche_id'];
								$launch_id = $launch_schedule_data_details['launch_id'];
								$date = $launch_schedule_data_details['date'];
								$this->data['available_cabins'] = $this->get_available_launch_cabin($launch_id);
								$this->data['already_proceed_cabins'] = $this->get_already_proceed_launch_cabin($schedule_id, $launch_id, $date);
						}
		     }


				//get request cabin ids
				if($request_cabin_solt_ids != NULL){

					//Redirect for unauthorized access
					if(!$this->session->userdata('booking_ref_number')){
						redirect('/booking/launch');
						exit;
					}

					//Get cabin requested cabin ids from URL
					//$request_cabin_comma_ids = decrypt($request_cabin_solt_ids);
					//$request_cabin_ids = explode(",", $request_cabin_comma_ids);

					//Get requested cabin ids from seasson
					$cabin_booking_cart_items = $this->session->userdata('cabin_booking_cart_items');
				  $request_cabin_ids = array();
				  foreach ($cabin_booking_cart_items as $cabin_id => $cabin_details) {
				    $request_cabin_ids[] = $cabin_id;
				  }

					//Remove cabin items from cart of cabin request
					if(($cabin_item_solt_id != NULL) && ($booking_ref_number != NULL)){
							$cabin_item_id = decrypt($cabin_item_solt_id)*1;

							//Removed item from booking database
							$this->common->delete( 'launch_cabin_booked', array( 'cabin_id' =>  $cabin_item_id, 'booking_ref_number' =>  $booking_ref_number ) );

							//Reset season array
							$cabin_booking_cart_items = $this->session->userdata('cabin_booking_cart_items');
							unset($cabin_booking_cart_items[$cabin_item_id]);
							$this->session->set_userdata('cabin_booking_cart_items', $cabin_booking_cart_items);


							$request_remove_item_arr = array($cabin_item_id);
							$request_cabin_ids = array_diff($request_cabin_ids, $request_remove_item_arr);

							if(is_array($request_cabin_ids) && (count($request_cabin_ids)> 0)){
								$comma_cabin_ids = implode(",", $request_cabin_ids);
								$cabins_solt_ids = encrypt($comma_cabin_ids);
								$cart_items_url = '/booking/launchcabin/'.$schedule_solt_id.'/'.$cabins_solt_ids;
								$this->session->set_userdata('cart_items_url', $cart_items_url);
								redirect($cart_items_url);
								exit;
							}else{
								redirect('/booking/launchcabin/'.$schedule_solt_id);
								exit;
							}
					}

					if(is_array($request_cabin_ids) && (count($request_cabin_ids)> 0)){
						$this->data['request_cabin_ids'] = $request_cabin_ids;
						$cabin_condition = '1=1 ';
						if(($launch_id != '') && ($launch_id > 0)){
							$cabin_condition .= ' AND launch_id = "'.$launch_id.'"';
						}

						$cabin_condition .= " AND `ID` IN (".implode(',',$request_cabin_ids).")";

						$result = $this->common->get_all('launch_cabin', $cabin_condition);

						$this->data['requested_available_cabins'] = $result;
					}

					$this->data['title'] = 'Request Cabins Booking';
					$this->load->view('templates/header', $this->data);
					$this->load->view('templates/sidebar', $this->data);
					$this->load->view('booking/launch/cabin-request', $this->data);
					$this->load->view('templates/footer', $this->data);
				}else{
					//If already have pending booking it redirect to cart page
					if($this->session->has_userdata('cart_items_url')){
						redirect($this->session->userdata('cart_items_url'));
						exit;
					}
					$this->data['title'] = 'Available Cabins';
					$this->load->view('templates/header', $this->data);
					$this->load->view('templates/sidebar', $this->data);
					$this->load->view('booking/launch/cabin', $this->data);
					$this->load->view('templates/footer', $this->data);
				}
		}

		private function process_launch_cabin_booknow(){
				if(($this->input->post('submit_cabins_confirm_request') !== NULL) && ($this->input->post('request_cabin_solt_ids') !== NULL) && ($this->session->userdata('cabin_booking_cart_items'))){
						$this->form_validation->set_rules('passenger_name', 'Passenger Name', 'trim|required|htmlspecialchars|min_length[2]');
						$this->form_validation->set_rules('passenger_mobile', 'Passenger Mobile', 'trim|is_natural|required|htmlspecialchars|min_length[6]');
						$this->form_validation->set_rules('passenger_email', 'Passenger Email', 'trim|valid_email');
						$this->form_validation->set_rules('passenger_age', 'Passenger Age', 'trim|is_natural');

						if( !$this->form_validation->run() ) {
							$error_message_array = $this->form_validation->error_array();
							$this->session->set_flashdata('error_msg_arr', $error_message_array);
						}else{
							$cabin_price  = 0;
							$cabin_price  = 0;
							$booking_charge  = 0;
							$paid_amount  = 0;
							$vat  = 0;
							$cabin_booking_cart_items = $this->session->userdata('cabin_booking_cart_items');
							foreach ($cabin_booking_cart_items as $cabin_id => $cabin_details) {
								//get requested cabin data
								$cabin_price  += $cabin_details['cabin_fare'];
								$booking_charge  += $cabin_details['booking_charge'];

							}

							$vat = ($booking_charge * 5)  / 100 ;

							//Grand total for paid amount
							$paid_amount += $cabin_price;
							$paid_amount += $booking_charge;
							$paid_amount += $vat;

							$booking_item_data = array();
							$booking_item_data = array(
									'booking_ref_num' => trim($this->input->post('booking_ref_number')),
									'passenger_name' => trim($this->input->post('passenger_name')),
									'passenger_mobile' => trim($this->input->post('passenger_mobile')),
									'passenger_email' => trim($this->input->post('passenger_email')),
									'passenger_age' => trim($this->input->post('passenger_age')),
									'passenger_gender' => trim($this->input->post('passenger_gender')),
									'cabin_price' => $cabin_price,
									'booking_charge' => $booking_charge,
									'paid_amount' => $paid_amount,
									'vat' => $vat,
									'booking_status' => self::BOOKING_STATUS_CONFIRM,
									'booking_date' => $this->booking_date_time,
									'booking_by' => $this->currently_logged_user,
							);
							//Add data to database
							$new_booking_id = $this->common->insert( 'launch_booking', $booking_item_data );

							//User balance transaction
							$trans_data = array(
									'user_id' => $this->currently_logged_user,
									'transaction_date' => $this->booking_date_time,
									'booking_amount' => $cabin_price,
									'booking_fee' => $booking_charge,
									'shipping_charge' => 0,
									'handling_fee' => 0,
									'vat' => $vat,
									'gross_amount' => $paid_amount,
									'net_amount' => $cabin_price,
									'transaction_type' => USER_TRANS_TYPE_PAYMENT_TO,
									'transaction_for' => 'Cabin Booking',
									'payment_method' => '',
									'payment_status' => PAYMENT_STATUS_CONFIRMED,
									'updated_at' => $this->booking_date_time,
									'updated_by' => $this->currently_logged_user,
							);
							$trans_id = $this->common->insert( 'user_transactions', $trans_data );
							$account_balance = 0;
							$account_balance = $this->common->get_user_meta($this->currently_logged_user, 'account_balance');
							$account_balance = $account_balance - $paid_amount;
							$this->common->update_user_meta($this->currently_logged_user, 'account_balance', $account_balance);
							$transaction_id = time().'X'.$this->currently_logged_user.'X'.$trans_id;
							$trans_arr = array(
									'transaction_id' => $transaction_id,
									'balance' => $account_balance,
							);
							$this->common->update('user_transactions', $trans_arr, array( 'ID' => $trans_id ));

							$booking_ref_number = $this->input->post('booking_ref_number');
							foreach ($cabin_booking_cart_items as $cabin_id => $cabin_details) {
								//update booking confirmation data
								$booked_item_data = array();
								$booked_item_data = array(
										'booking_id' => $new_booking_id,
										'cabin_number' => $cabin_details['cabin_number'],
										'booking_ref_number' => $booking_ref_number,
										'booking_status' => 'Confirm',
										'booking_time' => date('Y-m-d H:i:s'),
								);
								$booked_item_where = array();
								$booked_item_where = array(
										'cabin_id' => $cabin_id,
										'booking_ref_number' => $booking_ref_number,
								);
								//confirm booking
								$this->common->update('launch_cabin_booked', $booked_item_data, $booked_item_where);
							}
							//Reset all seasons for booking
							$this->session->unset_userdata('booking_ref_number');
							$this->session->unset_userdata('cabin_booking_cart_items');
							$this->session->unset_userdata('cart_items_url');

							$this->session->set_flashdata('success_msg','Booking Complete');
							redirect('/booking/launch');
							exit;
						}//eof if no error
				}
		}

		//Return all availalbe cabins of a launch that can be book or already booked
		public function get_available_launch_cabin($launch_id){
				$schedule_condition = '1=1 ';
				$schedule_condition .= ' AND launch_id = "'.$launch_id.'"';
				$schedule_condition .= ' AND is_allow = 1';
				$result = $this->common->get_all('launch_cabin', $schedule_condition);
				return $result;
		}

		//Return all cabins that already being process and can't be booked
		public function get_already_proceed_launch_cabin($schedule_id, $launch_id, $travel_date){
				$result = array();

				$schedule_condition = '1=1 ';
				$schedule_condition .= ' AND schedule_id = "'.$schedule_id.'"';
				$schedule_condition .= ' AND launch_id = "'.$launch_id.'"';
				$schedule_condition .= ' AND ( booking_status = "Confirm"';
				$schedule_condition .= ' OR booking_status = "Pending"';
				$schedule_condition .= ' OR booking_status = "Hold" )';
				$schedule_condition .= ' AND travel_date = "'.$travel_date.'"';
				$booked_cabins = $this->common->get_all('launch_cabin_booked', $schedule_condition);

				foreach ($booked_cabins as $cabins) {
						$result[] = array(
							'cabin_id' => $cabins->cabin_id,
							'booking_status' => $cabins->booking_status,
						);
				}

				return $result;
		}

		public function launch($launch_id = 'id', $travel_date = 'date', $start_from = 'from', $destination_to = 'to', $schedule_id = NULL)
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

				if(($launch_id != 'id') && ($launch_id > 0)){
					$schedule_condition .= ' AND launch_id = "'.$launch_id.'"';
				}

				if(($travel_date != 'date') && ($travel_date)){
					$schedule_condition .= ' AND date = "'.$travel_date.'"';
				}else{
					$today = date('Y-m-d');
					$schedule_condition .= ' AND date >= "'.$today.'"';
				}

				if(($start_from != 'from') && ($start_from !='')){
					$schedule_condition .= ' AND start_from LIKE "'.$start_from.'"';
				}

				if(($destination_to != 'to') && ($destination_to != '')){
					$schedule_condition .= ' AND destination_to LIKE "'.$destination_to.'"';
				}


				$result = $this->common->get_all('launch_schedule', $schedule_condition);
				$this->data['launch_schedule_rows'] = $result;
				$this->data['title'] = 'Cabin Booking';
				$this->load->view('templates/header', $this->data);
				$this->load->view('templates/sidebar', $this->data);
				$this->load->view('booking/launch/search-form', $this->data);
				$this->load->view('booking/launch/launch', $this->data);
				$this->load->view('templates/footer', $this->data);


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


		public function mybooking($booking_type = 'launch', $user_solt_id = NULL){

			$this->data['css_files'] = array(
				base_url('assets/global/plugins/datatables/datatables.min.css'),
				base_url('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css'),
			);

			$this->data['js_files'] = array(
				base_url('assets/global/scripts/datatable.js'),
				base_url('assets/global/plugins/datatables/datatables.min.js'),
				base_url('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js'),
				base_url('seatassets/js/table-datatables-responsive.js'),
			);

			if($user_solt_id != NULL){
					$user_id = decrypt($user_solt_id)*1;
			}else{
					$user_id = $this->currently_logged_user;
			}

			$condition = '1=1 ';
			$condition .= ' AND booking_by = "'.$user_id.'"';

			$join_arr_left = array(
				'launch_cabin_booked lcb' => 'lcb.booking_id = lb.ID',
				'launch l' => 'lcb.launch_id = l.ID',
				'launch_schedule ls' => 'lcb.schedule_id = ls.sche_id',
			);


			$limit = 1000;
			$offset = 0;
			$order_by = 'ID ';
			$order = 'DESC ';
			$sort = $order_by.' '.$order;

			$result = $this->common->get_all( 'launch_booking lb', $condition, 'lb.*, lcb.booking_id, lcb.schedule_id, lcb.launch_id, lcb.cabin_id, lcb.cabin_number, lcb.travel_date, lcb.booking_status, l.launch_name, ls.start_from, ls.destination_to', $sort, $limit, $offset, $join_arr_left );

			$this->data['launch_booking_rows'] = $result;


			$this->data['title'] = 'My Booking';
			$this->load->view('templates/header', $this->data);
			$this->load->view('templates/sidebar', $this->data);
			$this->load->view('booking/my-booking', $this->data);
			$this->load->view('templates/footer', $this->data);

		}//EOF mybooking

}
