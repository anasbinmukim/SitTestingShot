<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifications extends RM_Controller {
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
          base_url('seatassets/js/notification-view.js'),
        );
		
		//notification_add_new( $this->currently_logged_user, 'title 5', 'description 5' );

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
		
		$condition = '';
		if( $keyword != '' ) {
			$condition .= '(t.ID LIKE "%'.$keyword.'%" OR t.title LIKE "%'.$keyword.'%" OR t.description LIKE "%'.$keyword.'%")';
		}

		$iTotalRecords = $this->common->get_total_count( 'notification t', $condition, $join_arr_left );

		$iDisplayLength = intval($_REQUEST['length']);
		$iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
		$iDisplayStart = intval($_REQUEST['start']);
		$sEcho = intval($_REQUEST['draw']);

		$records = array();
		$records["data"] = array();

		$limit = $iDisplayLength;
		$offset = $iDisplayStart;

		$columns = array(
			1 => 'create_date',
			2 => 'title',
			3 => 'description',
		);

		$order_by = $columns[$_REQUEST['order'][0]['column']];
		$order = $_REQUEST['order'][0]['dir'];
		$sort = $order_by.' '.$order;

		$result = $this->common->get_all( 'notification t', $condition, 't.*', $sort, $limit, $offset, $join_arr_left );

		foreach( $result as $row ) {
				
				$notification_id = $row->ID;
				$description = strip_tags(html_entity_decode($row->description));
				$description = substr($description,0,50);

				$notification_date = date('M d, Y', strtotime($row->create_date));
				$title = '<a href="'.site_url('admin/notifications/details/'.encrypt($row->ID)).'">'.$row->title.'</a>'; 
				$description = '<a href="'.site_url('admin/notifications/details/'.encrypt($row->ID)).'">'.$description.'</a>';
				$mark_status = $row->mark_status;

			$records["data"][] = array(
				$notification_date,
				$title,
				$description,
				'<div class="center-block"><a href="'.site_url('admin/notifications/details/'.encrypt($row->ID)).'" title="View"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;<a onclick="return confirm(\'Are you sure you want to delete this notification?\');" href="'.site_url('admin/notifications/delete/'.encrypt($row->ID)).'" title="Delete"><i class="fa fa-trash-o text-danger"></i></a></div>',
				$mark_status,
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
        redirect('admin/notifications');
      }else{
        $this->data['row_id'] = $row_id;
        $this->common->delete( 'notification', array( 'ID' =>  $row_id ) );
        //$this->session->set_flashdata('delete_msg','Message have been successfully deleted!');
        redirect('admin/notifications');
      }
    }
	
	public function details($row_salt_id = 0)
    {
		$this->data['css_files'] = array(
			base_url('seatassets\css\notification-view.css'),
		);

		$row_id = decrypt($row_salt_id)*1;
			if( !is_int($row_id) || !$row_id ) {
        //$this->session->set_flashdata('delete_msg','Can not be edited');
				redirect('admin/notifications');
			}else{
        $notification_details = $this->notification_model->get_notification_details($row_id);
        $this->data['notification_data'] = $notification_details;
		$notification_id = $notification_details['ID'];
        if (empty($this->data['notification_data']))
        {
                show_404();
        }
        $this->data['title'] = html_escape($notification_details['title']);
        $breadcrumb[] = array('name' => 'Notifications', 'url' => 'admin/notifications');
        $breadcrumb[] = array('name' => html_escape($notification_details['title']), 'url' => '');
        $this->data['breadcrumb'] = $breadcrumb;
        $this->data['current_page'] = 'notification_details';
      } 
	  
		$join_arr_left = array(
			'users ur' => 'ur.ID = nf.user_id',
		);
		$result = $this->common->get_all( 'notification nf', array('nf.ID' => $notification_id), 'nf.*, ur.last_name', '', '', '', $join_arr_left);
		$this->data['notification_info'] = $result;
		
		//For read status
		$this->common->update( 'notification', array('mark_status' => 1), array( 'ID' =>  $notification_id ) );
		
        $this->load->view('templates/header',$this->data);
        $this->load->view('templates/sidebar', $this->data);
        $this->load->view('admin/notifications/notification-details', $this->data);
        $this->load->view('templates/footer', $this->data);
    }
	
	public function edit($row_salt_id = 0)
    {

      $this->data['css_files'] = array(
        base_url('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css'),
      );

      $this->data['js_files'] = array(
        base_url('assets/global/plugins/ckeditor/ckeditor.js'),
        base_url('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js'),
        base_url('seatassets/js/seat-editor.js'),
      );

      //Get row ID of this Entry
      $row_id = decrypt($row_salt_id)*1;
			if( !is_int($row_id) || !$row_id ) {
        $this->session->set_flashdata('delete_msg','Can not be edited');
				redirect('admin/notifications');
			}else{
        $notification_details = $this->notification_model->get_notification_details($row_id);
        $this->data['notification_data'] = $notification_details;
        if (empty($this->data['notification_data']))
        {
                show_404();
        }
        $this->data['title'] = html_escape($notification_details['title']);
        $breadcrumb[] = array('name' => 'Notifications', 'url' => 'admin/notifications');
        $breadcrumb[] = array('name' => 'Edit Notification', 'url' => '');
        $this->data['breadcrumb'] = $breadcrumb;
        $this->data['current_page'] = 'edit_notification';

      }
	  
	  // Start: Process register message
      $this->process_register_new_notification();
      // End: Process register message

      $this->load->view('templates/header', $this->data);
      $this->load->view('templates/sidebar', $this->data);
      $this->load->view('admin/notifications/edit-notification', $this->data);
      $this->load->view('templates/footer', $this->data);

    }
		
	public function register()
    {

      $this->data['css_files'] = array(
	    base_url('seatassets\css\notification-view.css'),
        base_url('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css'),
      );

      $this->data['js_files'] = array(
        base_url('assets/global/plugins/ckeditor/ckeditor.js'),
        base_url('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js'),
        base_url('seatassets/js/seat-editor.js')		
      );

      // Start: Process register message
      $this->process_register_new_notification();
      // End: Process register message


      $this->data['title'] = 'Register New Notification';
      $breadcrumb[] = array('name' => 'Messages', 'url' => 'admin/notifications');
      $breadcrumb[] = array('name' => 'Add New', 'url' => '');
      $this->data['breadcrumb'] = $breadcrumb;
      $this->data['current_page'] = 'add_notification';

      $this->load->view('templates/header', $this->data);
      $this->load->view('templates/sidebar', $this->data);
      $this->load->view('admin/notifications/register', $this->data);
      $this->load->view('templates/footer', $this->data);

    }
	
	//Process Regsiter New Notification
    private function process_register_new_notification(){
      //Add New Notification
      if(($this->input->post('register_new_notification') !== NULL) || ($this->input->post('update_notification') !== NULL)){
          $this->form_validation->set_rules('notif_title', 'Title', 'trim|required|htmlspecialchars|min_length[2]');
          $this->form_validation->set_rules('notif_description', 'Description', 'trim|required|htmlspecialchars|min_length[2]');
          
          if( !$this->form_validation->run() ) {
  					$error_message_array = $this->form_validation->error_array();
  					$this->session->set_flashdata('error_msg_arr', $error_message_array);
  				}else{

            $data_arr = array(
              'title'=> trim($this->input->post('notif_title')),
              'description'=> trim($this->input->post('notif_description')),          
              'user_id'=> $this->currently_logged_user,
              'create_date'=> $this->booking_date_time,
			  'mark_status'=> 0
            );

            if(($this->input->post('update_notification_id') !== NULL) || ($this->input->post('update_notification') !== NULL)){
                $notification_id = $this->input->post('update_notification_id');
                $this->common->update( 'notification', $data_arr, array( 'ID' =>  $notification_id ) );
      					$this->session->set_flashdata('success_msg','Updated done!');
            }else{
              $message_id = $this->common->insert( 'notification', $data_arr );			 
              $this->session->set_flashdata('success_msg','Added done!');
              redirect('admin/notifications');
            }
  		}
      }

    }//EOF process notification register info

}