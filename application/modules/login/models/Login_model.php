<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



class Login_model extends MY_Model{
  function __construct(){
    parent::__construct();
  }

  function getResult($username,$password)
  {
    $this->db->where('username',$username);
    $this->db->where('password',$password);
    $query = $this->db->get('user_authentication');
    return $query->row_array();
  }

  function getAutorization($autorizationId)
  {
    $this->db->where('id', $autorizationId);
    $query = $this->db->get('master_authorization');
    return $query->row_array();
  }

  
  function insertLogs($data)
  {
    $this->db->insert('log_login',$data);
    return $this->db->insert_id();
  }
  function fetchSellerInfo($table_name,$condition=null,$content_display)
  {
   
    $this->db->select($content_display);
    $this->db->from($this->$table_name);
    if(!is_null($condition))
     $this->db->where($condition);

   $this->db->join($this->table_staff,''.$this->table_staff.'.id='.$this->$table_name.'.staff_id');
   $this->db->join($this->table_seller_setting,''.$this->table_seller_setting.'.f_id='.$this->$table_name.'.f_id');
   $data=$this->db->get()->row_array();


   return $data;
 }

 ##fetch Email of staff member
 function fetchEmail($table_name,$condition=null,$content_display)
 {
   
  $this->db->select($content_display);
  $this->db->from($this->$table_name);
  if(!is_null($condition))
   $this->db->where($condition);

 $this->db->join($this->table_staff,''.$this->table_staff.'.id='.$this->$table_name.'.staff_id');

 $data=$this->db->get()->row_array();


 return $data;
}

##at logout time it will update login log table by logout time
function set_logout_time($log_id,$logout_time)
{
  $this->db->where('id',$log_id);
  
  $this->db->set('logout_time',$logout_time);
  $this->db->update('log_login');
  return $this->db->affected_rows();
}
}

?>