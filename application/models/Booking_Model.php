<?php
class Booking_Model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }


    function get_all( $table = '',$condition = array(),$select = '', $group_by = '', $order_by = '', $limit = 0, $offset = 0, $join_arr_left = '', $join_arr = '' ) {
      if(!empty($condition))
        $this->db->where($condition);
      if($select)
        $this->db->select($select,false);
      if($group_by)
        $this->db->group_by($group_by);
      if($order_by)
        $this->db->order_by($order_by);
      if($limit)
        $this->db->limit($limit,$offset);

      if( $join_arr_left ) {
        foreach( $join_arr_left as $tbl => $cond ) {
          $this->db->join( $tbl, $cond, 'left');
        }
      }
      if( $join_arr ) {
        foreach( $join_arr as $tbl => $cond ) {
          $this->db->join( $tbl, $cond);
        }
      }
      $query = $this->db->get($table);

      return $query->result();
    }

}
