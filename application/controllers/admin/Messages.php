<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Messages extends RM_Controller {
	public $booking_date_time;
	public $currently_logged_user;

    public function __construct()
    {
            parent::__construct();
            $this->load->model('companies_model');
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
        $result = $this->common->get_all( 'messages' );
        $this->data['message_rows'] = $result;
        $this->data['js_files'] = array(
          base_url('assets/global/scripts/datatable.js'),
          base_url('assets/global/plugins/datatables/datatables.min.js'),
          base_url('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js'),
          base_url('assets/pages/scripts/table-datatables-responsive.min.js'),
          base_url('seatassets/js/table-district-editable.js'),
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

    public function details($slug = NULL)
    {
        $company_details = $this->companies_model->get_companies($slug);
        $this->data['company_data'] = $company_details;

        if (empty($this->data['company_data']))
        {
                show_404();
        }

        $this->data['title'] = html_escape($company_details['company_name']);
        $breadcrumb[] = array('name' => 'Companies', 'url' => 'companies');
        $breadcrumb[] = array('name' => html_escape($company_details['company_name']), 'url' => '');
        $this->data['breadcrumb'] = $breadcrumb;
        $this->data['current_page'] = 'company_details';

        $this->load->view('templates/header',$this->data);
        $this->load->view('templates/sidebar', $this->data);
        $this->load->view('admin/companies/company-details', $this->data);
        $this->load->view('templates/footer', $this->data);
    }



    public function register()
    {

      $this->data['css_files'] = array(
        base_url('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css'),
      );

      $this->data['js_files'] = array(
        base_url('assets/global/plugins/ckeditor/ckeditor.js'),
        base_url('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js'),
        base_url('seatassets/js/seat-editor.js'),
      );

      // Start: Process register message
      $this->process_register_new_message();
      // End: Process register message


      $this->data['title'] = 'Register New Message';
      $breadcrumb[] = array('name' => 'Messages', 'url' => 'admin/messages');
      $breadcrumb[] = array('name' => 'Add New', 'url' => '');
      $this->data['breadcrumb'] = $breadcrumb;
      $this->data['current_page'] = 'add_message';

      $this->load->view('templates/header', $this->data);
      $this->load->view('templates/sidebar', $this->data);
      $this->load->view('admin/messages/register', $this->data);
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
        $message_details = $this->companies_model->get_message_details($row_id);
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


    //Process Regsiter New Company
    private function process_register_new_message(){
      //Add New Company
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
              'msg_author'=> $this->currently_logged_user,
              'msg_date'=> $this->booking_date_time
            );

            if(($this->input->post('update_message_id') !== NULL) || ($this->input->post('update_message') !== NULL)){
                $message_id = $this->input->post('update_message_id');
                $this->common->update( 'messages', $data_arr, array( 'ID' =>  $message_id ) );
      					$this->session->set_flashdata('success_msg','Updated done!');
            }else{
              $message_id = $this->common->insert( 'messages', $data_arr );
              $this->session->set_flashdata('success_msg','Added done!');
              redirect('admin/messages');
            }



  				}
      }

    }//EOF process message register info


}