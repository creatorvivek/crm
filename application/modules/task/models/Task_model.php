<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



class Task_model extends MY_Model{
    function __construct(){
        parent::__construct();
    }



function issueList($table_name,$condition,$content_display)
{


    $this->db->select($content_display);
    $this->db->from($this->$table_name);
    if(!is_null($condition))
      $this->db->where($condition);
    $this->db->join($this->table_staff,''.$this->$table_name.'.staff_id='.$this->table_staff.'.id');
    $data= $this->db->get()->result_array();
    if($data){
      
    return $data;
    }
    return array();   
   
  }

  function dailyReport($table_name,$condition,$content_display,$start_date,$end_date)
  {

 $this->db->select($content_display);
    $this->db->from($this->$table_name);
    if(!is_null($condition))
      $this->db->where($condition);
    $this->db->join($this->table_staff,''.$this->$table_name.'.staff_id='.$this->table_staff.'.id');
     if(!empty($start_date) && !empty($end_date))
          $this->db->where("date(".$this->$table_name.".created_at) BETWEEN '$start_date' AND '$end_date'");
    $data= $this->db->get()->result_array();
    if($data){
      
    return $data;
    }
    return array();   



  }












}

