<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends RM_Controller {
	public $booking_date_time;
	public $currently_logged_user;

    public function __construct()
    {
            parent::__construct();
            $this->load->model('notification_model');
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
		  base_url('seatassets\css\message-view.css'),
          base_url('assets/global/plugins/datatables/datatables.min.css'),
          base_url('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css'),
        );
        
        $this->data['js_files'] = array(
          base_url('assets/global/scripts/datatable.js'),
          base_url('assets/global/plugins/datatables/datatables.min.js'),
          base_url('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js'),
          base_url('assets/pages/scripts/table-datatables-responsive.min.js'),
          base_url('seatassets/js/message-view.js'),
        );

        $this->data['title'] = 'Notifications';
        $breadcrumb[] = array('name' => 'Notifications', 'url' => '');
        $this->data['breadcrumb'] = $breadcrumb;
        $this->data['current_page'] = 'notifications';

        $this->load->view('templates/header',$this->data);
        $this->load->view('templates/sidebar', $this->data);
        $this->load->view('admin/notifications/notifications', $this->data);
        $this->load->view('templates/footer', $this->data);
    }
	
	function get_all()
		{
			$keyword = '';
			if( isset( $_REQUEST['search']['value'] ) && $_REQUEST['search']['value'] != '' ) {
				$keyword = $_REQUEST['search']['value'];
			}

			$join_arr_left = array();
			
			$condition = 't.msg_parent=0 ';
			if( $keyword != '' ) {
				$condition .= ' AND (t.ID LIKE "%'.$keyword.'%" OR t.msg_subject LIKE "%'.$keyword.'%" OR t.msg_content LIKE "%'.$keyword.'%")';
			}

			$iTotalRecords = $this->common->get_total_count( 'messages t', $condition, $join_arr_left );

			$iDisplayLength = intval($_REQUEST['length']);
			$iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
			$iDisplayStart = intval($_REQUEST['start']);
			$sEcho = intval($_REQUEST['draw']);

			$records = array();
			$records["data"] = array();

			$limit = $iDisplayLength;
			$offset = $iDisplayStart;

			$columns = array(
				1 => 'msg_date',
				2 => 'msg_subject',
				3 => 'msg_content',
			);

			$order_by = $columns[$_REQUEST['order'][0]['column']];
			$order = $_REQUEST['order'][0]['dir'];
			$sort = $order_by.' '.$order;

			$result = $this->common->get_all( 'messages t', $condition, 't.*', $sort, $limit, $offset, $join_arr_left );

			foreach( $result as $row ) {
					
					$message_slug = $row->msg_slug;
					$content = strip_tags(html_entity_decode($row->msg_content));
					$content = substr($content,0,50);

					$message_date = date('M d, Y', strtotime($row->msg_date));
					$message_subject = '<a href="'.site_url('admin/messages/details/'.$message_slug).'">'.$row->msg_subject.'</a>'; 
					$message_content = '<a href="'.site_url('admin/messages/details/'.$message_slug).'">'.$content.'</a>';
					$read_status = $row->read_status;

				$records["data"][] = array(
					$message_date,
					$message_subject,
					$message_content,
					'<div class="center-block"><a href="'.site_url('admin/messages/details/'.$message_slug).'" title="View"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;<a onclick="return confirm(\'Are you sure you want to delete this message?\');" href="'.site_url('admin/messages/delete/'.encrypt($row->ID)).'" title="Delete"><i class="fa fa-trash-o text-danger"></i></a></div>',
					$read_status,
				);
			}

			$records["draw"] = $sEcho;
			$records["recordsTotal"] = $iTotalRecords;
			$records["recordsFiltered"] = $iTotalRecords;

			header('Content-type: application/json');
			echo json_encode($records);
		}

}