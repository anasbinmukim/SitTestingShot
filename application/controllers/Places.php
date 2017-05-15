<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Places extends RM_Controller {

    public function __construct()
    {
            parent::__construct();
            $this->load->library('form_validation');
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
                  base_url('seatassets/js/table-datatables-buttons.js'),
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
                $join_arr_left = array(
          				'place_thana pt' => 'pt.ID = pa.thana_id',
                  'place_district pd' => 'pd.ID = pt.district_id',
          			);
                $order_by = 'area_name ';
          			$order = 'ASC ';
          			$sort = $order_by.' '.$order;
                $result = $this->common->get_all( 'place_area pa', '', 'pa.*, pt.thana_name, pd.district_name', $sort, '', '', $join_arr_left );
                $this->data['area_rows'] = $result;
                $this->data['js_files'] = array(
    						  base_url('assets/global/scripts/datatable.js'),
    						  base_url('assets/global/plugins/datatables/datatables.min.js'),
    						  base_url('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js'),
                  base_url('seatassets/js/table-datatables-responsive.js'),
    						);
            }elseif($page == 'via_place'){
                $join_arr_left = array(
          				'place_thana pt' => 'pt.ID = vp.thana_id',
                  'place_district pd' => 'pd.ID = pt.district_id',
          			);
                $order_by = 'place_name ';
          			$order = 'ASC ';
          			$sort = $order_by.' '.$order;
                $result = $this->common->get_all( 'via_place vp', '', 'vp.*, pt.thana_name, pd.district_name', $sort, '', '', $join_arr_left );
                $this->data['via_place_rows'] = $result;
                $this->data['js_files'] = array(
    						  base_url('assets/global/scripts/datatable.js'),
    						  base_url('assets/global/plugins/datatables/datatables.min.js'),
    						  base_url('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js'),
                  base_url('seatassets/js/table-datatables-responsive.js'),
    						);
                $this->data['title'] = 'Via places';
            }else{
              $this->data['js_files'] = array(
                base_url('assets/global/scripts/datatable.js'),
                base_url('assets/global/plugins/datatables/datatables.min.js'),
                base_url('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js'),
                base_url('assets/pages/scripts/table-datatables-responsive.min.js'),
              );

            }

            //$this->data['title'] = ucfirst($page); // Capitalize the first letter

            $this->load->view('templates/header', $this->data);
            $this->load->view('templates/sidebar', $this->data);
            $this->load->view('places/view-'.$page, $this->data);
            $this->load->view('templates/footer', $this->data);
    }

    public function add($page = 'area')
    {

      if(($page == 'area') || ($page == 'via_place')){
          $this->data['css_files'] = array(
            base_url('assets/global/plugins/select2/css/select2.min.css'),
            base_url('assets/global/plugins/select2/css/select2-bootstrap.min.css'),
          );
          $this->data['js_files'] = array(
            base_url('assets/global/plugins/select2/js/select2.full.min.js'),
            base_url('assets/global/plugins/jquery-validation/js/jquery.validate.min.js'),
          );
      }

      if ( ! file_exists(APPPATH.'views/places/add-'.$page.'.php'))
      {
              // Whoops, we don't have a page for that!
              show_404();
      }

      //Start: Process division
      $this->process_division_info();
      //End: Process division

      //Start: Process district info
      $this->process_district_info();
      //End: Process district info

      //Start: Process thana info
      $this->process_thana_info();
      //End: Process thana info

      //Start: Process area info
      $this->process_area_info();
      //End: Process area info

      //Start: Process area info
      $this->process_via_place_info();
      //End: Process area info

      $this->data['title'] = ucfirst($page); // Capitalize the first letter

      $this->load->view('templates/header', $this->data);
      $this->load->view('templates/sidebar', $this->data);
      $this->load->view('places/add-'.$page, $this->data);
      $this->load->view('templates/footer', $this->data);

    }


    public function edit($page = 'area', $row_salt_id = 0)
    {


      if(($page == 'area') || ($page == 'via_place')){
          $this->data['css_files'] = array(
            base_url('assets/global/plugins/select2/css/select2.min.css'),
            base_url('assets/global/plugins/select2/css/select2-bootstrap.min.css'),
          );
          $this->data['js_files'] = array(
            base_url('assets/global/plugins/select2/js/select2.full.min.js'),
            base_url('assets/global/plugins/jquery-validation/js/jquery.validate.min.js'),
          );
      }

      //Get row ID of this Entry
      $row_id = decrypt($row_salt_id)*1;
			if( !is_int($row_id) || !$row_id ) {
				redirect('/places');
			}else{
        $this->data['row_id'] = $row_id;
      }

      if ( ! file_exists(APPPATH.'views/places/edit-'.$page.'.php'))
      {
              // Whoops, we don't have a page for that!
              show_404();
      }


      //Start: Process district info
      $this->process_district_info();
      //End: Process district info

      //Start: Process thana info
      $this->process_thana_info();
      //End: Process thana info

      //Start: Process area info
      $this->process_area_info();
      //End: Process area info

      //Start: Process area info
      $this->process_via_place_info();
      //End: Process area info

      $this->data['title'] = ucfirst($page); // Capitalize the first letter

      $this->load->view('templates/header', $this->data);
      $this->load->view('templates/sidebar', $this->data);
      $this->load->view('places/edit-'.$page, $this->data);
      $this->load->view('templates/footer', $this->data);

    }

    public function delete($page = 'area', $row_salt_id = 0)
    {

      //Get row ID of this Entry
      $row_id = decrypt($row_salt_id)*1;
      if( !is_int($row_id) || !$row_id ) {
        redirect('/places');
      }else{
        $this->data['row_id'] = $row_id;
      }

      //Delete district Entry
      if($page == 'district'){
          $this->common->delete( 'place_district', array( 'ID' =>  $row_id ) );
          $this->session->set_flashdata('delete_msg','Item has been deleted!');
          redirect('/places/view/district');
      }

      //Delete district Entry
      if($page == 'thana'){
          $this->common->delete( 'place_thana', array( 'ID' =>  $row_id ) );
          $this->session->set_flashdata('delete_msg','Item has been deleted!');
          redirect('/places/view/thana');
      }

      //Delete Area info
      if($page == 'area'){
          $this->common->delete( 'place_area', array( 'ID' =>  $row_id ) );
          $this->session->set_flashdata('delete_msg','Item has been deleted!');
          redirect('/places/view/area');
      }

      //Delete Via Place info
      if($page == 'via_place'){
          $this->common->delete( 'via_place', array( 'ID' =>  $row_id ) );
          $this->session->set_flashdata('delete_msg','Item has been deleted!');
          redirect('/places/view/via_place');
      }

    }


    //Process District Info
    private function process_district_info(){
      //Add New District
      if(isset($_POST['add_district'])){
          $this->form_validation->set_rules('district_name', 'District name', 'trim|required|htmlspecialchars|min_length[2]');

          $data_arr = array(
            'district_name'=> trim($this->input->post('district_name')),
            'division_id'=> trim($this->input->post('division_id')),
          );

          if( !$this->form_validation->run() ) {
  					$error_message_array = $this->form_validation->error_array();
  					$this->session->set_flashdata('error_msg_arr', $error_message_array);
  				}else{
            $this->common->insert( 'place_district', $data_arr );
  					$this->session->set_flashdata('success_msg','Added done!');
  					redirect('/places/view/district');
  				}
      }

      //Update District
      if(isset($_POST['update_district'])){
          $this->form_validation->set_rules('district_name', 'District name', 'trim|required|htmlspecialchars|min_length[2]');

          $data_arr = array(
            'district_name'=> trim($this->input->post('district_name')),
            'division_id'=> trim($this->input->post('division_id')),
          );

          $district_id = $this->input->post('district_id');

          if( !$this->form_validation->run() ) {
  					$error_message_array = $this->form_validation->error_array();
  					$this->session->set_flashdata('error_msg_arr', $error_message_array);
  				}else{
  					$this->common->update( 'place_district', $data_arr, array( 'ID' =>  $district_id ) );
  					$this->session->set_flashdata('success_msg','Updated done!');
  					redirect('/places/view/district');
  				}
      }

    }//EOF process District info


    //Process Thana Info
    private function process_thana_info(){
      //Add New Thana
      if(isset($_POST['add_thana'])){
          $this->form_validation->set_rules('thana_name', 'Thana name', 'trim|required|htmlspecialchars|min_length[2]');

          $data_arr = array(
            'thana_name'=> trim($this->input->post('thana_name')),
            'district_id'=> trim($this->input->post('district_id')),
          );

          if( !$this->form_validation->run() ) {
  					$error_message_array = $this->form_validation->error_array();
  					$this->session->set_flashdata('error_msg_arr', $error_message_array);
  				}else{
            $this->common->insert( 'place_thana', $data_arr );
  					$this->session->set_flashdata('success_msg','Added done!');
  					redirect('/places/view/thana');
  				}
      }

      //Update Thana
      if(isset($_POST['update_thana'])){
          $this->form_validation->set_rules('thana_name', 'Thana name', 'trim|required|htmlspecialchars|min_length[2]');

          $data_arr = array(
            'thana_name'=> trim($this->input->post('thana_name')),
            'district_id'=> trim($this->input->post('district_id')),
          );

          $thana_id = $this->input->post('thana_id');

          if( !$this->form_validation->run() ) {
  					$error_message_array = $this->form_validation->error_array();
  					$this->session->set_flashdata('error_msg_arr', $error_message_array);
  				}else{
  					$this->common->update( 'place_thana', $data_arr, array( 'ID' =>  $thana_id ) );
  					$this->session->set_flashdata('success_msg','Updated done!');
  					redirect('/places/view/thana');
  				}
      }

    }//EOF process thana info





    //Process Area Info
    private function process_area_info(){
      //Add New Area
      if(isset($_POST['add_area'])){
          $this->form_validation->set_rules('area_name', 'Area name', 'trim|required|htmlspecialchars|min_length[2]');

          $data_arr = array(
            'area_name'=> trim($this->input->post('area_name')),
            'thana_id'=> trim($this->input->post('thana_id')),
          );

          if( !$this->form_validation->run() ) {
            $error_message_array = $this->form_validation->error_array();
            $this->session->set_flashdata('error_msg_arr', $error_message_array);
          }else{
            $this->common->insert( 'place_area', $data_arr );
            $this->session->set_flashdata('success_msg','Added done!');
            redirect('/places/view/area');
          }
      }

      //Update Area
      if(isset($_POST['update_area'])){
          $this->form_validation->set_rules('area_name', 'Area name', 'trim|required|htmlspecialchars|min_length[2]');

          $data_arr = array(
            'area_name'=> trim($this->input->post('area_name')),
            'thana_id'=> trim($this->input->post('thana_id')),
          );

          $area_id = $this->input->post('area_id');

          if( !$this->form_validation->run() ) {
            $error_message_array = $this->form_validation->error_array();
            $this->session->set_flashdata('error_msg_arr', $error_message_array);
          }else{
            $this->common->update( 'place_area', $data_arr, array( 'ID' =>  $area_id ) );
            $this->session->set_flashdata('success_msg','Updated done!');
            redirect('/places/view/area');
          }
      }

    }//EOF process thana info


    //Process Via Places Info
    private function process_via_place_info(){
      //Add New Area
      if(isset($_POST['add_via_place'])){
          $this->form_validation->set_rules('place_name', 'Place name', 'trim|required|htmlspecialchars|callback_placename_check|min_length[2]');
          $this->form_validation->set_rules('address', 'Place Address', 'trim|required|htmlspecialchars|min_length[2]');

          $data_arr = array(
            'place_name'=> trim($this->input->post('place_name')),
            'address'=> trim($this->input->post('address')),
            'thana_id'=> trim($this->input->post('thana_id')),
            'type'=> trim($this->input->post('type')),
          );

          if( !$this->form_validation->run() ) {
            $error_message_array = $this->form_validation->error_array();
            $this->session->set_flashdata('error_msg_arr', $error_message_array);
          }else{
            $this->common->insert( 'via_place', $data_arr );
            $this->session->set_flashdata('success_msg','Added done!');
            redirect('/places/view/via_place');
          }
      }

      //Update Area
      if(isset($_POST['update_via_place'])){
          $this->form_validation->set_rules('address', 'Place Address', 'trim|required|htmlspecialchars|min_length[2]');

          $data_arr = array(
            'address'=> trim($this->input->post('address')),
            'thana_id'=> trim($this->input->post('thana_id')),
            'type'=> trim($this->input->post('type')),
          );

          $place_id = $this->input->post('place_id');

          if( !$this->form_validation->run() ) {
            $error_message_array = $this->form_validation->error_array();
            $this->session->set_flashdata('error_msg_arr', $error_message_array);
          }else{
            $this->common->update( 'via_place', $data_arr, array( 'ID' =>  $place_id ) );
            $this->session->set_flashdata('success_msg','Updated done!');
            redirect('/places/view/via_place');
          }
      }

    }//EOF process Via Places info

    public function placename_check(){
      $exist_via_places = $this->common->get( 'via_place', array( 'place_name' => trim($this->input->post('place_name')), 'type' => trim($this->input->post('type')) ) );
      if(!empty($exist_via_places)){
          $this->form_validation->set_message('placename_check', 'This place already exists, please try using new one.');
          return FALSE;
      }
      else
        return TRUE;
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
  					redirect('/places/add/division');
  				}else{
  					$this->common->insert( 'place_division', $data_arr );
  					$this->session->set_flashdata('success_msg','Added done!');
  					redirect('/places/add/division');
  				}
      }

    }//EOF process division info


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
      $row_id = $this->input->post('row_id');
      $db_table = trim($this->input->post('db_table'));
      $action_type = $this->input->post('action_type');
      if( ($row_id != '0') && ($db_table != '') && ($action_type == 'delete') ){
          $this->common->delete( $db_table, array( 'ID' =>  $row_id ) );
          echo json_encode(array("msg" => "Deleted!"));
      		exit;
      }elseif( ( ($this->input->post('division_name') !== NULL) && ($this->input->post('division_name') != '')) && ($row_id != '0') && ($db_table == 'place_division') && ($action_type == 'update') ){
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
