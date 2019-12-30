<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Payroll extends MY_Controller
{

 function __construct()
 {
  parent::__construct();
  $this->load->model('Payroll_model');

}





function payhead()
{
  $data['title']='PAYHEAD';
  $f_id=$this->session->f_id;
  $condition=array('f_id'=>$f_id);
  $data['payhead_list']=$this->Payroll_model->select('table_payhead',$condition,array('id','payhead_name','payhead_type'));
  $data['_view'] = 'payhead';
  $this->load->view('index',$data);


}

function add_payhead()
{

  $f_id=$this->session->f_id;
  // $staff_id=$this->session->staff_id;
  $name = strip_tags($this->input->post('payhead_name',1));
  $description = strip_tags($this->input->post('description',1));
  $payhead_type = strip_tags($this->input->post('payhead_type',1));
  

  $this->load->library('form_validation');
  
  $this->form_validation->set_rules('payhead_name','Payroll  Name','required');
  $this->form_validation->set_rules('description','Description','required');
  $this->form_validation->set_rules('payhead_type','Payhead type','required');


  if($this->form_validation->run())     
  {  

    $date=date('Y-m-d H:i:s');
    $Params=array(

      'payhead_name' => $name,
      'description'=> $description,
      'payhead_type'=>$payhead_type,
      'f_id'=>$f_id,



    );
    $id= $this->Payroll_model->insert('table_payhead',$Params);
    if($id)
    {



      $this->session->alerts = array(
        'severity'=> 'success',
        'title'=> 'succesfully add'

      );


      redirect('payroll/payhead');

    }
    else
    {
     $this->session->alerts = array(
      'severity'=> 'danger',
      'title'=> 'not add'

    );


     redirect('payroll/payhead');

   }
 }
 else
 {
   $this->payhead();
 }
}

function salary_setting()
{

  $data['title']='Salary setting';
  $data['staff_name']=ucfirst($this->session->menu_staff ? $this->session->menu_staff : 'STAFF');
  $f_id=$this->session->f_id;
  $condition=array('f_id'=>$f_id,'status'=>1);
  ## designation fetch
  $data['department']=$this->Payroll_model->select('table_department',$condition,array('id','name'));
  /*----*/
  $conditionSalarySetting=array('t1.f_id'=>$f_id,'t1.status'=>1);
  $data['list_salary_setting']=$this->Payroll_model->fetch_salary_setting('table_salary_setting',$conditionSalarySetting,array('t1.id','name','t4.payhead_name','t2.unit','if(t2.unit_type=1,"Rs.","%") as type','if(t4.payhead_type=1,"+","-") as payhead_type'));
  // echo '<pre>';
  // print_r($data['list_salary_setting']);die;
  $data['payhead']=$this->Payroll_model->select('table_payhead',$condition,array('id','payhead_name'));

  $data['salary_setting']=$this->Payroll_model->select('table_salary_setting',$condition,array('id'));
  $data['_view'] = 'salary_setting';
  $this->load->view('index',$data);



}

// function salary_setting_list()
// {
//  $f_id=$this->session->f_id;
//  $condition=array('t1.f_id'=>$f_id,'t1.status'=>1);
//  $data=$this->Payroll_model->salarySettingList('table_salary_setting',$condition,array('t2.name as staff_name','t3.name as designation_name','t1.id','t4.unit','if(t4.unit=1,"Amount","percentage") as unit'));
//  echo '<pre>';
//  print_r($data);


// }


function add_salary_setting()
{
  $f_id=$this->session->f_id;

  $this->load->library('form_validation');
  ##it is used to callabck method in validation when we send parameter in callback method
  $this->form_validation->CI =& $this;
  ##--##
  $payhead = $this->input->post('payhead',1);
  
  $this->form_validation->set_rules('designation','Designation','required');
  $this->form_validation->set_rules('payhead','Payhead','required');
  $this->form_validation->set_rules('employee','employee','required|callback_check_salary_setting['.$payhead.']');
  $this->form_validation->set_message('check_salary_setting', 'This salary setting already exists.');


  if($this->form_validation->run())     
  {  

    $designation = strip_tags($this->input->post('designation',1));
    $employee = strip_tags($this->input->post('employee',1));
    $unit_type = $this->input->post('unit_type',1);
    $unit = $this->input->post('unit',1);
  // print_r($designation);
    $date=date('Y-m-d H:i:s');

    ##check employee setting is previously exists or not
    $check=$this->Payroll_model->select_id('table_salary_setting',array('f_id'=>$f_id,'employee_id'=>$employee),array('id'));
  
    if(!$check)
    {  
      $Params=array(

        'employee_id'=>$employee,
        'designation_id'=>$designation,


        'f_id'=>$f_id,
        'created_at'=>$date
      );
      $id= $this->Payroll_model->insert('table_salary_setting',$Params);
    }
    else
    {

      $id=$check['id'];
    }
    // $count=count($payhead);
    // for($i=0;$i<$count;$i++)
    // {
    $param2=array(

      'setting_id'=>$id,
      'payhead'=>$payhead,
      'unit_type'=>$unit_type,
      'unit'=>$unit


    );
    $id= $this->Payroll_model->insert('table_salary_setting_details',$param2);

    // }

    if($id)
    {
      $this->session->alerts = array(
        'severity'=> 'success',
        'title'=> 'succesfully add'

      );
      redirect('payroll/salary_setting');
    }
    else
    {
     $this->session->alerts = array(
      'severity'=> 'danger',
      'title'=> 'not add'

    );
     redirect('payroll/salary_setting');

   }
 }
 else
 {
   $this->salary_setting();
 }
}

function check_salary_setting($employee_id,$payhead)
{

 $f_id=$this->session->f_id;
 $conditionSalarySetting=array('t2.payhead'=>$payhead,'t1.f_id'=>$f_id,'t1.employee_id'=>$employee_id);
 // print_r($conditionSalarySetting);
 $data['list_salary_setting']=$this->Payroll_model->fetch_salary_setting('table_salary_setting',$conditionSalarySetting,array('name','t4.payhead_name','t2.unit','t2.id'));
  // print_r($data['list_salary_setting']);
 if($data['list_salary_setting'])
 {
    // echo 'f';
  return false;
}
else
{
    // echo 't';
  return true;
}
}

function staff_salary()
{
 $data['staff_name']=ucwords($this->session->menu_staff ? $this->session->menu_staff : 'STAFF');
 $f_id=$this->session->f_id;
 $condition=array('f_id'=>$f_id,'status');
 $data['department']=$this->Payroll_model->select('table_department',$condition,array('id','name'));
 $data['staff_salary']=$this->Payroll_model->select('table_employee_salary',$condition,array('id'));
 // $condition=array('f_id'=>$f_id);
 $data['payhead_list']=$this->Payroll_model->select('table_payhead',$condition,array('id','payhead_name','payhead_type'));
 $data['_view'] = 'staff_salary';
 $this->load->view('index',$data);



}

function add_staff_salary()
{


  $f_id=$this->session->f_id;

  $this->load->library('form_validation');
  $this->form_validation->CI =& $this;
  $employee = strip_tags($this->input->post('employee',1));
  $year = strip_tags($this->input->post('year',1));
  $month = strip_tags($this->input->post('month',1));
  $var= $year.'//'.$employee;
  $this->form_validation->set_rules('designation','Designation','required');
  $this->form_validation->set_rules('employee','Description','required');
  $this->form_validation->set_rules('year','Year','required');
  $this->form_validation->set_rules('month','Month','required|callback_check_employee_salary_record['.$var.']');
  $this->form_validation->set_message('check_employee_salary_record', 'The salary of this month is already given.');

  if($this->form_validation->run())     
  {  

    $designation = strip_tags($this->input->post('designation',1));
    $gross = strip_tags($this->input->post('total_amount',1));
    $unit = $this->input->post('unit',1);
    $amount = $this->input->post('amount',1);
    $unit_type = $this->input->post('unit_type',1);
    $payhead = $this->input->post('payhead_id',1);

  // print_r($unit_type);


    $date=date('Y-m-d H:i:s');
    $Params=array(

      'employee_id'=>$employee,
      'designation_id'=>$designation,
      'gross_salary'=>$gross,
      'year'=>$year,
      'month'=>$month,
      'f_id'=>$f_id,
      'created_at'=>$date
    );
    $id= $this->Payroll_model->insert('table_employee_salary_master',$Params);

    $count=count($payhead);

    for($i=0;$i<$count;$i++)
    {
      $param2=array(

        'salary_id'=>$id,
        'payhead_id'=>$payhead[$i],
        'unit_type'=>$unit_type[$i],
        'unit'=>$unit[$i],
        'amount'=>$amount[$i]


      );
      $return_id= $this->Payroll_model->insert('table_employee_salary_details',$param2);


    }

    ##account transaction
     $accountTransactionCompanyAdjustment=array(
  
      'reference_type'=>7,
      'credit'=>$gross,
      'f_id'=>$f_id,
  
      'employee_id'=>$employee,
      'ledger_group'=>10,##cash in hand

      'created_at'=>date('Y-m-d')

    );
    $this->Payroll_model->insert('table_account_transaction',$accountTransactionCompanyAdjustment);  
   
    ##for double entry

    $accountTransactionCompany=array(
  // 'reference_id'=>$last_inserted_id,
      'reference_type'=>7,
      'debit'=>$gross,
      'f_id'=>$f_id,
  // 'invoice_id'=>$invoice_id,
      'employee_id'=>$employee,
      'double_entry'=>1,
      'ledger_group'=>11,##expence

  // 'caf_id'=>$params[0]['id'],
      'created_at'=>date('Y-m-d')

    );
    $this->Payroll_model->insert('table_account_transaction',$accountTransactionCompany);   

    if($id)
    {
      $this->session->alerts = array(
        'severity'=> 'success',
        'title'=> 'succesfully add'

      );
      // redirect('payroll/salary_list');
    }
    else
    {
     $this->session->alerts = array(
      'severity'=> 'danger',
      'title'=> 'not add'

    );

   }
   redirect('payroll/salary_list');
 }
 else
 {
   $this->staff_salary();
 }


}

##callback method
function check_employee_salary_record($month,$var)
{
 $f_id=$this->session->f_id;
 $array = explode('//', $var);
 $condition=array('f_id'=>$f_id,'month'=>$month,'year'=>$array[0],'employee_id'=>$array[1]);
 // $condition=array('f_id'=>$f_id,'month'=>$month,'year'=>$year,'employee_id'=>$employee);
 // print_r($condition);
 $data_return=$this->Payroll_model->select_id('table_employee_salary_master',$condition,array('id'));

 if($data_return)
 {
  return false;
}
else
{
  return true;
}

}


function fetch_staff_payroll()
{

  $staff_id=trim($this->input->post('staff_id',1));
  // $staff_id=6;
  $f_id=$this->session->f_id;
  $positive_amount=0;
  $negative_amount=0;

  ### fetch basic pay of employee by employee id
  $basic_salary=$this->Payroll_model->select_id('table_staff',array('id'=>$staff_id,'f_id'=>$f_id),array('basic_pay'));

  $condition=array('employee_id'=>$staff_id,'t1.f_id'=>$f_id);
  $payroll= $this->Payroll_model->fetchStaffPayroll('table_salary_setting',$condition,array('payhead_name','payhead_type','unit_type','unit','basic_pay','payhead as payhead_id'));
  $basic_pay=$basic_salary['basic_pay'];
  $basic_data=array(
    'payhead_id'=>1,//temporary 
    'payhead_name'=>'Basic pay',
    'status'=>'',
    'amount'=>$basic_pay,
    'unit_type'=>"1",
    'unit'=>$basic_pay,
    'payhead_type'=>'1'


  );
  // print_r($basic_pay);
  $main_data=array();
  array_push($main_data,$basic_data);
  for($i=0;$i<count($payroll);$i++)
  {

    ##payhead type 1 means addition
    if($payroll[$i]['payhead_type']==1)
    {

      ## unit type 1 means amount
      if($payroll[$i]['unit_type']=='1')
      {

        $amount=$payroll[$i]['unit'];
      }
      else
      {
        $amount=$basic_pay*($payroll[$i]['unit']/100);
      }
      $param=array(
       'payhead_id'=>$payroll[$i]['payhead_id'],
       'payhead_name'=>$payroll[$i]['payhead_name'],
       'payhead_type'=>$payroll[$i]['payhead_type'],
       'status'=>'+',
       'amount'=>$amount,
       'unit_type'=>$payroll[$i]['unit_type'],
       'unit'=>$payroll[$i]['unit']

     );  

      $positive_amount+=$amount;
      array_push($main_data,$param);

    }



    else if($payroll[$i]['payhead_type']==2)
    {

      if($payroll[$i]['unit_type']=='1')
      {

        $amount=$payroll[$i]['unit'];
      }
      else
      {
        $amount=$basic_pay*($payroll[$i]['unit']/100);
      }
      $param=array(
        'payhead_id'=>$payroll[$i]['payhead_id'],
        'payhead_name'=>$payroll[$i]['payhead_name'],
        'payhead_type'=>$payroll[$i]['payhead_type'],
        'status'=>'-',
        'amount'=>$amount,
        'unit_type'=>$payroll[$i]['unit_type'],
        'unit'=>$payroll[$i]['unit']

      );  
      $negative_amount+=$amount;
      array_push($main_data,$param);
    }
    // $gross_amount=0;
    // echo $positive_amount;
    // echo '<br>';
    // echo $negative_amount;
    // echo '<br>';
      // print_r($gross_amount);

  }

  $data['main_data']=$main_data;

  echo json_encode($data);
  // echo json_encode($main_data);  




}

function salary_list()
{
 $f_id=$this->session->f_id;
 $data['heading']='SALARY LIST';
 $data['title']='Salary List';
 $condition=array('t1.f_id'=>$f_id);  
 $data['salary']= $this->Payroll_model->fetchSalaryDetails('table_employee_salary_master',$condition,array('t1.id','t1.month','t1.year','t1.created_at','t1.gross_salary','t2.name'));
 $data['_view'] = 'salary_list';
 $this->load->view('index.php',$data);
}

function my_salary_list()
{
  $data['title']='My Salary';
  $data['heading']='MY SALARY';
  $f_id=$this->session->f_id;
  $staff_id=$this->session->staff_id;
 $condition=array('t1.f_id'=>$f_id,'t1.employee_id'=>$staff_id);  
 $data['salary']= $this->Payroll_model->fetchSalaryDetails('table_employee_salary_master',$condition,array('t1.id','t1.month','t1.year','t1.created_at','t1.gross_salary','t2.name'));
 $data['_view'] = 'salary_list';
 $this->load->view('index.php',$data);
}
function salary_slip($id)
{

 $f_id=$this->session->f_id;
 $this->load->helper('user_helper');

 ##fetch seller info
 $condition=array('t1.id'=>$f_id);
 $data['seller_info']=$this->Payroll_model->sellerDetails('table_seller',$condition,array('company_name','email','mobile','address','city','pincode','logo'));
 $conditionStaff=array(
  't1.id'=>$id,
);
 $conditionPayslipAdd=array(
  't1.salary_id'=>$id,
  't2.payhead_type'=>1
);
 $conditionPayslipDed=array(
  't1.salary_id'=>$id,
  't2.payhead_type'=>2
);
 $data['staff']=$this->Payroll_model->payslip_staff_details('table_employee_salary_master',$conditionStaff,array('t2.name as staff_name','address','city','pincode','year','month','t1.created_at','employee_code','date_of_joining','gross_salary','t1.id as payslip_id'));
 if($data['staff'])
 {
##fetch employee details and salary commaon details
 $data['salary_addition']= $this->Payroll_model->payslip_details('table_employee_salary_details',$conditionPayslipAdd,array('t2.payhead_name','t1.unit','if(t1.unit_type=1,"Rs.","%") as type','if(t2.payhead_type=1,"+","-") as payhead_type','amount'));
 $data['salary_deduction']= $this->Payroll_model->payslip_details('table_employee_salary_details',$conditionPayslipDed,array('t2.payhead_name','t1.unit','if(t1.unit_type=1,"Rs.","%") as type','if(t2.payhead_type=1,"+","-") as payhead_type','amount'));
 $data['gross_in_words']=numberTowords($data['staff']['gross_salary']);
 $data['month'] = date("F", strtotime("2001-" . $data['staff']['month'] . "-01"));
    // echo '<pre>';
    // print_r($data);
    // die;
  // $data[]=$this->Payroll_model->sellerDetails
 $data['_view'] = 'salary_slip';
 $this->load->view('index.php',$data);
}
else
{


  show_error('Invalid payslip  number');
}





}

function remove_salary_setting($id)
{

  $this->Payroll_model->delete('table_salary_setting_details',array('id'=>$id));


}

##called by ajax
function payhead_detail()
{
  $payhead_id=$this->input->post('payhead_id',1);
  $f_id=$this->session->f_id;
  $condition=array('f_id'=>$f_id,'id'=>$payhead_id);
  $payhead_list=$this->Payroll_model->select_id('table_payhead',$condition,array('id as payhead_id','payhead_name','payhead_type'));
  echo json_encode($payhead_list);

}
##called by ajax
function payhead_of_staff()
{
  $staff_id=$this->input->post('staff_id',1);
  $f_id=$this->session->f_id;
  $condition=array('f_id'=>$f_id,'id'=>$staff_id);
  $payhead_list=$this->Payroll_model->select_id('table_payhead',$condition,array('id as payhead_id','payhead_name','payhead_type'));
  echo json_encode($payhead_list);

}



/*all function end*/
}