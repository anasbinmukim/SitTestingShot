<?php
class Notification_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		// Your own constructor code
		$this->load->database();
	}

	public function get_notification_details($notification_id)
	{

		$query = $this->db->get_where('notification', array('ID' => $notification_id));
		return $query->row_array();
	}	

}
