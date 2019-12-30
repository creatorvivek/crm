<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



class Crn_model extends MY_Model{
    function __construct(){
        parent::__construct();
    }


    function search_query($table_name,$condition,$search_query)
    {


  
        $this->db->select('id,name,email,mobile,pincode,city,address');

        $this->db->from($this->$table_name);  

        $this->db->where($condition);

        $this->db->group_start();
        $this->db->where("crn.name like '$search_query%' ");

        $this->db->or_where("crn.mobile like '$search_query%' ");

        $this->db->group_end();

        $data=$this->db->get()->result_array();
        $sql = $this->db->last_query();
        return $data;
    }








}