<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends RM_Controller {

    public function __construct()
    {
            parent::__construct();
            $this->load->model('messages_model');
            $this->load->helper('url');
    }

    public function index()
    {
		
		$details_msg = $this->common->get_all('messages_test');
		$this->data['message_data'] = $details_msg;
		
		
        $this->data['css_files'] = array(
          base_url('assets/global/plugins/datatables/datatables.min.css'),
          base_url('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css'),
        );

        $this->data['js_files'] = array(
          base_url('assets/global/scripts/datatable.js'),
          base_url('assets/global/plugins/datatables/datatables.min.js'),
          base_url('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js'),
          base_url('assets/pages/scripts/table-datatables-responsive.min.js'),
          base_url('seatassets/js/test-message.js'),
        );
		

        $this->data['title'] = 'Test Page';
		$breadcrumb[] = array('name' => 'All Messages', 'url' => '');
		$this->data['breadcrumb'] = $breadcrumb;
		$this->data['current_page'] = 'message';

        $this->load->view('templates/header',$this->data);
        $this->load->view('templates/sidebar', $this->data);
        $this->load->view('admin/messages/page', $this->data);
        $this->load->view('templates/footer', $this->data);
    }
	
	
	function get_all()
		{


			$keyword = '';
			if( isset( $_REQUEST['search']['value'] ) && $_REQUEST['search']['value'] != '' ) {
				$keyword = $_REQUEST['search']['value'];
			}

			$join_arr_left = array();


			$condition = '';
			if( $keyword != '' ) {
				$condition .= '(t.ID LIKE "%'.$keyword.'%" OR t.msg_subject LIKE "%'.$keyword.'%" OR t.msg_content LIKE "%'.$keyword.'%")';
			}

			$iTotalRecords = $this->common->get_total_count( 'messages_test t', $condition, $join_arr_left );

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
				2 => 'msg_date',
				3 => 'msg_subject',
				4 => 'msg_content',
			);


			$order_by = $columns[$_REQUEST['order'][0]['column']];
			$order = $_REQUEST['order'][0]['dir'];
			$sort = $order_by.' '.$order;

			$result = $this->common->get_all( 'messages_test t', $condition, 't.*', $sort, $limit, $offset, $join_arr_left );

			foreach( $result as $row ) {

					$user_first_last_name = $row->ID;
					$message_date = date('M d, Y', strtotime($row->msg_date));
					$message_subject = $row->msg_subject; 
					$user_role = $row->msg_content;

				$records["data"][] = array(
					$user_first_last_name,
					$message_date,
					$message_subject,
					$user_role,									
				);
			}

			$records["draw"] = $sEcho;
			$records["recordsTotal"] = $iTotalRecords;
			$records["recordsFiltered"] = $iTotalRecords;

			header('Content-type: application/json');
			echo json_encode($records);
		}


	
	public function test_search(){
		$value = $this->input->post('search_msg');
		//$query = $this->db->query("SELECT * FROM messages_test where ID = ".$value);
		
		$this->db->select('ID, msg_subject, msg_content');
		$this->db->from('messages_test');
		$this->db->like('ID', $value);
		$this->db->or_like('msg_subject', $value);
		$query = $this->db->get();
		
		$this->data['message_data'] = $query->result();
		
		
		$this->data['title'] = 'Test Page';
        $breadcrumb[] = array('name' => 'Messages', 'url' => '');
        $this->data['breadcrumb'] = $breadcrumb;
        $this->data['current_page'] = 'messages';

        $this->load->view('templates/header',$this->data);
        $this->load->view('templates/sidebar', $this->data);
        $this->load->view('admin/messages/test-page', $this->data);
        $this->load->view('templates/footer', $this->data);
	}

}