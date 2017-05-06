<?php
class Companies_Model extends CI_Model {

        public function __construct()
        {
            parent::__construct();
            // Your own constructor code
            $this->load->database();
        }

				public function get_companies($slug = FALSE)
				{
				        if ($slug === FALSE)
				        {
				                $query = $this->db->get('company');
				                return $query->result_array();
				        }

				        $query = $this->db->get_where('company', array('company_slug' => $slug));
				        return $query->row_array();
				}

        public function get_company_details($company_id)
				{

				        $query = $this->db->get_where('company', array('ID' => $company_id));
				        return $query->row_array();
				}


        public function get_counters($slug = FALSE)
        {
                if ($slug === FALSE)
                {
                        $query = $this->db->get('company_counter');
                        return $query->result_array();
                }

                $query = $this->db->get_where('company_counter', array('counter_slug' => $slug));
                return $query->row_array();
        }

        public function get_counter_details($counter_id)
        {

                $query = $this->db->get_where('company_counter', array('ID' => $counter_id));
                return $query->row_array();
        }

}
