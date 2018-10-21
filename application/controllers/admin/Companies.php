<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Companies extends RM_Controller {

    public function __construct()
    {
            parent::__construct();
            $this->load->model('companies_model');
            $this->load->helper('url');
            if ( ! $this->session->userdata('logged_in') ) {
							redirect('/login');
						}
    }

    public function index()
    {
        $this->data['css_files'] = array(
		  base_url('seatassets\css\companies-view.css'),
          base_url('assets/global/plugins/datatables/datatables.min.css'),
          base_url('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css'),
        );

        $this->data['js_files'] = array(
          base_url('assets/global/scripts/datatable.js'),
          base_url('assets/global/plugins/datatables/datatables.min.js'),
          base_url('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js'),
          base_url('assets/pages/scripts/table-datatables-responsive.min.js'),
		  base_url('seatassets/js/companies-view.js'),
        );

        $this->data['title'] = 'Companies';
        $breadcrumb[] = array('name' => 'Companies', 'url' => '');
        $this->data['breadcrumb'] = $breadcrumb;
        $this->data['current_page'] = 'companies';

        $this->load->view('templates/header',$this->data);
        $this->load->view('templates/sidebar', $this->data);
        $this->load->view('admin/companies/companies', $this->data);
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
				$condition .= '(c.ID LIKE "%'.$keyword.'%" OR c.company_name LIKE "%'.$keyword.'%" OR c.company_description LIKE "%'.$keyword.'%")';
			}

			$iTotalRecords = $this->common->get_total_count( 'company c', $condition, $join_arr_left );

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
				2 => 'company_name',
				3 => 'company_description',
			);

			$order_by = $columns[$_REQUEST['order'][0]['column']];
			$order = $_REQUEST['order'][0]['dir'];
			$sort = $order_by.' '.$order;

			$result = $this->common->get_all( 'company c', $condition, 'c.*', $sort, $limit, $offset, $join_arr_left );

			foreach( $result as $row ) {
					
					$company_slug = $row->company_slug;
					$company_name = $row->company_name;
					$company_type = $row->company_type;
					$content = html_entity_decode($row->company_description);
					$description = substr($content,0,50);
					
				$records["data"][] = array(
					$company_name,
					$company_type,
					'<a href="'.site_url('/admin/counters/company/'.encrypt($row->ID)).'" title="View Cabin">View Counters</a>',
					$description,
					'<div class="center-block"><a href="'.site_url('admin/companies/edit/'.encrypt($row->ID)).'" title="Edit"><i class="fa fa-edit font-blue-ebonyclay"></i></a>&nbsp;&nbsp;<a onclick="return confirm(\'Are you sure you want to delete this company?\');" href="'.site_url('admin/companies/delete/'.encrypt($row->ID)).'" title="Delete"><i class="fa fa-trash-o text-danger"></i></a></div>',
				);
			}

			$records["draw"] = $sEcho;
			$records["recordsTotal"] = $iTotalRecords;
			$records["recordsFiltered"] = $iTotalRecords;

			header('Content-type: application/json');
			echo json_encode($records);
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

      // Start: Process register company
      $this->process_register_new_company();
      // End: Process register company


      $this->data['title'] = 'Register New Company';
      $breadcrumb[] = array('name' => 'Companies', 'url' => 'admin/companies');
      $breadcrumb[] = array('name' => 'Add New', 'url' => '');
      $this->data['breadcrumb'] = $breadcrumb;
      $this->data['current_page'] = 'add_company';

      $this->load->view('templates/header', $this->data);
      $this->load->view('templates/sidebar', $this->data);
      $this->load->view('admin/companies/register', $this->data);
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
				redirect('admin/companies');
			}else{
        $company_details = $this->companies_model->get_company_details($row_id);
        $this->data['company_data'] = $company_details;
        if (empty($this->data['company_data']))
        {
                show_404();
        }
        $this->data['title'] = html_escape($company_details['company_name']);
        $breadcrumb[] = array('name' => 'Companies', 'url' => 'admin/companies');
        $breadcrumb[] = array('name' => 'Edit Company', 'url' => '');
        $this->data['breadcrumb'] = $breadcrumb;
        $this->data['current_page'] = 'edit_company';

      }


      // Start: Process register company
      $this->process_register_new_company();
      // End: Process register company

      $this->load->view('templates/header', $this->data);
      $this->load->view('templates/sidebar', $this->data);
      $this->load->view('admin/companies/edit-company', $this->data);
      $this->load->view('templates/footer', $this->data);

    }

    public function delete($row_salt_id = 0)
    {

      //Get row ID of this Entry
      $row_id = decrypt($row_salt_id)*1;
      if( !is_int($row_id) || !$row_id ) {
        redirect('admin/companies');
      }else{
        $this->data['row_id'] = $row_id;
        $this->common->delete( 'company', array( 'ID' =>  $row_id ) );
        $this->session->set_flashdata('delete_msg','Company have been successfully deleted!');
        redirect('admin/companies');
      }


    }


    //Process Regsiter New Company
    private function process_register_new_company(){
      //Add New Company
      if(($this->input->post('register_new_company') !== NULL) || ($this->input->post('update_company') !== NULL)){
          $this->form_validation->set_rules('company_name', 'Company name', 'trim|required|htmlspecialchars|min_length[2]');
          $this->form_validation->set_rules('company_address', 'Company Address', 'trim|required|htmlspecialchars|min_length[2]');
          $this->form_validation->set_rules('company_phone', 'Company Phone', 'trim|required|htmlspecialchars|min_length[2]');
          $this->form_validation->set_rules('company_mobile', 'Company Mobile', 'trim|required|htmlspecialchars|min_length[2]');
          $this->form_validation->set_rules('company_email', 'Company Email', 'trim|required|valid_email|htmlspecialchars|min_length[2]');
          $this->form_validation->set_rules('company_bank_account', 'Company Bank Account', 'trim|htmlspecialchars|min_length[2]');
          $this->form_validation->set_rules('withdrawal_method', 'Select Withdrawal Method', 'trim|htmlspecialchars|min_length[2]');
          $this->form_validation->set_rules('company_description', 'About Company', 'trim|htmlspecialchars|min_length[2]');
          $this->form_validation->set_rules('company_type', 'Company Type', 'trim|htmlspecialchars');


          $config['upload_path'] = '../files/company';
          //$config['encrypt_name'] = TRUE;
          $config['max_size'] = 100;
          $config['allowed_types'] = 'gif|jpg|png';
          $config['max_width']  = '600';
          $config['max_height']  = '600';
          $config['file_name'] = 'company-photo-'.time().'.jpg';
          $this->load->library('upload', $config);

          //Upload company logo
          $company_logo_name = '';
          if ( $this->upload->do_upload('company_logo') ) {
            $data = array('upload_data' => $this->upload->data());
            $company_logo_name = $data['upload_data']['file_name'];
          }else{
            $company_logo_name = $this->input->post('company_logo_name');
          }

          if( !$this->form_validation->run() ) {
  					$error_message_array = $this->form_validation->error_array();
  					$this->session->set_flashdata('error_msg_arr', $error_message_array);
  				}else{

            $data_arr = array(
              'company_name'=> trim($this->input->post('company_name')),
              'company_logo'=> $company_logo_name,
              'company_description'=> trim($this->input->post('company_description')),
              'company_address'=> trim($this->input->post('company_address')),
              'company_phone'=> trim($this->input->post('company_phone')),
              'company_mobile'=> trim($this->input->post('company_mobile')),
              'company_email'=> trim($this->input->post('company_email')),
              'company_bank_account'=> trim($this->input->post('company_bank_account')),
              'withdrawal_method'=> trim($this->input->post('withdrawal_method')),
              'company_type'=> trim($this->input->post('company_type')),
            );

            if(($this->input->post('update_company_id') !== NULL) || ($this->input->post('update_company') !== NULL)){
                $company_id = $this->input->post('update_company_id');
                $this->common->update( 'company', $data_arr, array( 'ID' =>  $company_id ) );
      					$this->session->set_flashdata('success_msg','Updated done!');
            }else{
              $company_id = $this->common->insert( 'company', $data_arr );
              $generate_company_slug = $this->input->post('company_name').'-'.$company_id;
              $company_slug = url_title($generate_company_slug, 'dash', TRUE);
              $this->common->update( 'company', array('company_slug' => $company_slug), array( 'ID' =>  $company_id ) );
              $this->session->set_flashdata('success_msg','Added done!');
              redirect('admin/companies');
            }



  		}
      }

    }//EOF process company register info


}
