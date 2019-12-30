<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Super_admin extends Super_admin_controller
{

 function __construct()
 {
  parent::__construct();
  $this->load->model('Super_admin_model');
}



function dashboard()
{
  $data['_view'] = 'dashboard';
  $this->load->view('index',$data);

}
function dashboard_counting()
{
  // $f_id=$this->session->f_id;
  // $staff_id=$this->session->staff_id;
  // $group_id=$this->session->group_id;
  $data['total_seller']=$this->Super_admin_model->counting('table_seller');


  echo json_encode($data);
// die;
}

function list_seller()
{

 $seller_list=$this->Super_admin_model->seller_list('table_seller',NUll,array('seller.id','name','email','mobile','address','type','created_at','city','company_name'));
 // echo '<pre>';
 // var_dump($seller_list);die;

  $data['seller']=$seller_list;


   // var_dump($seller_list);
$data['_view'] = 'super_admin/seller_list';
$this->load->view('sindex',$data);

}

function seller_tree_view()
{

   $data['_view'] = 'seller_tree';
  $this->load->view('sindex',$data);
}

function add_seller()
{
    $data['_view'] = 'add_seller';
  $this->load->view('sindex',$data);
}
function add()
{
  
  $super_admin_id=$this->session->s_f_id;
    $name = strip_tags($this->input->post('name',1));
   
  $email = strip_tags($this->input->post('email',1));
  $mobile = strip_tags($this->input->post('mobile',1));
  // $groupId = $this->input->post('group');
  $address = strip_tags($this->input->post('address',1));
  $city = strip_tags($this->input->post('city',1));
  $type = strip_tags($this->input->post('type',1));
  $pincode = strip_tags($this->input->post('pincode',1));
  $gender = strip_tags($this->input->post('gender',1));
  $company_name = strip_tags($this->input->post('company_name',1));
        $this->load->library('form_validation');
  
  $this->form_validation->set_rules('name','Name','required|trim|alpha_numeric_spaces');
  $this->form_validation->set_rules('company_name','Company Name','required|trim');

  $this->form_validation->set_rules('email','Email','required|valid_email|trim');
  $this->form_validation->set_rules('address','Address','required|trim');
  $this->form_validation->set_rules('city','City','required|trim|alpha');
  $this->form_validation->set_rules('pincode','Pincode','required|trim|numeric');
  $this->form_validation->set_rules('gender','Gender','required');
  $this->form_validation->set_rules('type','Type','required');

  $this->form_validation->set_rules('mobile','Mobile number','required|exact_length[10]|numeric');
  if($this->form_validation->run() )     
  {  
  $params=array(
    'name'=>$name,
    'email'=>$email,
    'mobile'=>$mobile,
    'type'=>$type,
    'address'=>$address,
    'city'=>$city,
    'pincode'=>$pincode,
    'created_at'=>date('Y-m-d H:i:s')

  );
// print_r($params);
$seller_id=$this->Super_admin_model->insert('table_seller',$params);
    // $seller_id=$addseller;
##adding in staff list
  $staffParams=array(
    'name'=>$name,
    'email'=>$email,
    'mobile'=>$mobile,
    'created_at'=>date('Y-m-d H:i:s'),
    'f_id'=>$seller_id,
    'gender'=>$gender

  );
// print_r($staffParams);
  $staff_id=$this->Super_admin_model->insert('table_staff',$staffParams);
  $menu='{"dashboard":"dashboard","staff":"employee","ticket":"ticket","account":"account","customer":"customer"}';
    $sellerSetting=array(
      'f_id'=>$seller_id,
      'company_name'=>$company_name,
      'menu'=>$menu,
      'tax'=>'[]'


 );


  
 $seller=$this->Super_admin_model->insert('table_seller_setting',$sellerSetting);
    #generate username and password
     $password= $seller_id.rand(1,100).rand(1,9000);
    $encrypted_password=md5($password);
    $username= $seller_id.'_'.time();
  ##add credential of seller
    $f_credential=array(

      'username'=>$username,
      'password'=>$encrypted_password,
      'clear_text'=>$password,
      // 'crn_number'=>$crn_number,
      'f_id'=>$seller_id,
      'staff_id'=>$staff_id,
      'authorization_id'=>2,
      'type'=>$type
      // 'api_key'=>123


    );
     $login_credential=$this->Super_admin_model->insert('table_login',$f_credential);

     ##insert sms gateway and template
     $smsGatewayParams=array(
     'f_id'=>$seller_id
    ); 
     $sms_credential=$this->Super_admin_model->insert('table_sms_configuration',$smsGatewayParams);
      /*---------*/
      ##insert sms template
      $context[0]='Dear {name} your ticket id {ticket_id} is generated.';
      $context[1]='Your Username is    {username} and Password is   {password} to login the panel click in this url {url}.';
      $module[0]='ticket';
      $module[1]='user credential';
      for ($i=0; $i < 2 ; $i++) { 
      $smsTemplate=array(
        'f_id'=>$seller_id,
        'context'=>$context[$i],
        'module'=>$module[$i]


      );
      $sms_credential=$this->Super_admin_model->insert('table_sms_template',$smsTemplate);


      }
      ##insert email template and configuration
      $emailGatewayParams=array(
     'f_id'=>$seller_id
      ); 
     $email_credential=$this->Super_admin_model->insert('table_email_configuration',$emailGatewayParams);

      $context[0]='dear {name} your ticket id {ticket_id} is generated.';
      $context[1]='Your Username is    {username} and Password is   {password} to login the panel click in this url {url}.';
      $module[0]='ticket';
      $module[1]='user credential';
      for ($j=0; $j < 2 ; $j++) { 
      $emailTemplate=array(
        'f_id'=>$seller_id,
        'context'=>$context[$j],
        'module'=>$module[$j],
        'subject'=>$module[$j],
        'date'=>date('Y-m-d H-i-s')


      );
      $email_credential=$this->Super_admin_model->insert('table_email_template',$emailTemplate);


      }
    ##send sms to seller
    $smsParam=array(
      'mobile'=>$mobile,
      'username'=>$username,
      'password'=>$password,
      'f_id'=>$super_admin_id,
      'module'=>'user credential',
    );
    // $sms=modules::run('sms/sms/send_sms_notification',$smsParam);
    $this->send_sms_notification($smsParam);
    ##send email to seller
     $emailParam=array(
      'email'=>$email,
      'username'=>$username,
      'password'=>$password,
      'f_id'=>$super_admin_id,
      'module'=>'user credential',
    );
   
    
    $this->session->alerts = array(
      'severity'=> 'success',
      'title'=> 'successfully added'
    );
    
    redirect('super_admin/list_seller');
// $addStaff=$this->Staff_model->insert('table_staff',$params);

}

else
{
   
   $data['_view'] = 'add_seller';

  $this->load->view('index.php',$data);
}

}
function edit($id)
{ 
  $data['title']="Edit Seller details";
  $params=array('seller.id'=>$id);

    ##details of group 
 
 $data['seller']= $this->Super_admin_model->seller_list('table_seller',$params,array('seller.id','name','email','pincode','mobile','address','type','created_at','city','company_name'));
 ##fetch staff details by seller id
$staffIdCondition=array('user_authentication.f_id'=>$id,'authorization_id'=>2);
$data['staff']=$this->Super_admin_model->select_staff('table_login',$staffIdCondition,array('staff_id','staff.gender'));


    // var_dump($data['seller']);die;
  if(isset($data['seller'][0]['id']))
  {
    $this->load->library('form_validation');

 // var_dump($data['customer']);
    
     $this->form_validation->set_rules('name','Name','required|trim|alpha_numeric_spaces');
     $this->form_validation->set_rules('company_name','Company Name','required|trim');

  $this->form_validation->set_rules('email','Email','required|valid_email|trim');
  $this->form_validation->set_rules('address','Address','required|trim');
  $this->form_validation->set_rules('city','City','required|trim|alpha');
  $this->form_validation->set_rules('pincode','Pincode','required|trim|numeric');
  $this->form_validation->set_rules('gender','Gender','required');
  $this->form_validation->set_rules('type','Type','required');

  $this->form_validation->set_rules('mobile','Mobile number','required|exact_length[10]|numeric');
    if($this->form_validation->run() )     
    {   
      $f_id=$this->session->s_f_id;
      $name = strip_tags($this->input->post('name',1));
      
            // 'username'=>$this->input->post('username'),
      $email = strip_tags($this->input->post('email',1));
      $mobile = strip_tags($this->input->post('mobile',1));
      $city = strip_tags($this->input->post('city',1));
      $gender = strip_tags($this->input->post('gender',1));

      $location = strip_tags($this->input->post('address',1));
      $pincode = strip_tags($this->input->post('pincode',1));
      $type = strip_tags($this->input->post('type',1));
      $company_name = strip_tags($this->input->post('company_name',1));
    
      $updateParams=array(
      
        'name' => $name,
     
        'email' =>$email,
        'mobile' => $mobile,
        'address' => $location,
        'pincode'=>$pincode,
        'type'=>$type,
        // 'f_id'=>$f_id,
        'city'=>$city
        
      );
       $updateSettingParam=array('company_name'=>$company_name);
       $settingcondition=array('f_id'=>$id);
      $update=$this->Super_admin_model->update_col('table_seller',$params,$updateParams);

       $staffParams=array(
  
  'name'=>$name,
  'email'=>$email,
  'mobile'=>$mobile,
  'gender'=>$gender
    // 'created_at'=>date('Y-m-d H:i:s'),
    // 'f_id'=>$f_id

);
 $staffCondition=array('id'=>$data['staff'][0]['staff_id']);
      $updateStaff=$this->Super_admin_model->update_col('table_staff',$staffCondition,$staffParams);
      $updateSetting=$this->Super_admin_model->update_col('table_seller_setting',$settingcondition,$updateSettingParam);
     if($update=='success' || $updateSetting=='success' || $updateStaff=='success')
     {
     
     $this->session->alerts = array(
      'severity'=> 'success',
      'title'=> 'succesfully updated'

    );
     redirect('super_admin/list_seller');
   }
   else
   {
     $this->session->alerts = array(
      'severity'=> 'danger',
      'title'=> 'not updated'

    );
      redirect('super_admin/list_seller');
   }



   
 }
   else
   {
    $data['_view'] = 'seller_edit';
    $this->load->view('index',$data);
  }
 
}
else
  show_error('The id you are trying to edit does not exist.');
} 
function send_sms_notification($params)
{


$mobile=$params['mobile'];
$username=$params['username'];
$module=$params['module'];
$name='';
$password=$params['password'];
$f_id=$params['f_id'];
$url=base_url();
 $templateParams=array('module'=>$module,'f_id'=>$f_id);
   
    $fetchtemplateSms=$this->Super_admin_model->select('table_sms_template',$templateParams,array('context'));

    $context=$fetchtemplateSms[0]['context'];
    $contextString=array('{username','{password','{name','{url','}');
    $ReplaceString=array($username,$password,$name,$url,'');
    $message=str_replace($contextString,$ReplaceString,$context);
    $smsParams=array('f_id'=>$f_id,'mobile'=>$mobile,'message'=>$message);
    $this->sendSms($mobile,$message);

}



function sendSms($mobile,$message)
  {
##get authentication key and information for sms gateway
   // $input=$this->post();
   // $message=$input['message'];
   // $to=$input['mobile'];
   // $f_id=$input['f_id'];
   // $condition=array('f_id'=>$f_id);
    $f_id=$this->session->s_f_id;
    $condition=array('f_id'=>$f_id);
    $getInfoSmsGateway=$this->Super_admin_model->select('table_sms_configuration',$condition,array('sender_id','auth_key','url','route'));
    // $infoSmsGateway=json_decode($getInfoSmsGateway,1);
    // print_r($getInfoSmsGateway);
    // die;
    $senderId = $getInfoSmsGateway[0]['sender_id'];
    $authKey = $getInfoSmsGateway[0]['auth_key'];
    $url  =  $getInfoSmsGateway[0]['url'];


    $route = $getInfoSmsGateway[0]['route'];
    $postData = array(
      'authkey' => $authKey,
      'mobiles' => $mobile,
      'message' => $message,
      'sender' => $senderId,
      'route' => $route
    );
    // print_r($postData);
    $ch = curl_init();
    curl_setopt_array($ch, array(
      CURLOPT_URL => $url,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_POST => true,
      CURLOPT_POSTFIELDS => $postData
//,CURLOPT_FOLLOWLOCATION => true
    ));
    $output = curl_exec($ch);
    // print_r($output);die;
       log_message('debug', 'sms is sent id');
    curl_close($ch);
    $smslog=array(
      'mobile'=>$mobile,
      'message'=>$message,
      'sender'=>$senderId,
      'f_id'=>$f_id,
     
      'created_at'=>date('Y-m-d H-i-s')

    );
    $insertInfo=$this->Super_admin_model->insert('table_sms_log',$smslog);
    
    // echo json_encode($output);
  }
function test()
{
   
  $this->output->enable_profiler(TRUE);
}
function logout()
{

  $this->session->unset_userdata('s_f_id');
  // $this->session->unset_userdata('s_u_id');
 
  // $this->session->unset_userdata('s_authorization_id');
  // $this->session->unset_userdata('group_id');

  $this->session->sess_destroy();
  redirect('login');
}
}
?>	