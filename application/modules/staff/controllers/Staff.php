<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Staff extends MY_Controller
{

 function __construct()
 {
  parent::__construct();
  $this->load->model('Staff_model');

}





function add_staff()
{

  $heading=strtoupper(isset($this->session->menu_staff)?$this->session->menu_staff:'STAFF' );
  $data['heading']=$heading;
  $data['title']='ADD '. $heading;
  $f_id=$this->session->f_id;
  $condition=array('f_id'=>$f_id,'status'=>1);
  $data['designation']=$this->Staff_model->select('table_designation',$condition,array('id','name'));
  $data['department']=$this->Staff_model->select('table_department',$condition,array('id','name'));
  $data['_view'] = 'add_staff';
  $this->load->view('index',$data);
}



##add staff process
function add()
{
  $name = strip_tags($this->input->post('name',1));
  $employee_code = strip_tags($this->input->post('emp_code',1));
  $doj = strip_tags($this->input->post('doj',1));
  $qualification = strip_tags($this->input->post('qualification',1));
  $department = strip_tags($this->input->post('department',1));
  $designation = strip_tags($this->input->post('designation',1));
  $experience = strip_tags($this->input->post('experience',1));
  $basic_pay = strip_tags($this->input->post('basic_pay',1));
   // $name=strip_tags($this->security->xss_clean($this->input->post('name')));
  $email = strip_tags($this->input->post('email',1));
  $mobile = strip_tags($this->input->post('mobile',1));
  
  $gender = strip_tags($this->input->post('gender',1));
  $address = strip_tags($this->input->post('address',1));
  $city = strip_tags($this->input->post('city',1));
  $pincode = strip_tags($this->input->post('pincode',1));
  $dob = strip_tags($this->input->post('dob',1));
  $aadhar_no = strip_tags($this->input->post('aadhar_no',1));
  $pan_no = strip_tags($this->input->post('pan_no',1));
  $user_role = $this->input->post('user_role');
  // $password = $this->input->post('password');
  // $encrtyted_password=md5($password);
  // print_r($basic_pay);die;
  $this->load->library('form_validation');
  $this->form_validation->CI =& $this;
  $this->form_validation->set_rules('name','Name','required|trim|alpha_numeric_spaces');

  $this->form_validation->set_rules('email','Email','required|valid_email|trim');
  $this->form_validation->set_rules('gender','Gender','required');
  $this->form_validation->set_rules('emp_code','Employee Code','callback_check_empcode');
  

  $this->form_validation->set_rules('mobile','Mobile number','required|exact_length[10]|numeric');
  $this->form_validation->set_message('check_empcode', 'This Employee Code is already exists.');
  if($this->form_validation->run() )     
  {  
    $f_id=$this->session->f_id;

    $params=array(
      'employee_code'=>$employee_code,
      'date_of_joining'=>$doj,
      'qualification'=>$qualification,
      'department_id'=>$department,
      'designation_id'=>$designation,
      'experience'=>$experience,
      'basic_pay'=>$basic_pay,
      'name'=>$name,
      'dob'=>$dob,
      'aadhar_no'=>$aadhar_no,
      'pan_no'=>$pan_no,
      'pincode'=>$pincode ,
      'city'=>$city,
      'address'=>$address ,
      'email'=>$email,
      'mobile'=>$mobile,
      'created_at'=>date('Y-m-d H:i:s'),
      'f_id'=>$f_id,
      'gender'=>$gender,

    );
// print_r($params);die;
    $addStaff=$this->Staff_model->insert('table_staff',$params);


    

    $password=rand(1,10000).rand(1,9000);
    $encrepted_password=md5($password);
    $username=$f_id.'_'.rand(1,10000);
    

    $credentialParams=array(
      'username'=>$username,
      'password'=>$encrepted_password,
      'clear_text'=>$password,
      'f_id'=>$f_id,
      'staff_id'=>$addStaff,
      'type'=>$this->session->type,
      'authorization_id'=>$user_role
      // 'api_key'=>123
    );


##send username and password in credential table
    $resultPortalLogin=$this->Staff_model->insert('table_login',$credentialParams);
    ##send sms to user
//     $smsParam=array(
//       'mobile'=>$mobile,
//       'username'=>$username,
//       'password'=>$password,
//       // 'f_id'=>$f_id,
//       'module'=>'user credential',
// );
//     $sms=modules::run('sms/sms/send_sms_notification',$smsParam,'POST');
     ##send email to frenchise
    $emailParam=array(
      'email'=>$email,
      'username'=>$username,
      'password'=>$password,
      'f_id'=>$f_id,
      'module'=>'user credential',
    );
    $email=modules::run('email/email/send_email_notification',$emailParam,'POST');
    $this->session->alerts = array(
      'severity'=> 'success',
      'title'=> 'successfully added'

    );
    redirect('staff/staff_list');

  }
  else
  {
    $this->add_staff();
  }


}


function check_empcode($emo_code)
{
  $condition=array('employee_code'=>$emo_code,'f_id'=>$this->session->f_id);
  $result=$this->Staff_model->select_id('table_staff',$condition,array('employee_code'));
  if($result)
  {
    return false;
  } 
  else{
    return true;
  } 

}
function staff_list()
{
  $f_id=$this->session->f_id;
  $condition=array('t1.f_id'=>$f_id,'t1.status'=>1);
  $heading=strtoupper(isset($this->session->menu_staff)?$this->session->menu_staff:'STAFF' );

  $data['heading']=$heading;
  $data['title']=$heading.' LIST';
  $staffData= $this->Staff_model->select_staff('table_staff',$condition,array('t1.id','t1.name','email','mobile','gender','t1.employee_code','t1.created_at','t2.name as designation','t3.name as department'));
//  echo '<pre>';
// print_r($staffData);die;
  if($staffData)
  {
    $data['staff']=$staffData;
  }

  else
  {
    $data['staff']=[];
  }
  $data['_view'] = 'staffList';
  $this->load->view('index',$data);


}
function edit($id)
{
      $f_id=$this->session->f_id;
  $condition=array('f_id'=>$f_id,'status'=>1);
  $data['designation']=$this->Staff_model->select('table_designation',$condition,array('id','name'));
  $data['department']=$this->Staff_model->select('table_department',$condition,array('id','name'));
  $heading=strtoupper(isset($this->session->menu_staff)?$this->session->menu_staff:'STAFF' );
  $data['heading']=$heading;
  $params=array('id'=>$id);
  $staff_total =$this->Staff_model->select_id('table_staff',$params,array('*'));
      $data['staff']=$staff_total;
  
  if(isset($staff_total['id']))
  {
    $name = strip_tags($this->input->post('name',1));
    $employee_code = strip_tags($this->input->post('emp_code',1));
    $doj = strip_tags($this->input->post('doj',1));
    $qualification = strip_tags($this->input->post('qualification',1));
    $department = strip_tags($this->input->post('department',1));
    $designation = strip_tags($this->input->post('designation',1));
    $experience = strip_tags($this->input->post('experience',1));
    $basic_pay = strip_tags($this->input->post('basic_pay',1));
   // $name=strip_tags($this->security->xss_clean($this->input->post('name')));
    $email = strip_tags($this->input->post('email',1));
    $mobile = strip_tags($this->input->post('mobile',1));

    $gender = strip_tags($this->input->post('gender',1));
    $address = strip_tags($this->input->post('address',1));
    $city = strip_tags($this->input->post('city',1));
    $pincode = strip_tags($this->input->post('pincode',1));
    $dob = strip_tags($this->input->post('dob',1));
    $aadhar_no = strip_tags($this->input->post('aadhar_no',1));
    $pan_no = strip_tags($this->input->post('pan_no',1));
    $user_role = $this->input->post('user_role');
    $resignation = $this->input->post('resignation');
  // $password = $this->input->post('password');
  // $encrtyted_password=md5($password);
  // print_r($basic_pay);die;
    $this->load->library('form_validation');
    $this->form_validation->CI =& $this;
    $this->form_validation->set_rules('name','Name','required|trim|alpha_numeric_spaces');

    $this->form_validation->set_rules('email','Email','required|valid_email|trim');
    $this->form_validation->set_rules('gender','Gender','required');
    $this->form_validation->set_rules('emp_code','Employee Code','required');


    $this->form_validation->set_rules('mobile','Mobile number','required|exact_length[10]|numeric');
    // $this->form_validation->set_message('check_empcode', 'This Employee Code is already exists.');
    if($this->form_validation->run() )     
    {  

      $params=array(
        'employee_code'=>$employee_code,
        'date_of_joining'=>$doj,
        'qualification'=>$qualification,
        'department_id'=>$department,
        'designation_id'=>$designation,
        'experience'=>$experience,
        'basic_pay'=>$basic_pay,
        'name'=>$name,
        'dob'=>$dob,
        'aadhar_no'=>$aadhar_no,
        'pan_no'=>$pan_no,
        'pincode'=>$pincode,
        'city'=>$city,
        'address'=>$address,
        'email'=>$email,
        'mobile'=>$mobile,
        'resignation'=>$resignation,
        
       
        'gender'=>$gender,

      );
      $updateCondition=array('f_id'=>$f_id,'id'=>$id);
// print_r($params);die;
      $updateStaff=$this->Staff_model->update_col('table_staff',$updateCondition,$params);

     

    }
    else
    {
        $data['_view'] = 'edit';
      $this->load->view('index',$data);
    }

  }
    else
    {
      show_error('this id is not exist');
    }
  // var_dump($staff['data']);

  }
  function update($id)
  {
   $name = $this->input->post('name',1);
   $email = $this->input->post('email',1);
   $mobile = $this->input->post('mobile',1);
   $gender = $this->input->post('gender',1);
  // $groupId = $this->input->post('group');
  //  $username = $this->input->post('username');
  // $password = $this->input->post('password');
  // $encrtyted_password=md5($password);

   $f_id=$this->session->f_id;
// if()
   $params=array(

    'name'=>$name,
    'email'=>$email,
    'mobile'=>$mobile,
    'gender'=>$gender
    // 'created_at'=>date('Y-m-d H:i:s'),
    // 'f_id'=>$f_id

  );
   $condition=array('id'=>$id);
   $this->Staff_model->update($condition,'table_staff',$params);


   $this->session->alerts = array(
    'severity'=> 'success',
    'title'=> 'updated'

  );
   redirect('staff/staff_list');

 }


 function remove($id)
 {
  // $member_id=$this->input->post('member_id');
  $condition=array('id'=>$id,'f_id'=>$this->session->f_id);
  $params=array('status'=>0);
  $this->Staff_model->update_col('table_staff',$condition,$params);

  // if($deleteInfo['status']=='success')
  // {
  //   echo "success";
  // }
  // else
  // {
  //   echo $deleteInfo['error'];
  // }


}
/*designation start*/
function designation()
{
 $f_id=$this->session->f_id;
 $condition=array('f_id'=>$f_id,'status'=>1);
 $data['designation']=$this->Staff_model->select('table_designation',$condition,array('id','name'));
 $data['_view'] = 'designation_view/designation';
 $this->load->view('index',$data);


}

function add_designation()
{

 $this->load->library('form_validation');

 $this->form_validation->set_rules('designation_name','Designation Name','required|trim|alpha_numeric_spaces');
 if($this->form_validation->run() )     
 {  
   $name = strip_tags($this->input->post('designation_name',1));

   $f_id=$this->session->f_id;

   $params=array(
    'name'=>$name,
    'created_at'=>date('Y-m-d'),
    'f_id'=>$f_id,


  );

   $designation_id=$this->Staff_model->insert('table_designation',$params);

   $this->session->alerts = array(
    'severity'=> 'success',
    'title'=> 'successfully added'

  );
   redirect('staff/designation');

 }
 else
 {
  $this->designation();
}


}

function designation_update($id)
{

 $data['title']="update designation";
 $f_id=$this->session->f_id;
 $params=array('id'=>$id,'f_id'=> $f_id);

    ##details of group 
 
 $data['designation']= $this->Staff_model->select_id('table_designation',$params,array('*'));
    // var_dump($data['customer']);die;
 if(isset($data['designation']['id']))
 {
  $this->load->library('form_validation');

 // var_dump($data['customer']);
  $this->form_validation->set_rules('designation_name','Name','required');
  if($this->form_validation->run() )     
  {   

    $name = strip_tags($this->input->post('designation_name',1));


    $updateVendorParams=array(
      'name' => $name,
    );

    $update=$this->Staff_model->update_col('table_designation',$params,$updateVendorParams);

    if($update)
    {

     $this->session->alerts = array(
      'severity'=> 'success',
      'title'=> 'succesfully updated'

    );
     redirect('staff/designation');
   }



   
 }
 else
 {
  $data['_view'] = 'designation_view/edit_designation';
  $this->load->view('index',$data);
}

}
else
  show_error('The id you are trying to edit does not exist.');

}

/*---/////designation end------///---*/


/*---department start--*/

function department()
{
 $f_id=$this->session->f_id;
 $condition=array('f_id'=>$f_id,'status'=>1);
 $data['department']=$this->Staff_model->select('table_department',$condition,array('id','name'));
 $data['_view'] = 'department_view/department';
 $this->load->view('index',$data);


}

function add_department()
{

 $this->load->library('form_validation');

 $this->form_validation->set_rules('department_name','department Name','required|trim|alpha_numeric_spaces');
 if($this->form_validation->run() )     
 {  
   $name = strip_tags($this->input->post('department_name',1));

   $f_id=$this->session->f_id;

   $params=array(
    'name'=>$name,
    'created_at'=>date('Y-m-d'),
    'f_id'=>$f_id,


  );

   $department_id=$this->Staff_model->insert('table_department',$params);
   
   $this->session->alerts = array(
    'severity'=> 'success',
    'title'=> 'successfully added'

  );
   redirect('staff/department');

 }
 else
 {
  $this->department();
}


}

function department_update($id)
{

 $data['title']="update department";
 $f_id=$this->session->f_id;
 $params=array('id'=>$id,'f_id'=> $f_id);

    ##details of group 
 
 $data['department']= $this->Staff_model->select_id('table_department',$params,array('id','name'));
    // var_dump($data['customer']);die;
 if(isset($data['department']['id']))
 {
  $this->load->library('form_validation');

 // var_dump($data['customer']);
  $this->form_validation->set_rules('department_name','Name','required');
  if($this->form_validation->run() )     
  {   

    $name = strip_tags($this->input->post('department_name',1));


    $updateVendorParams=array(
      'name' => $name,
    );

    $update=$this->Staff_model->update_col('table_department',$params,$updateVendorParams);

    if($update)
    {

     $this->session->alerts = array(
      'severity'=> 'success',
      'title'=> 'succesfully updated'

    );
     redirect('staff/department');
   }



   
 }
 else
 {
  $data['_view'] = 'department_view/edit_department';
  $this->load->view('index',$data);
}

}
else
  show_error('The id you are trying to edit does not exist.');

}







##fetch staff through designation id

function fetch_staff()
{
  $f_id=$this->session->f_id;
  $id=$this->input->post('designation_id',1);

  $condition=array('f_id'=>$f_id,'status'=>1,'department_id'=>$id);
  
  $staffData= $this->Staff_model->select('table_staff',$condition,array('id','name'));

  echo json_encode($staffData);


}


##attendance module start
function take_attendance()
{
  if($this->session->authorization_id == 2)
  {
   $f_id=$this->session->f_id;
   $condition=array('f_id'=>$f_id,'status'=>1);
   $data['department']=$this->Staff_model->select('table_department',$condition,array('id','name'));
   $data['_view'] = 'attendance/attendance_take';
   $this->load->view('index',$data);
 }
 else
 {

  show_error('You have not permitted to open this ');
}

}


function fetch_staff_for_attendance()
{
  $department_id=trim(strip_tags($this->input->post('department_id',1)));
  // $designation_id=trim(strip_tags($this->input->post('designation_id',1)));
  // $date=trim(strip_tags($this->input->post('date',1)));
  if($department_id=='all')
  {
    $condition=array(
    // 'department_id'=>$department_id,
     'f_id'=> $this->session->f_id
   ); 
  }
  else
  {
   $condition=array(
    'department_id'=>$department_id,
    'f_id'=> $this->session->f_id
  ); 
 }


 $data['staff']=$this->Staff_model->select('table_staff',$condition,array('id','name','employee_code','department_id'));
 echo json_encode($data['staff']); 


}


function insert_attendance()
{
  // echo '<pre>';
  // print_r($this->input->post());
  // die;
  $f_id=$this->session->f_id;
  $employee_id=$this->input->post('employee_id');//in form of array
  $department_id=$this->input->post('department_id',1);
  $date=$this->input->post('date_attendance',1);
  // echo $date;
  $date_array = explode('-', $date);
//   print_r($datess);
  $this->load->helper('user_helper');
  $date_format=date_change_view($date);
  $day = DateTime::createFromFormat("Y-m-d",$date_format);
  $day_no_count=$day->format("j");
// print_r($this->input->post());
  // print_r($day_no_count);die;
  for($i=0;$i<count($employee_id);$i++)
  {

    $condition=array(

      'year'=> $date_array[2],
      'month'=> $date_array[1],
      'f_id'=>$f_id,
      'staff_id' =>$employee_id[$i]
    );  
  ##check that is this month this year data exist or not return attendance id if exist
    $attendance_id=$this->Staff_model->select_id('table_staff_attendance',$condition,array('*'));

    // print_r($attendance_id);
    if($attendance_id)
    {

      // print_r($attendance_id['day'.$day_no_count.'']);
      if(!isset($attendance_id['day'.$day_no_count.'']))
      {
          //   echo 'i';
          // }
      ##skip if same attendance same day occure
      // $conditionCheckSame=array(
// print_r($attendance_id['day'.$day_no_count.'']);
      //   'year'=>$date_array[2],
      //   'month'=> $date_array[1],
      //   'f_id'=>$f_id,
      //   'staff_id' =>$employee_id[$i],
      //   'id'=>$attendance_id['id'],
      //   'day'.$day_no_count.''=> $this->input->post('attendance-'.$employee_id[$i])
      // );  
      // print_r($conditionCheckSame);
      // $check_id=$this->Staff_model->select_id('table_staff_attendance',$conditionCheckSame,array('id'));
      //---//
      // print_r($check_id);die;
      // if(!$check_id)
      // {
        $conditionAttendance=array(

          'year'=>$date_array[2],
          'month'=> $date_array[1],
          'f_id'=>$f_id,
          'staff_id' =>$employee_id[$i],
          'id'=>$attendance_id['id'],
          'department_id'=>$department_id[$i]
        );  
        $ParamAttendance=array(
         'day'.$day_no_count.''=> $this->input->post('attendance-'.$employee_id[$i])
       );
      // print_r($conditionAttendance);
        $this->Staff_model->update_col('table_staff_attendance',$conditionAttendance,$ParamAttendance);
      }

    }
    else
    {
// echo 'ee';
      $paramNew=array(
       'year'=>$date_array[2],
       'month'=> $date_array[1],
       'f_id'=>$f_id,
       'staff_id' =>$employee_id[$i],
       'department_id'=>$department_id[$i],
       'day'.$day_no_count.'' => $this->input->post('attendance-'.$employee_id[$i])

     );
      $insert_attendance=$this->Staff_model->insert('table_staff_attendance',$paramNew);
      // print_r($insert_attendance);

    }

  }
  // print_r($this->input->post());die;
  // $attendenceData = $this->input->post();

  $this->session->alerts = array(
    'severity'=> 'success',
    'title'=> 'succesfully attendance add'

  );
  redirect('staff/attendance_view');








}



function attendance_view()
{
 $f_id=$this->session->f_id;
 $conditionDepartment=array('f_id'=>$f_id,'status'=>1);
 $data['department']=$this->Staff_model->select('table_department',$conditionDepartment,array('id','name'));
 if($this->input->post())
 {
 // $staff_id=$this->input->post('employee_id',1);
   $department_id=$this->input->post('department',1);
   $year=$this->input->post('year',1);
   $month=$this->input->post('month',1);
   if($department_id=='all')
   {
     $condition=array(

      'year'=>$year,
      'month'=>$month,
      't1.f_id'=>$f_id,

  // 'department_id'=>$department_id
    );  
   }
   else
   {

    $condition=array(

      'year'=>$year,
      'month'=>$month,
      't1.f_id'=>$f_id,
      't1.department_id'=>$department_id
    );  
  }
  $data['attendance_report']=$this->Staff_model->fetch_attendance('table_staff_attendance',$condition,array('t1.*','t2.name','t2.employee_code'));
  $data['year']=$year;

 // $month_count = DateTime::createFromFormat("Y-m-d","2019-02-01");
  $month_count = DateTime::createFromFormat("Y-m-d","2019-".$month."-01");
  $data['month']=$month_count->format("F");
  $data['no_of_days']=cal_days_in_month(CAL_GREGORIAN,$month,$year);
   // echo $data['month'];die;
// echo '<pre>';
// print_r( $data['attendance_report']);
// die;


}
 // $year=2019;
 // $month=5;

$data['_view'] = 'attendance/attendance_view';
$this->load->view('index',$data);
}


function staff_view($id)
{
 $f_id=$this->session->f_id;
 $condition=array('t1.f_id'=>$f_id,'t1.status'=>1,'t1.id'=>$id);
 $data['staff_details']=$this->Staff_model->staff_detail('table_staff',$condition,array('t1.*','t2.name as designation','t3.name as department'));  
// echo '<pre>';
// $data['staff_approve_leave']=$this->Staff_model->staff_detail('table_staff',$condition,array('t1.*','t2.name as designation','t3.name as department'));


 $leaveCondition=array('leave_request.f_id'=>$f_id,'staff_id'=>$id);
 $this->load->model('leave/Leave_model');
 $this->load->model('payroll/Payroll_model');
 $data['leave_application']=$this->Leave_model->leaveApplicationList('table_leave_request',$leaveCondition,array('leave_category.category_name','leave_request.*'));

 $salaryCondition=array('t1.f_id'=>$f_id,'t1.employee_id'=>$id);  
 $data['salary']= $this->Payroll_model->fetchSalaryDetails('table_employee_salary_master',$salaryCondition,array('t1.id','t1.month','t1.year','t1.created_at','t1.gross_salary','t2.name'));
// print_r($data['staff_details']);die;
 $data['_view'] = 'staff_profile';
 $this->load->view('index',$data);


}

function my_attendance()
{
  $data['title']='My Attendance';
  $f_id=$this->session->f_id;
  $staff_id=$this->session->staff_id;
  $conditionDepartment=array('f_id'=>$f_id,'status'=>1);
  $data['department']=$this->Staff_model->select('table_department',$conditionDepartment,array('id','name'));
  if($this->input->post())
  {
 // $staff_id=$this->input->post('employee_id',1);
   $department_id=$this->input->post('department',1);
   $year=$this->input->post('year',1);
   $month=$this->input->post('month',1);

   $condition=array(

    'year'=>$year,
    'month'=>$month,
    't1.f_id'=>$f_id,
    'staff_id'=>$staff_id

  // 'department_id'=>$department_id
  );  


   $data['attendance_report']=$this->Staff_model->fetch_attendance('table_staff_attendance',$condition,array('t1.*','t2.name','t2.employee_code'));
   $data['year']=$year;

 // $month_count = DateTime::createFromFormat("Y-m-d","2019-02-01");
   $month_count = DateTime::createFromFormat("Y-m-d","2019-".$month."-01");
   $data['month']=$month_count->format("F");
   $data['no_of_days']=cal_days_in_month(CAL_GREGORIAN,$month,$year);
   // echo $d;die;
// echo '<pre>';
// print_r( $data['attendance_report']);
// die;


 }
 // $year=2019;
 // $month=5;

 $data['_view'] = 'attendance/my_attendance_view';
 $this->load->view('index',$data);
}


function my_salary_notification()
{

  $staff_id=$this->session->staff_id;
  $f_id=$this->session->f_id;
##fetch basic salary
  $basic_salary=$this->Staff_model->select_id('table_staff',array('id'=>$staff_id,'f_id'=>$f_id),array('basic_pay'));
// print_r($basic_salary);
  echo '<pre>';
##total absent this month
  $month=date('n');
  $year=date('Y');
  // echo $month;
  // echo $year; 
  $absentCondition=array('staff_id'=>8,'month'=>5,'year'=>$year,'f_id'=>$f_id);
  print_r($absentCondition);
  $result=$this->Staff_model->select_id('table_staff_attendance',$absentCondition,array('*'));
  print_r($result['day1']);
// for($i=1;$i<31;$i++)
// {



// }


}


/*all function end*/
}
?>	