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
}
