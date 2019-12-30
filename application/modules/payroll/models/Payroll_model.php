<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



class Payroll_model extends MY_Model{
  function __construct(){
    parent::__construct();
  }



  function payhead_list($table_name,$condition,$selected_contents)
  {


    $this->db->select($selected_contents);
    $this->db->from($this->$table_name);
    $this->db->where($condition);
  // $this->db->join('ticket','ticket.ticket_id=log_ticket.ticket_id and ticket.f_id=log_ticket.f_id');
    $this->db->join('leave_category',''.$this->$table_name.'.category_id=leave_category.id');
    $data=$this->db->get()->result_array();



    return $data;



  }


  function salarySettingList($table_name,$condition,$selected_contents)
  {

   $this->db->select($selected_contents);
   $this->db->from(''.$this->$table_name.' as t1');
   $this->db->where($condition);

   $this->db->join('staff as t2','t1.employee_id=t2.id');
   $this->db->join(''.$this->table_designation.' as t3','t1.designation_id=t3.id');
   $this->db->join(''.$this->table_salary_setting_details.' as t4','t1.id=t4.setting_id');
   $data=$this->db->get()->result_array();
   return $data;



 }


 function fetchStaffPayroll($table_name,$condition,$selected_contents)
 {

  $this->db->select($selected_contents);
  $this->db->from(''.$this->$table_name.' as t1');
  $this->db->where($condition);

  $this->db->join(''.$this->table_salary_setting_details.' as t4','t1.id=t4.setting_id');
  $this->db->join(''.$this->table_payhead.' as t2','t4.payhead=t2.id');
          // $this->db->join(''.$this->table_designation.' as t3','t1.designation_id=t3.id');
  $data=$this->db->get()->result_array();
  return $data;





}


function fetchSalaryDetails($table_name,$condition,$selected_contents)

{

  $this->db->select($selected_contents);
  $this->db->from(''.$this->$table_name.' as t1');
  $this->db->where($condition);
  // $this->db->order_by("DATE(t1.created_at)", "inc");
          // $this->db->join(''.$this->table_salary_setting_details.' as t4','t1.id=t4.setting_id');
  $this->db->join(''.$this->table_staff.' as t2','t1.employee_id=t2.id');
          // $this->db->join(''.$this->table_designation.' as t3','t1.designation_id=t3.id');
  $data=$this->db->get()->result_array();
  return $data;
}

function sellerDetails($table_name,$condition,$selected_contents)
{


 $this->db->select($selected_contents);
 $this->db->from(''.$this->$table_name.' as t1');
 $this->db->where($condition);

          // $this->db->join(''.$this->table_salary_setting_details.' as t4','t1.id=t4.setting_id');
 $this->db->join(''.$this->table_seller_setting.' as t2','t2.f_id=t1.id');
          // $this->db->join(''.$this->table_designation.' as t3','t1.designation_id=t3.id');
 $data=$this->db->get()->row_array();
 return $data;


}

function fetch_salary_setting($table_name,$condition,$selected_contents)
{
  $this->db->select($selected_contents);
  $this->db->from(''.$this->$table_name.' as t1');
  $this->db->where($condition);

          // $this->db->join(''.$this->table_salary_setting_details.' as t4','t1.id=t4.setting_id');
  $this->db->join(''.$this->table_salary_setting_details.' as t2','t1.id=t2.setting_id');
  $this->db->join(''.$this->table_staff.' as t3','t3.id=t1.employee_id');
  $this->db->join(''.$this->table_payhead.' as t4','t2.payhead=t4.id');
  $data=$this->db->get()->result_array();
  return $data;


}

function payslip_details($table_name,$condition,$selected_contents)
{
  $this->db->select($selected_contents);
  $this->db->from(''.$this->$table_name.' as t1');
  $this->db->where($condition);

          // $this->db->join(''.$this->table_salary_setting_details.' as t4','t1.id=t4.setting_id');
  // $this->db->join(''.$this->table_employee_salary_details.' as t2','t1.id=t2.salary_id');
  // $this->db->join(''.$this->table_staff.' as t3','t3.id=t1.employee_id');
  $this->db->join(''.$this->table_payhead.' as t2','t1.payhead_id=t2.id');
  $data=$this->db->get()->result_array();
  return $data;


}
function payslip_staff_details($table_name,$condition,$selected_contents)
{
  $this->db->select($selected_contents);
  $this->db->from(''.$this->$table_name.' as t1');
  $this->db->where($condition);
  $this->db->join(''.$this->table_staff.' as t2','t2.id=t1.employee_id and t1.f_id=t2.f_id');
  // $this->db->join(''.$this->table_department.' as t3','t3.id=t1.department_id and t1.f_id=t2.f_id');
  $data=$this->db->get()->row_array();
  return $data;

          // $this->db->join(''.$this->table_salary_setting_details.' as t4','t1.id=t4.setting_id');
  // $this->db->join(''.$this->table_employee_salary_details.' as t2','t1.id=t2.salary_id');
  // $this->db->join(''.$this->table_payhead.' as t4','t2.payhead_id=t4.id');

}
function payhead_details($table_name,$condition,$selected_contents)
{
  $this->db->select($selected_contents);
  $this->db->from(''.$this->$table_name.' as t1');
  $this->db->where($condition);

          // $this->db->join(''.$this->table_salary_setting_details.' as t4','t1.id=t4.setting_id');
  // $this->db->join(''.$this->table_employee_salary_details.' as t2','t1.id=t2.salary_id');
  // $this->db->join(''.$this->table_staff.' as t3','t3.id=t1.employee_id');
  $this->db->join(''.$this->table_payhead_details.' as t2','t1.payhead_id=t2.id');
  $data=$this->db->get()->result_array();
  return $data;


}


}