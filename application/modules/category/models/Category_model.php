<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



class Category_model extends MY_Model{
    function __construct(){
        parent::__construct();
    }


function fetchCategoryID($table_name,$condition)
{


   $this->db->select_max('category_id');
   $this->db->from($this->$table_name);
   $this->db->where($condition);       
   $id = $this->db->get()->row_array();
      // return json_encode($id);
   if(is_null($id['category_id']))
   {
   // $id=1;
     $returnData= 1 ;
   }
   else
   {
     $id= ++$id['category_id'];
     $returnData=$id;
   }
   return $returnData;
}








}