<?php


class MY_Model extends CI_Model
{

#table customer
 protected $table_crn='crn';
/*/------/*/



  protected $table_group='team_group';
  protected $table_ticket='ticket';
  protected $table_ticket_log='log_ticket';
  protected $table_map_ticket_assign='ticket_assign_map';
  protected $table_map_group='map_group_member';
  protected $table_category='category';
  protected $table_task='task';
  protected $table_login='user_authentication';
 
  protected $table_master_id='master_id_proof';
 
 
  protected $table_seller='seller';
  protected $table_seller_setting='seller_setting';
 
  
 
 
  protected $table_tax_count='tax_frenchise_count';
  protected $table_sms_configuration='sms_configuration';
  protected $table_sms_log='log_outgoing_sms';
  protected $table_sms_template='template_sms';
  protected $table_email_configuration='email_configuration';
  protected $table_email_log='log_outgoing_email';
  protected $table_email_template='template_email';
  protected $table_attend_type='master_attend_type';
  protected $table_log_login='log_login';
##account

  protected $table_payment_type='master_payment_type';
  protected $table_customer_balance='customer_balance';
  protected $table_invoices='invoices';
  protected $table_master_invoice='master_invoice';
  protected $table_payment_details='payment_details';
  protected $table_vendors_payment='vendors_payment_details';
  protected $table_account_transaction='account_transaction';
  protected $table_transaction='transaction';
  protected $table_account_transaction_type='account_transaction_type';
  protected $table_ledger_group='ledger_group';
  protected $table_manual_journal='manual_journal';



  ##--##


  
  ##sales & service
  protected $table_sales='sales';
  protected $table_sales_details='sales_details';
  protected $table_target_sales='target_sales';
  protected $table_services='services';
  protected $table_service_purchase="service_purchase";
  protected $table_sales_return="sales_return";
##--##


  ##item
  protected $table_item='item_list';
  protected $table_item_details='item_details';
 protected $table_item_adjustment_details='item_adjustment_details';
 protected $table_item_adjustment='item_adjustment';
  protected $table_vendor="vendor";
  protected $table_purchase_master="purchase_master";
  protected $table_purchase_details="purchase_details";
  protected $table_quotation="quotation";
  protected $table_quotation_details="quotation_details";
  protected $table_item_graph="item_report";
    protected $table_measurement_unit='items_measurement_unit';
    protected $table_purchase='purchase_item';
    protected $table_item_stock='item_stock';
    protected $table_purchase_details_batch_wise='purchase_item_batch_wise';
##--##

#employee table
  protected $table_staff='staff';
  protected $table_leave_category='leave_category';
  protected $table_leave_request='leave_request';

  protected $table_issue_report='issue_report';
  protected $table_daily_report='daily_report';
  protected $table_lead='lead';
  protected $table_designation='emp_designation';
  protected $table_department='emp_department';

  protected $table_staff_attendance='staff_attendance';
  protected $table_issue_category='issue_category';





/*/------/*/


##payroll table
  protected $table_payhead='sal_payhead';
  protected $table_salary_setting='sal_salary_setting';
  protected $table_salary_setting_details='sal_salary_setting_details';
  protected $table_employee_salary='sal_staff_salary';
  protected $table_employee_salary_master='sal_staff_salary';
  protected $table_employee_salary_details='sal_staff_salary_details';
  /*/------/*/




  function __construct()
  {
   parent::__construct();
   
 }


  /* response stracture
    response: success,fail
    code    : 2XX,4XX,5XX
    data    : {json string}
  */

  #generic function for select
  function select($table_name,$condition=null,$content_display,$order=null){ //table names,columns,join type,condition
## condition and $content_dispaly show be an array
    #return json response
      /* response stracture
    response: success,fail
    code    : 2XX,4XX,5XX
    data    : {json string}

  */
    // $returnData=array('status'=>'not found','status_code'=>404);
    
    $this->db->select($content_display);
    if(!is_null($order))
    $this->db->order_by("DATE(created_at)", "inc");
    $this->db->from($this->$table_name);
    if(!is_null($condition))
      $this->db->where($condition);
    $data= $this->db->get()->result_array();
    if($data){
      
    return $data;
    }
    return array();
    // return json_encode($returnData);
  }

  #generic function for insert
  function insert($table_name,$params){ 
  //single insert or multiple inserts

  /* response stracture
    response: success,fail
    code    : 2XX,4XX,5XX
    data    : {json string} | last inserted id | error message
  */
    
    
    $this->db->insert($this->$table_name,$params);
    $id= $this->db->insert_id();
    return $id;
    // if($id)
    // {
    //   $returnData=array('status'=>'success','last_inserted_id'=>$id,'status_code'=>200) ;
    // }

    // return json_encode($returnData);
    
  }

  #generic function for delete
  function delete($table_name,$condition){

  /* response stracture
    response: success,fail
    code    : 2XX,4XX,5XX
    data    : {json string} | deleted id & query condition for delete
  */$returnData=array('status'=>'failure','status_code'=>400);
    
    $this->db->where($condition);
    $this->db->delete($this->$table_name);
    $row=$this->db->affected_rows();
    $query_condition=$this->db->last_query();

    
    if($row)
    {
      $returnData=array('status'=>'success','last_deleted_id'=>$condition,'status_code'=>200) ;
    }
    return json_encode($returnData);
  }

  #generic function for update
  function update($condition,$table_name,$params){

  /* response stracture
    response: success,fail
    code    : 2XX,4XX,5XX
    data    : {json string} | updated id | query condition for update
  */
    $returnData=array('status'=>'not updated','status_code'=>400);
    
    $this->db->where($condition);
    $this->db->update($this->$table_name,$params);
    $row=$this->db->affected_rows();
    $query_condition=$this->db->last_query();
    if($row)
    {
     $returnData=array('status'=>'success','last_updated_id'=>$condition,'status_code'=>200) ;
   }
   
   return $row;

 }

 function select_id($table_name,$condition=null,$content_display,$order=null)
  {
    $this->db->select($content_display);
    if(!is_null($order))
    $this->db->order_by("DATE(created_at)", "desc");
    $this->db->from($this->$table_name);
    if(!is_null($condition))
      $this->db->where($condition);
    $data= $this->db->get()->row_array();
    return $data;
    // if($data){
      
    // return $data;
    // }
    // return array();

  }

 ##update particular coloumn in a table
 function update_col($table_name,$condition,$params)
 {
  
  $this->db->where($condition);

  $this->db->set($params);
  $this->db->update($this->$table_name);
  $row=$this->db->affected_rows();
  if($row)
  {
   return 'success';
 }
 else
 {
   return 'failure';
 }
}


##counting number of rows in table
function counting($table_name,$condition=null)
{
  
  if(!is_null($condition))
    $this->db->where($condition);

  $count=$this->db->get($this->$table_name)->num_rows();
  return $count;

}
##sum particular col of table
function sum_column($table_name,$condition=null,$coloumn_name,$start_date='',$end_date='')
{
  
  $this->db->select_sum($coloumn_name);
  if(!is_null($condition))
    $this->db->where($condition);
   if(!empty($start_date) && !empty($end_date))
  $this->db->where("date(created_at) BETWEEN '$start_date' AND '$end_date'");
  $count=$this->db->get($this->$table_name)->row_array();
    if($count[$coloumn_name])
    {
 return $count[$coloumn_name];
}
else
{
  return 0;
 
}

}


## fetch data between particular two date
function report($table_name,$display_contents,$condition,$start_date='',$end_date='',$status='',$coloumn='created_at')
{

 
 
 $this->db->select($display_contents);
 $this->db->from($this->$table_name);

 $this->db->where($condition);
 if(!empty($start_date) && !empty($end_date))
  $this->db->where("date(".$coloumn.") BETWEEN '$start_date' AND '$end_date'");
if(!empty($status))
  $this->db->where('status',$status);
$data=$this->db->get()->result_array();


return $data;

}


## fetch data between two dates(special we can given time intervel )
function data_between_date($table_name,$display_contents,$condition,$interval_unit,$table_row='created_at',$group_by='',$order_by='')
{


 
 $this->db->select($display_contents);
 $this->db->from($this->$table_name);

 $this->db->where($condition);
 // if(!empty($start_date) && !empty($end_date))
 if($table_row)
  $this->db->where(" DATE(".$table_row.") BETWEEN DATE_SUB( CURDATE( ),".$interval_unit." ) AND CURDATE( )");
  if($group_by)
     $this->db->group_by(''.$group_by.'(created_at)');
   if($order_by)
    $this->db->order_by(''.$order_by.'(created_at)','asc');
$data=$this->db->get()->result_array();


return ($data);

}
## fetch data of current month and year 
function data_current($table_name,$display_contents,$condition,$interval_unit,$table_row='created_at',$start_date='',$end_date='')
{


 
 $this->db->select($display_contents);
 $this->db->from($this->$table_name);

 $this->db->where($condition);
 // if(!empty($start_date) && !empty($end_date))
  $this->db->where(" DATE(".$table_row.") BETWEEN DATE_FORMAT( CURDATE( ),".$interval_unit." ) AND CURDATE( )");

$data=$this->db->get()->result_array();


return ($data);

}

## count data between data and interval given
function data_between_date_count($table_name,$display_contents,$condition,$interval_unit='',$start_date='',$end_date='')
{


 
 $this->db->select($display_contents);


 $this->db->where($condition);
 // if(!empty($start_date) && !empty($end_date))
 if($interval_unit)
  $this->db->where(" date(created_at) BETWEEN DATE_SUB( CURDATE( ),".$interval_unit." ) AND CURDATE( )");

$data=$this->db->get($this->$table_name)->num_rows();;

return ($data);

}
## count data between current year,month,week data and interval given
function data_current_count($table_name,$display_contents,$condition,$interval_unit,$start_date='',$end_date='')
{


 
 $this->db->select($display_contents);


 $this->db->where($condition);
 // if(!empty($start_date) && !empty($end_date))
   $this->db->where(" date(created_at) between  DATE_FORMAT(CURDATE() ,".$interval_unit.") AND CURDATE()");

$data=$this->db->get($this->$table_name)->num_rows();;


return ($data);

}
## sum data betwwen date and given interval
function data_sum_between_date($table_name,$display_contents,$condition,$interval_unit,$coloumn='created_at',$start_date='',$end_date='')
{
  $this->db->select_sum($display_contents);
 // $this->db->from($this->$table_name);

 $this->db->where($condition);
 // if(!empty($start_date) && !empty($end_date))
  $this->db->where(" date(".$coloumn.") between  DATE_SUB(CURDATE() ,".$interval_unit.") AND CURDATE()");

      $count=$this->db->get($this->$table_name)->row_array();
        if(!is_null($count[$display_contents]))
        {
      return $count[$display_contents];
        }
        else
        {
          $count[$display_contents]=0;
          return $count[$display_contents];
        }
}
## sum data betwwen date and given interval of current year,month,weak
function data_sum_current($table_name,$display_contents,$condition,$interval_unit,$coloumn='created_at',$start_date='',$end_date='')
{


 
 $this->db->select_sum($display_contents);


 $this->db->where($condition);
 // if(!empty($start_date) && !empty($end_date))
   $this->db->where(" date(".$coloumn.") between  DATE_FORMAT(CURDATE() ,".$interval_unit.") AND CURDATE()");

$count=$this->db->get($this->$table_name)->row_array();
  if(!is_null($count[$display_contents]))
        {
      return $count[$display_contents];
        }
        else
        {
          $count[$display_contents]=0;
          return $count[$display_contents];
        }

// return ($data);

}

}
?>