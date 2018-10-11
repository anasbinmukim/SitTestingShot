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
		
		/*for($count = 0; $count < 100; $count++){
		
		$data_arr = array(
			  'msg_subject'=> 'Hello Messages '.$count,	
              'msg_content'=> 'Lorem Ipsum '.$count.' is simply dummy text of the ' .$count. ' printing and typesetting industry '.$count.'. Lorem Ipsum has been the.',              
              'msg_parent'=> 0,
              'msg_author'=> 1,
              'msg_date'=> '2018-10-10 00:00:00'
            );
			$message_id = $this->common->insert( 'messages_test', $data_arr );
		}*/
		
		
        $this->data['css_files'] = array(
          base_url('assets/global/plugins/datatables/datatables.min.css'),
          base_url('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css'),
        );

        $this->data['js_files'] = array(
          base_url('assets/global/scripts/datatable.js'),
          base_url('assets/global/plugins/datatables/datatables.min.js'),
          base_url('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js'),
          base_url('assets/pages/scripts/table-datatables-responsive.min.js'),
          //base_url('seatassets/js/message-view.js'),
        );
		
		//$this->books_page();

        $this->data['title'] = 'Test Page';
        $breadcrumb[] = array('name' => 'Messages', 'url' => '');
        $this->data['breadcrumb'] = $breadcrumb;
        $this->data['current_page'] = 'messages';

        $this->load->view('templates/header',$this->data);
        $this->load->view('templates/sidebar', $this->data);
        $this->load->view('admin/messages/page', array());
        $this->load->view('templates/footer', $this->data);
    }
	
	public function books_page()
     {
		 
		    

          // Datatables Variables
          $draw = intval($this->input->get("draw"));
          $start = intval($this->input->get("start"));
          $length = intval($this->input->get("length"));
		  $order = $this->input->get("order");

		  
		  $col = 0;
        $dir = "";
        if(!empty($order)) {
            foreach($order as $o) {
                $col = $o['column'];
                $dir= $o['dir'];
            }
        }

        if($dir != "asc" && $dir != "desc") {
            $dir = "asc";
        }

        $columns_valid = array(
            "messages_test.ID", 
            "messages_test.msg_slug", 
            "messages_test.msg_subject", 
            "messages_test.msg_status"
        );

        if(!isset($columns_valid[$col])) {
            $order = null;
        } else {
            $order = $columns_valid[$col];
        }
		
		
		if (!empty($this->input->post('search')['value']))
        {            
            $search = $this->input->get('search')['value'];
			
            $books = $this->messages_model->search_books($start, $length, $order, $dir, $search);
        }
        else {
			$books = $this->messages_model->get_books($start, $length, $order, $dir);
        }
		

          $data = array();

          foreach($books->result() as $r) {

               $data[] = array(
                    $r->ID,
                    $r->msg_slug,
                    $r->msg_subject,
                    $r->msg_status
               );
          }
		  
		  $total_books = $this->messages_model->get_total_books();

          $output = array(
				"draw" => $draw,
                "recordsTotal" => $total_books,
                "recordsFiltered" => $total_books,
                "data" => $data
            );
          echo json_encode($output);
          exit();
     }

}