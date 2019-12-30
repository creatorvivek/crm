<?php


class Authentication_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

/*
* Get subject by id
*/
function check_authentication($controller_name,$function_name,$user_id,$authorization_id)

{
    
    $this->db->from('access_by_indivisual');
  
   $this->db->where(array('controller_name'=>$controller_name,'function_name'=>$function_name,'user_id'=>$user_id));
  
    $row=$this->db->get()->num_rows();
    // var_dump($row.',',$user_id);die;
    if($row>0)
    {
        return true;
    }
    else
    {

        $this->db->from('access_by_group');
        $this->db->where(array('controller_name'=>$controller_name,'function_name'=>$function_name,'authorization_id'=>$authorization_id));
        // $thsi->db->where()
            $row_data=$this->db->get()->num_rows();
            // var_dump($row_data);
            if($row_data>0)
            {
                return TRUE;
            }
            else
            {
                return FALSE;
            }
         }
   
}

















}
?>