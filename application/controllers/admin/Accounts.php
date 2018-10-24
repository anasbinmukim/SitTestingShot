<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts extends RM_Controller {
    public $booking_date_time;
    public $currently_logged_user;

    public function __construct()
    {
            parent::__construct();
            $this->load->helper('url');
            if ( ! $this->session->userdata('logged_in') ) {
				redirect('/login');
			}
            $this->booking_date_time = date('Y-m-d H:i:s');
            $this->currently_logged_user = $this->session->userdata('user_id');
    }

    public function index()
    {

        $this->data['css_files'] = array(
          base_url('seatassets\css\accounts-view.css'),
          base_url('assets/global/plugins/datatables/datatables.min.css'),
          base_url('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css'),
        );
        $this->data['js_files'] = array(
          base_url('assets/global/scripts/datatable.js'),
          base_url('assets/global/plugins/datatables/datatables.min.js'),
          base_url('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js'),
          base_url('seatassets/js/table-datatables-responsive.js'),
		  base_url('seatassets/js/accounts-view.js'),
        );

        $this->data['title'] = 'Accounts';
        $breadcrumb[] = array('name' => 'Accounts', 'url' => '');
        $this->data['breadcrumb'] = $breadcrumb;
        $this->data['current_page'] = 'accounts';

        $this->load->view('templates/header',$this->data);
        $this->load->view('templates/sidebar', $this->data);
        $this->load->view('admin/accounts/accounts', $this->data);
        $this->load->view('templates/footer', $this->data);
    }
	
	function get_all()
		{
			$keyword = '';
			if( isset( $_REQUEST['search']['value'] ) && $_REQUEST['search']['value'] != '' ) {
				$keyword = $_REQUEST['search']['value'];
			}

			$join_arr_left = array();
			
			$condition = 't.user_id >= 0 ';
			if( $keyword != '' ) {
				$condition .= ' AND (t.ID LIKE "%'.$keyword.'%" OR t.booking_amount LIKE "%'.$keyword.'%" OR t.balance LIKE "%'.$keyword.'%")';
			}

			$iTotalRecords = $this->common->get_total_count( 'user_transactions t', $condition, $join_arr_left );

			$iDisplayLength = intval($_REQUEST['length']);
			$iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
			$iDisplayStart = intval($_REQUEST['start']);
			$sEcho = intval($_REQUEST['draw']);

			$records = array();
			$records["data"] = array();

			$limit = $iDisplayLength;
			$offset = $iDisplayStart;

			$columns = array(
				1 => 'ID',
				2 => 'transaction_date',
				3 => 'gross_amount',
				4 => 'transaction_type',
				5 => 'balance',
				6 => 'transaction_for',
			);

			$order_by = $columns[$_REQUEST['order'][0]['column']];
			$order = $_REQUEST['order'][0]['dir'];
			$sort = $order_by.' '.$order;

			$result = $this->common->get_all( 'user_transactions t', $condition, 't.*', $sort, $limit, $offset, $join_arr_left );

			foreach( $result as $row ) {
					
					$formatted_id = sprintf("%08d", $row->ID);
					$transaction_id = $formatted_id;
					$message_date = date('M d, Y', strtotime($row->transaction_date));
					$transaction_type = $row->transaction_type;
					$transaction_name = $row->transaction_for;
					$gross_amount = $row->gross_amount;
					$balance = $row->balance;			

				$records["data"][] = array(
					$transaction_id,
					$message_date,
					$transaction_type,
					$transaction_name,
					$gross_amount,
					$balance,
					'<div class="center-block"><a onclick="return confirm(\'Are you sure you want to delete this transaction?\');" href="'.site_url('admin/accounts/delete/'.encrypt($row->ID)).'" title="Delete"><i class="fa fa-trash-o text-danger"></i></a></div>',
				);
			}

			$records["draw"] = $sEcho;
			$records["recordsTotal"] = $iTotalRecords;
			$records["recordsFiltered"] = $iTotalRecords;

			header('Content-type: application/json');
			echo json_encode($records);
		}
		
	public function delete($row_salt_id = 0)
    {
      //Get row ID of this Entry
      $row_id = decrypt($row_salt_id)*1;
      if( !is_int($row_id) || !$row_id ) {
        redirect('admin/accounts');
      }else{
        $this->data['row_id'] = $row_id;
        $this->common->delete( 'user_transactions', array( 'ID' =>  $row_id ) );      
        redirect('admin/accounts');
      }
    }	


    public function deposit($user_solt_id = NULL){

      // Start: Process user deposit
      $this->process_user_deposit();
      // End: Process user deposit

      $this->data['css_files'] = array(
        base_url('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css'),
        base_url('assets/global/plugins/select2/css/select2.min.css'),
        base_url('assets/global/plugins/select2/css/select2-bootstrap.min.css'),
      );

      $this->data['js_files'] = array(
        base_url('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js'),
        base_url('assets/global/plugins/select2/js/select2.full.min.js'),
        base_url('assets/global/plugins/jquery-validation/js/jquery.validate.min.js'),
      );

      $this->data['all_users'] = $this->get_launch_route_arr();

      $this->data['title'] = 'Account Deposit';
	  $breadcrumb[] = array('name' => 'Deposit', 'url' => 'admin/accounts');
      $breadcrumb[] = array('name' => 'Add New', 'url' => '');
      $this->data['breadcrumb'] = $breadcrumb;
      $this->data['current_page'] = 'deposit_account';

      $this->load->view('templates/header',$this->data);
      $this->load->view('templates/sidebar', $this->data);
      $this->load->view('accounts/deposit', $this->data);
      $this->load->view('templates/footer', $this->data);
    }

    private function process_user_deposit(){
      if(($this->input->post('deposit_to_user_account') !== NULL) && ($this->input->post('user_solt_id') !== NULL)){
          $this->form_validation->set_rules('deposit_amount', 'Deposit Amount', 'trim|required|greater_than[0]');

          if( !$this->form_validation->run() ) {
            $error_message_array = $this->form_validation->error_array();
            $this->session->set_flashdata('error_msg_arr', $error_message_array);
          }else{
            $user_solt_id = $this->input->post('user_solt_id');
            $user_id = decrypt($user_solt_id)*1;
            $deposit_amount = $this->input->post('deposit_amount');

            $this->booking_date_time = date('Y-m-d H:i:s');
            $this->currently_logged_user = $this->session->userdata('user_id');

            $deposit_data = array(
                'user_id' => $user_id,
                'transaction_date' => $this->booking_date_time,
                'gross_amount' => $deposit_amount,
                'net_amount' => $deposit_amount,
                'transaction_type' => USER_TRANS_TYPE_DEPOSIT_TO,
                'transaction_for' => 'User Account',
                'payment_method' => PAYMENT_MEDHOD_DIRECT,
                'payment_status' => PAYMENT_STATUS_CONFIRMED,
                'updated_at' => $this->booking_date_time,
                'updated_by' => $this->currently_logged_user,
            );
            //Add data to database
            $trans_id = $this->common->insert( 'user_transactions', $deposit_data );

            $account_balance = 0;
            $account_balance = $this->common->get_user_meta($user_id, 'account_balance');
            $account_balance += $deposit_amount;
            $this->common->update_user_meta($user_id, 'account_balance', $account_balance);

            $transaction_id = time().'X'.$this->currently_logged_user.'X'.$trans_id;
            $trans_arr = array(
                'transaction_id' => $transaction_id,
                'balance' => $account_balance,
            );
            $this->common->update('user_transactions', $trans_arr, array( 'ID' => $trans_id ));
            $this->session->set_flashdata('success_msg','Added done!');

            redirect('admin/accounts');

          }

      }
    }


    public function get_launch_route_arr() {

      $condition = '1=1 AND t.deleted = 0 ';
			$condition .= ' AND t.is_active = 1 ';
      $limit = 1000;
      $offset = 0;
      $order_by = 'first_name ';
      $order = 'DESC ';
      $sort = $order_by.' '.$order;

      $users = $this->common->get_all( 'users t', $condition, 't.ID, t.first_name, t.last_name', $sort, $limit, $offset );

      $result_users = array();
      foreach ($users as $user) {
        if(($user->ID != '') && ($user->ID > 0)){
            $user_id = $user->ID;
            $result_users[$user_id] = $user->first_name. ' ' . $user->last_name;
        }
      }
      return $result_users;
    }


    public function details($slug = NULL)
    {
        $counter_details = $this->companies_model->get_counters($slug);
        $this->data['counter_data'] = $counter_details;

        if (empty($this->data['counter_data']))
        {
                show_404();
        }

        $this->data['title'] = $counter_details['counter_name'];

        $this->load->view('templates/header',$this->data);
        $this->load->view('templates/sidebar', $this->data);
        $this->load->view('counters/counter-details', $this->data);
        $this->load->view('templates/footer', $this->data);
    }



    public function register()
    {

      $this->data['css_files'] = array(
        base_url('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css'),
        base_url('assets/global/plugins/select2/css/select2.min.css'),
        base_url('assets/global/plugins/select2/css/select2-bootstrap.min.css'),
      );

      $this->data['js_files'] = array(
        base_url('assets/global/plugins/ckeditor/ckeditor.js'),
        base_url('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js'),
        base_url('seatassets/js/seat-editor.js'),
        base_url('assets/global/plugins/select2/js/select2.full.min.js'),
        base_url('assets/global/plugins/jquery-validation/js/jquery.validate.min.js'),
      );


      // Start: Process register counter
      //$this->process_register_new_counter();
      // End: Process register counter


      $this->data['title'] = 'Register New Company';
	  $breadcrumb[] = array('name' => 'Register', 'url' => 'admin/accounts');
      $breadcrumb[] = array('name' => 'Add New', 'url' => '');
      $this->data['breadcrumb'] = $breadcrumb;
      $this->data['current_page'] = 'add_account';

      $this->load->view('templates/header', $this->data);
      $this->load->view('templates/sidebar', $this->data);
      $this->load->view('admin/accounts/register', $this->data);
      $this->load->view('templates/footer', $this->data);

    }


    //Process Regsiter New Company
    private function ___process_register_new_counter(){
      //Add New Company
      if(($this->input->post('register_new_counter') !== NULL) || ($this->input->post('update_counter') !== NULL)){
          $this->form_validation->set_rules('counter_name', 'Counter Name', 'trim|required|htmlspecialchars|min_length[2]');
          $this->form_validation->set_rules('incharge_name', 'Incharge Name', 'trim|required|htmlspecialchars|min_length[2]');
          $this->form_validation->set_rules('incharge_mobile', 'Incharge Mobile', 'trim|required|htmlspecialchars|min_length[2]');
          $this->form_validation->set_rules('incharge_email', 'Incharge Email', 'trim|valid_email|htmlspecialchars|min_length[2]');
          $this->form_validation->set_rules('contact_info', 'Contact Info', 'trim|htmlspecialchars|min_length[2]');
          $this->form_validation->set_rules('address', 'Address', 'trim|htmlspecialchars|min_length[2]');
          $this->form_validation->set_rules('thana_id', 'Thana', 'trim|htmlspecialchars');
          $this->form_validation->set_rules('district_id', 'District', 'trim|htmlspecialchars');

          if( !$this->form_validation->run() ) {
  					$error_message_array = $this->form_validation->error_array();
  					$this->session->set_flashdata('error_msg_arr', $error_message_array);
  				}else{

            $data_arr = array(
              'company_id'=> trim($this->input->post('company_id')),
              'counter_name'=> trim($this->input->post('counter_name')),
              'incharge_name'=> trim($this->input->post('incharge_name')),
              'incharge_mobile'=> trim($this->input->post('incharge_mobile')),
              'incharge_email'=> trim($this->input->post('incharge_email')),
              'contact_info'=> trim($this->input->post('contact_info')),
              'address'=> trim($this->input->post('address')),
              'thana_id'=> trim($this->input->post('thana_id')),
              'district_id'=> trim($this->input->post('district_id')),
              'updated_at'=> date('Y-m-d H:i:s'),
              'updated_by'=> $this->session->userdata('user_id'),
            );

            if(($this->input->post('update_counter_id') !== NULL) && ($this->input->post('update_counter') !== NULL)){
                $counter_id = $this->input->post('update_counter_id');
                $this->common->update( 'company_counter', $data_arr, array( 'ID' =>  $counter_id ) );
      					$this->session->set_flashdata('success_msg','Updated done!');
                redirect('/counters');
            }else{
              $counter_id = $this->common->insert( 'company_counter', $data_arr );
              $generate_counter_slug = $this->input->post('counter_name').'-'.$counter_id;
              $counter_slug = url_title($generate_counter_slug, 'dash', TRUE);
              $this->common->update( 'company_counter', array('counter_slug' => $counter_slug), array( 'ID' =>  $counter_id ) );
              $this->session->set_flashdata('success_msg','Added done!');
              redirect('/counters');
            }



  				}
      }

    }//EOF process company register info


}
