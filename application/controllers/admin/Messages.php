<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Messages extends RM_Controller {
	public $booking_date_time;
	public $currently_logged_user;

    public function __construct()
    {
            parent::__construct();
            $this->load->model('messages_model');
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
          base_url('assets/global/plugins/datatables/datatables.min.css'),
          base_url('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css'),
        );
        $result = $this->common->get_all( 'messages', array('msg_parent' => 0), '*', 'msg_date DESC' );        
        $this->data['message_rows'] = $result;        
        $this->data['js_files'] = array(
          base_url('assets/global/scripts/datatable.js'),
          base_url('assets/global/plugins/datatables/datatables.min.js'),
          base_url('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js'),
          base_url('assets/pages/scripts/table-datatables-responsive.min.js'),
          base_url('seatassets/js/message-view.js'),
        );

        $this->data['title'] = 'Messages';
        $breadcrumb[] = array('name' => 'Messages', 'url' => '');
        $this->data['breadcrumb'] = $breadcrumb;
        $this->data['current_page'] = 'messages';

        $this->load->view('templates/header',$this->data);
        $this->load->view('templates/sidebar', $this->data);
        $this->load->view('admin/messages/messages', $this->data);
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
		base_url('assets/global/plugins/select2/js/select2.full.min.js'),
        base_url('seatassets/js/seat-editor.js')		
      );

      // Start: Process register message
      $this->process_register_new_message();
      // End: Process register message


      $this->data['title'] = 'Register New Message';
      $breadcrumb[] = array('name' => 'Messages', 'url' => 'admin/messages');
      $breadcrumb[] = array('name' => 'Add New', 'url' => '');
      $this->data['breadcrumb'] = $breadcrumb;
      $this->data['current_page'] = 'add_message';
	  $user_info = $this->common->get_all( 'users', '', 'ID, display_name, email' );
	  $this->data['user_info'] = $user_info;

      $this->load->view('templates/header', $this->data);
      $this->load->view('templates/sidebar', $this->data);
      $this->load->view('admin/messages/register', $this->data);
      $this->load->view('templates/footer', $this->data);

    }
	
	public function details($slug = NULL)
    {			
        $message_details = $this->messages_model->get_messages($slug);
        $this->data['message_data'] = $message_details;

        if (empty($this->data['message_data']))
        {
                show_404();
        }

        $this->data['title'] = html_escape($message_details['msg_subject']);
        $breadcrumb[] = array('name' => 'Messages', 'url' => 'messages');
        $breadcrumb[] = array('name' => html_escape($message_details['msg_subject']), 'url' => '');
        $this->data['breadcrumb'] = $breadcrumb;
        $this->data['current_page'] = 'message_details';
		$message_id = $message_details['ID'];
		
		//Start: Reply process start
		$this->process_reply_message($message_id);
		//End: Reply proecss end
		
		//For read status		
		$this->common->update( 'messages', array('read_status' => 1), array( 'ID' =>  $message_id ) );
		
		//For reply message
		$result = $this->common->get_all( 'messages', array('msg_parent' => $message_id) );
		$this->data['message_reply'] = $result;

        $this->load->view('templates/header',$this->data);
        $this->load->view('templates/sidebar', $this->data);
        $this->load->view('admin/messages/message-details', $this->data);
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
				redirect('admin/messages');
			}else{
        $message_details = $this->messages_model->get_message_details($row_id);
        $this->data['message_data'] = $message_details;
        if (empty($this->data['message_data']))
        {
                show_404();
        }
        $this->data['title'] = html_escape($message_details['msg_subject']);
        $breadcrumb[] = array('name' => 'Messages', 'url' => 'admin/messages');
        $breadcrumb[] = array('name' => 'Edit Message', 'url' => '');
        $this->data['breadcrumb'] = $breadcrumb;
        $this->data['current_page'] = 'edit_message';

      }


      // Start: Process register message
      $this->process_register_new_message();
      // End: Process register message

      $this->load->view('templates/header', $this->data);
      $this->load->view('templates/sidebar', $this->data);
      $this->load->view('admin/messages/edit-message', $this->data);
      $this->load->view('templates/footer', $this->data);

    }

    public function delete($row_salt_id = 0)
    {

      //Get row ID of this Entry
      $row_id = decrypt($row_salt_id)*1;
      if( !is_int($row_id) || !$row_id ) {
        redirect('admin/messages');
      }else{
        $this->data['row_id'] = $row_id;
        $this->common->delete( 'messages', array( 'ID' =>  $row_id ) );
        $this->session->set_flashdata('delete_msg','Message have been successfully deleted!');
        redirect('admin/messages');
      }


    }


    //Process Regsiter New Message
    private function process_register_new_message(){
      //Add New Message
      if(($this->input->post('register_new_message') !== NULL) || ($this->input->post('update_message') !== NULL)){
          $this->form_validation->set_rules('msg_subject', 'Message Subject', 'trim|required|htmlspecialchars|min_length[2]');
          $this->form_validation->set_rules('msg_excerpt', 'Message Excerpt', 'trim|required|htmlspecialchars|min_length[2]');
          $this->form_validation->set_rules('msg_content', 'Message Content', 'trim|required|htmlspecialchars|min_length[2]');
          
        

          if( !$this->form_validation->run() ) {
  					$error_message_array = $this->form_validation->error_array();
  					$this->session->set_flashdata('error_msg_arr', $error_message_array);
  				}else{

            $data_arr = array(
              'msg_subject'=> trim($this->input->post('msg_subject')),
              'msg_excerpt'=> trim($this->input->post('msg_excerpt')),
              'msg_content'=> trim($this->input->post('msg_content')),              
              'msg_to'=> trim($this->input->post('message_to')),              
              'msg_author'=> $this->currently_logged_user,
              'msg_date'=> $this->booking_date_time
            );

            if(($this->input->post('update_message_id') !== NULL) || ($this->input->post('update_message') !== NULL)){
                $message_id = $this->input->post('update_message_id');
                $this->common->update( 'messages', $data_arr, array( 'ID' =>  $message_id ) );
      					$this->session->set_flashdata('success_msg','Updated done!');
            }else{
              $message_id = $this->common->insert( 'messages', $data_arr );
			  $generate_message_slug = $this->input->post('msg_subject').'-'.$message_id;
              $message_slug = url_title($generate_message_slug, 'dash', TRUE);
              $this->common->update( 'messages', array('msg_slug' => $message_slug), array( 'ID' =>  $message_id ) );
              $this->session->set_flashdata('success_msg','Added done!');
              redirect('admin/messages');
            }



  		}
      }

    }//EOF process message register info
	
	
	private function process_reply_message($message_id){
      if($this->input->post('message_reply') !== NULL){          
          $this->form_validation->set_rules('msg_content', 'Message Content', 'trim|required|htmlspecialchars|min_length[2]');
          
        

          if( !$this->form_validation->run() ) {
  					$error_message_array = $this->form_validation->error_array();
  					$this->session->set_flashdata('error_msg_arr', $error_message_array);
  				}else{

            $data_arr = array(
              'msg_content'=> trim($this->input->post('msg_content')),              
              'msg_parent'=> $message_id,
              'msg_author'=> $this->currently_logged_user,
              'msg_date'=> $this->booking_date_time
            );

            
			  $message_id = $this->common->insert( 'messages', $data_arr );
			  $this->session->set_flashdata('success_msg','Reply done!');
			  //redirect('admin/messages/message-details');          

  		}
      }

    }

}