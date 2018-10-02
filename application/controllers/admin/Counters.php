<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Counters extends RM_Controller {

    public function __construct()
    {
            parent::__construct();
            $this->load->model('companies_model');
            $this->load->helper('url');
            if ( ! $this->session->userdata('logged_in') ) {
							redirect('/login');
						}
    }

    public function index($company_id = NULL)
    {
        $this->data['css_files'] = array(
          base_url('assets/global/plugins/datatables/datatables.min.css'),
          base_url('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css'),
        );
        $result = $this->common->get_all( 'company_counter' );
        $this->data['counter_rows'] = $result;
        $this->data['js_files'] = array(
          base_url('assets/global/scripts/datatable.js'),
          base_url('assets/global/plugins/datatables/datatables.min.js'),
          base_url('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js'),
          base_url('seatassets/js/table-datatables-responsive.js'),
        );

        $this->data['title'] = 'Company Counters';
        $breadcrumb[] = array('name' => 'Companies', 'url' => 'admin/companies');
        $breadcrumb[] = array('name' => 'Counters', 'url' => '');
        $this->data['breadcrumb'] = $breadcrumb;
        $this->data['current_page'] = 'counters';

        $this->load->view('templates/header',$this->data);
        $this->load->view('templates/sidebar', $this->data);
        $this->load->view('admin/counters/counters', $this->data);
        $this->load->view('templates/footer', $this->data);
    }

    public function company($company_salt_id)
    {

      $company_id = decrypt($company_salt_id)*1;
			if( !is_int($company_id) || !$company_id ) {
        $this->session->set_flashdata('delete_msg','No company found');
				redirect('admin/counters');
			}else{

        $this->data['css_files'] = array(
          base_url('assets/global/plugins/datatables/datatables.min.css'),
          base_url('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css'),
        );

        $result = $this->common->get_all( 'company_counter', array('company_id' => $company_id ) );
        $this->data['counter_rows'] = $result;
        $this->data['js_files'] = array(
          base_url('assets/global/scripts/datatable.js'),
          base_url('assets/global/plugins/datatables/datatables.min.js'),
          base_url('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js'),
          base_url('seatassets/js/table-datatables-responsive.js'),
        );

        $this->data['title'] = 'Company Counters';
        $breadcrumb[] = array('name' => 'Companies', 'url' => 'admin/companies');
        $breadcrumb[] = array('name' => 'Counters', 'url' => '');
        $this->data['breadcrumb'] = $breadcrumb;
        $this->data['current_page'] = 'counters';

        $this->load->view('templates/header',$this->data);
        $this->load->view('templates/sidebar', $this->data);
        $this->load->view('admin/counters/counters', $this->data);
        $this->load->view('templates/footer', $this->data);
      }
    }

    public function details($slug = NULL)
    {
        $counter_details = $this->companies_model->get_counters($slug);
        $this->data['counter_data'] = $counter_details;

        if (empty($this->data['counter_data']))
        {
                show_404();
        }

        $this->data['title'] = html_escape($counter_details['counter_name']);
        $breadcrumb[] = array('name' => 'Companies', 'url' => 'admin/companies');
        $breadcrumb[] = array('name' => 'Counters', 'url' => 'admin/counters');
        $breadcrumb[] = array('name' => html_escape($counter_details['counter_name']), 'url' => '');
        $this->data['breadcrumb'] = $breadcrumb;
        $this->data['current_page'] = 'counter_details';

        $this->load->view('templates/header',$this->data);
        $this->load->view('templates/sidebar', $this->data);
        $this->load->view('admin/counters/counter-details', $this->data);
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
      $this->process_register_new_counter();
      // End: Process register counter


      $this->data['title'] = 'Register New Counter';
      $breadcrumb[] = array('name' => 'Companies', 'url' => 'admin/companies');
      $breadcrumb[] = array('name' => 'Counters', 'url' => 'admin/counters');
      $breadcrumb[] = array('name' => 'New Counter', 'url' => '');
      $this->data['breadcrumb'] = $breadcrumb;
      $this->data['current_page'] = 'counter_add';

      $this->load->view('templates/header', $this->data);
      $this->load->view('templates/sidebar', $this->data);
      $this->load->view('admin/counters/register', $this->data);
      $this->load->view('templates/footer', $this->data);

    }


    public function edit($row_salt_id = 0)
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

      //Get row ID of this Entry
      $row_id = decrypt($row_salt_id)*1;
			if( !is_int($row_id) || !$row_id ) {
        $this->session->set_flashdata('delete_msg','Can not be edited');
				redirect('admin/counters');
			}else{
        $counter_details = $this->common->get( 'company_counter', array( 'ID' => $row_id ), 'array' );
        $this->data['counter_data'] = $counter_details;
        if (empty($this->data['counter_data']))
        {
                show_404();
        }

        $this->data['title'] = html_escape($counter_details['counter_name']);
        $breadcrumb[] = array('name' => 'Companies', 'url' => 'admin/companies');
        $breadcrumb[] = array('name' => 'Counters', 'url' => 'admin/counters');
        $breadcrumb[] = array('name' => 'Edit Counter', 'url' => '');
        $this->data['breadcrumb'] = $breadcrumb;
        $this->data['current_page'] = 'counter_edit';

      }


      // Start: Process register company
      $this->process_register_new_counter();
      // End: Process register company

      $this->load->view('templates/header', $this->data);
      $this->load->view('templates/sidebar', $this->data);
      $this->load->view('admin/counters/edit-counter', $this->data);
      $this->load->view('templates/footer', $this->data);

    }

    public function delete($row_salt_id = 0)
    {

      //Get row ID of this Entry
      $row_id = decrypt($row_salt_id)*1;
      if( !is_int($row_id) || !$row_id ) {
        redirect('admin/counters');
      }else{
        $this->data['row_id'] = $row_id;
        $this->common->delete( 'company_counter', array( 'ID' =>  $row_id ) );
        $this->session->set_flashdata('delete_msg','Counter have been successfully deleted!');
        redirect('admin/counters');
      }


    }


    //Process Regsiter New Company
    private function process_register_new_counter(){
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
                redirect('admin/counters');
            }else{
              $counter_id = $this->common->insert( 'company_counter', $data_arr );
              $generate_counter_slug = $this->input->post('counter_name').'-'.$counter_id;
              $counter_slug = url_title($generate_counter_slug, 'dash', TRUE);
              $this->common->update( 'company_counter', array('counter_slug' => $counter_slug), array( 'ID' =>  $counter_id ) );
              $this->session->set_flashdata('success_msg','Added done!');
              redirect('admin/counters');
            }



  				}
      }

    }//EOF process company register info


}
