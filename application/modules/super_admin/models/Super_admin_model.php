<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



class Super_admin_model extends MY_Model{
    function __construct(){
        parent::__construct();
    }


 function seller_list($table_name,$condition=null,$content_display)
    {
 
  $this->db->select($content_display);
  $this->db->from($this->$table_name);
  if(!is_null($condition))
   $this->db->where($condition);

 // $this->db->join($this->table_staff,''.$this->table_staff.'.id='.$this->$table_name.'.staff_id');
 $this->db->join($this->table_seller_setting,''.$this->table_seller_setting.'.f_id='.$this->$table_name.'.id');
 $data=$this->db->get()->result_array();


  return $data;
    }


function select_staff($table_name,$condition=null,$content_display)
{
 $this->db->select($content_display);
  $this->db->from($this->$table_name);
  if(!is_null($condition))
   $this->db->where($condition);

 // $this->db->join($this->table_staff,''.$this->table_staff.'.id='.$this->$table_name.'.staff_id');
 $this->db->join($this->table_staff,''.$this->table_staff.'.id='.$this->$table_name.'.staff_id');
 $data=$this->db->get()->result_array();


  return $data;

}







}