<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



class Group_model extends MY_Model{
    function __construct(){
        parent::__construct();
    }

	function fetch_staff_by_group($condition=null,$content_display)
	{
		
		$this->db->select($content_display);
		$this->db->from($this->table_map_group);
		if(!is_null($condition))
			$this->db->where($condition);
		$this->db->join($this->table_staff,''.$this->table_map_group.'.member_id='.$this->table_staff.'.id');
		
		$data= $this->db->get()->result_array();
		return $data;
		
	}

}