<?php


class Log_model extends MY_Model
{
    function __construct()
    {
        parent::__construct();
    }


function insert_log($params)
{

$this->db->insert('log',$params);


}


function select_log($crn_number='')
{
	$this->db->select('activity, date,name as staff_name');
	$this->db->from('log');
	if($crn_number)
	$this->db->join('staff','log.staff_id=staff.id');	
	$this->db->where('crn_number',$crn_number);
	return $this->db->get()->result_array();

}










}
?>