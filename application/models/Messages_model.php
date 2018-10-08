<?php
class Messages_model extends CI_Model {

        public function __construct()
        {
            parent::__construct();
            // Your own constructor code
            $this->load->database();
        }
		
		public function get_messages($slug = FALSE)
			{
				if ($slug === FALSE)
				{
						$query = $this->db->get('messages');
						return $query->result_array();
				}

				$query = $this->db->get_where('messages', array('msg_slug' => $slug));
				return $query->row_array();
			}
				
		public function get_message_details($message_id)
			{

					$query = $this->db->get_where('messages', array('ID' => $message_id));
					return $query->row_array();
			}		

}
