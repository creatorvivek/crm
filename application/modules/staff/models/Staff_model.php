<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



class Staff_model extends MY_Model{
    function __construct(){
        parent::__construct();
    }



function fetch_attendance($table_name,$condition,$selected_contents)
{
 $this->db->select($selected_contents);
  $this->db->from(''.$this->$table_name.' as t1');
  $this->db->where($condition);
  
  $this->db->join(''.$this->table_staff.' as t2','t1.staff_id=t2.id');
  $data=$this->db->get()->result_array();
	return $data;

}

function select_staff($table_name,$condition,$selected_contents)
{
 $this->db->select($selected_contents);
  $this->db->from(''.$this->$table_name.' as t1');
  $this->db->where($condition);
  
  $this->db->join(''.$this->table_designation.' as t2','t1.designation_id=t2.id','left');
  $this->db->join(''.$this->table_department.' as t3','t1.department_id=t3.id','left');
  $data=$this->db->get()->result_array();
	return $data;

}

function staff_detail($table_name,$condition,$selected_contents)
{

  $this->db->select($selected_contents);
  $this->db->from(''.$this->$table_name.' as t1');
  $this->db->where($condition);
  
  $this->db->join(''.$this->table_designation.' as t2','t1.designation_id=t2.id');
  $this->db->join(''.$this->table_department.' as t3','t1.department_id=t3.id');
  $data=$this->db->get()->row_array();
  return $data;

}
























}