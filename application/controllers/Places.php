<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Places extends RM_Controller {

    public function __construct()
    {
            parent::__construct();
            if ( ! $this->session->userdata('logged_in') ) {
							redirect('/login/');
						}
    }

    public function index()
    {
        $this->data['title'] = 'Places';

        $this->load->view('templates/header',$this->data);
        $this->load->view('templates/sidebar', $this->data);
        $this->load->view('places/places', $this->data);
        $this->load->view('templates/footer', $this->data);
    }

    public function view($page = 'area')
    {

            if ( ! file_exists(APPPATH.'views/places/view-'.$page.'.php'))
            {
                    // Whoops, we don't have a page for that!
                    show_404();
            }

            $this->data['css_files'] = array(
						  base_url('assets/global/plugins/datatables/datatables.min.css'),
						  base_url('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css'),
						);

            //load division info
            if($page == 'division'){
                $result = $this->common->get_all( 'place_division' );
                $this->data['division_rows'] = $result;

                $this->data['js_files'] = array(
    						  base_url('assets/global/scripts/datatable.js'),
    						  base_url('assets/global/plugins/datatables/datatables.min.js'),
    						  base_url('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js'),
                  base_url('assets/pages/scripts/table-datatables-responsive.min.js'),
                  base_url('seatassets/js/table-division-editable.js'),
    						);
            }elseif($page == 'zone'){
                $result = $this->common->get_all( 'place_zone' );
                $this->data['zone_rows'] = $result;

                $this->data['js_files'] = array(
    						  base_url('assets/global/scripts/datatable.js'),
    						  base_url('assets/global/plugins/datatables/datatables.min.js'),
    						  base_url('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js'),
                  base_url('assets/pages/scripts/table-datatables-responsive.min.js'),
                  base_url('seatassets/js/table-zone-editable.js'),
    						);
            }elseif($page == 'district'){
                $result = $this->common->get_all( 'place_district' );
                $this->data['district_rows'] = $result;
                $this->data['js_files'] = array(
    						  base_url('assets/global/scripts/datatable.js'),
    						  base_url('assets/global/plugins/datatables/datatables.min.js'),
    						  base_url('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js'),
                  base_url('assets/pages/scripts/table-datatables-responsive.min.js'),
                  base_url('seatassets/js/table-district-editable.js'),
    						);
            }elseif($page == 'thana'){
                $result = $this->common->get_all( 'place_thana' );
                $this->data['thana_rows'] = $result;
                $this->data['js_files'] = array(
    						  base_url('assets/global/scripts/datatable.js'),
    						  base_url('assets/global/plugins/datatables/datatables.min.js'),
    						  base_url('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js'),
                  base_url('assets/pages/scripts/table-datatables-responsive.min.js'),
                  base_url('seatassets/js/table-datatables-buttons.js'),
    						);
            }elseif($page == 'area'){
                $result = $this->common->get_all( 'place_thana' );
                $this->data['thana_rows'] = $result;
                $this->data['js_files'] = array(
    						  base_url('assets/global/scripts/datatable.js'),
    						  base_url('assets/global/plugins/datatables/datatables.min.js'),
    						  base_url('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js'),
                  base_url('assets/pages/scripts/table-datatables-responsive.min.js'),
    						);
            }else{
              $this->data['js_files'] = array(
                base_url('assets/global/scripts/datatable.js'),
                base_url('assets/global/plugins/datatables/datatables.min.js'),
                base_url('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js'),
                base_url('assets/pages/scripts/table-datatables-responsive.min.js'),
              );

            }

            $this->data['title'] = ucfirst($page); // Capitalize the first letter

            $this->load->view('templates/header', $this->data);
            $this->load->view('templates/sidebar', $this->data);
            $this->load->view('places/view-'.$page, $this->data);
            $this->load->view('templates/footer', $this->data);
    }

    public function add_new($page = 'area')
    {

      //Start: Process division
      $this->process_division_info();
      //End: Process division

      if ( ! file_exists(APPPATH.'views/places/add-'.$page.'.php'))
      {
              // Whoops, we don't have a page for that!
              show_404();
      }

      $this->data['title'] = ucfirst($page); // Capitalize the first letter

      $this->load->view('templates/header', $this->data);
      $this->load->view('templates/sidebar', $this->data);
      $this->load->view('places/add-'.$page, $this->data);
      $this->load->view('templates/footer', $this->data);

    }


    public function edit($page = 'area')
    {

      if ( ! file_exists(APPPATH.'views/places/edit-'.$page.'.php'))
      {
              // Whoops, we don't have a page for that!
              show_404();
      }

      $this->data['title'] = ucfirst($page); // Capitalize the first letter

      $this->load->view('templates/header', $this->data);
      $this->load->view('templates/sidebar', $this->data);
      $this->load->view('places/edit-'.$page, $this->data);
      $this->load->view('templates/footer', $this->data);

    }

    public function delete($page = 'area')
    {

      if ( ! file_exists(APPPATH.'views/places/delete-'.$page.'.php'))
      {
              // Whoops, we don't have a page for that!
              show_404();
      }

      $this->data['title'] = ucfirst($page); // Capitalize the first letter

      $this->load->view('templates/header', $this->data);
      $this->load->view('templates/sidebar', $this->data);
      $this->load->view('places/delete-'.$page, $this->data);
      $this->load->view('templates/footer', $this->data);

    }

    private function process_division_info(){
      //Add new division
      if(isset($_POST['add_division'])){
          $this->form_validation->set_rules('division_name', 'Division name', 'trim|required|htmlspecialchars|min_length[2]');

          $data_arr = array(
            'division_name'=> trim($this->input->post('division_name')),
          );

          if( !$this->form_validation->run() ) {
  					$error_message_array = $this->form_validation->error_array();
  					$this->session->set_flashdata('error_msg_arr', $error_message_array);
  					redirect('/places/add_new/division');
  				}else{
  					$this->common->insert( 'place_division', $data_arr );
  					$this->session->set_flashdata('success_msg','Added done!');
  					redirect('/places/add_new/division');
  				}
      }

    }//EOF process division info

    //SOF process division ajax info
    public function process_division_ajax_info(){
      $result = array();

      $result['success_message'] = 'Update done!';
      //print_r($records);
			header('Content-type: application/json');
		  echo json_encode($result);
    }//EOF process division ajax info


    //Delete Dividion
    public function delete_division( $division_solt_id = 0 ) {
      if( $division_solt_id == '0' ) {
      }else {
        $division_id = decrypt($division_solt_id)*1;
        if( !is_int($division_id) || !$division_id ) {
        }else{
          $this->common->delete( 'place_division', array( 'ID' =>  $division_id ) );
          //redirect('/places/view/division');
        }
      }
    }

    //Process Place Data
    public function process_places() {
      $row_id = $_POST['row_id'];
      $db_table = trim($_POST['db_table']);
      $action_type = $_POST['action_type'];

      if( ($row_id != '0') && ($db_table != '') && ($action_type == 'delete') ){
          $this->common->delete( $db_table, array( 'ID' =>  $row_id ) );
          echo json_encode(array("msg" => "Deleted!"));
      		exit;
      }elseif( (isset($_POST['division_name']) && $_POST['division_name'] != '') && ($row_id != '0') && ($db_table == 'place_division') && ($action_type == 'update') ){
          $division_name = $_POST['division_name'];
          $this->common->update( $db_table, array('division_name' => $division_name), array( 'ID' =>  $row_id ) );
          echo json_encode(array("msg" => "Updated done!"));
      		exit;
      }else{
        echo json_encode(array("msg" => "Error occured!"));
        exit;
      }


    }

}
