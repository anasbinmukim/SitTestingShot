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
		
		public function get_books($start, $length, $order, $dir)
		 {
			 if($order !=null) {
				$this->db->order_by($order, $dir);
			}
			  return $this->db
				   ->limit($length,$start)
				   ->get("messages");
		 }
		 
		 public function get_total_books()
		 {
			  $query = $this->db->select("COUNT(*) as num")->get("messages");
			  $result = $query->row();
			  if(isset($result)) return $result->num;
			  return 0;
		 }
		 
		 function search_books($length, $start, $search)
			{
				$query = $this
						->db
						->like('ID',$search)
						->or_like('msg_slug',$search)
						->limit($length, $start)
						->get('messages');
				
			   
				if($query->num_rows()>0)
				{
					return $query;  
				}
				else
				{
					return null;
				}
			}


}
