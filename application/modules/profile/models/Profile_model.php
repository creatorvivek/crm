<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



class Profile_model extends MY_Model{
    function __construct(){
        parent::__construct();
    }


function user_info($table_name,$condition=null,$content_display)
{

  
  
  $this->db->select($content_display);
  $this->db->from($this->$table_name);
  if(!is_null($condition))
   $this->db->where($condition);

 $this->db->join($this->table_login,''.$this->table_login.'.staff_id='.$this->$table_name.'.id');
 $data=$this->db->get()->row_array();


  return $data;

}
}


 // $db2->join($this->table_frenchise,''.$this->table_login.'.f_id='.$this->table_frenchise.'.id');


