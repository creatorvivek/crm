<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MX_Controller
{

	function __construct()
	{
		parent::__construct();
    $this->load->model('Login_model');


  }

  public function index()
  {
// Load our view to be displayed
    #check if session exist
    if(isset($this->session->user_id))
    {

      redirect ('home/dashboard');
    }
    else
    {
      $data['title']="login";

      $this->load->view('sign-in');
    }
  }


  public function process()
  {


   $username = $this->security->xss_clean($this->input->post('username'));
   $password = $this->security->xss_clean(md5($this->input->post('password')));

// echo $password;
   $authenticationData = $this->Login_model->getResult($username,$password);
   $ipaddress=$this->input->ip_address();
   $logsData=array(
    'username'=>($authenticationData['username'])?$authenticationData['username']:$username,
    'ip_address'=>$ipaddress,
    'f_id'=>isset($authenticationData['f_id'])?$authenticationData['f_id']:'',
    'status'=>($authenticationData)?1:0
  );
   $log=$this->Login_model->insertLogs($logsData);


       // var_dump($authenticationData);
##--##
   if (is_null($authenticationData)) {
    $data = array(
      'error_message' => 'Invalid Username or Password'
    );
    $this->load->view('sign-in', $data);
  }else{
             // $authorization_id=$authenticationData['authorization_id'];

    $sellerCondition=array('user_authentication.id'=>$authenticationData['id']);
    $sellerData=$this->Login_model->fetchSellerInfo('table_login',$sellerCondition,array('name','email','mobile','invoice_template','reciept_template','tax','company_name','profile_image','panel_color','menu','auto_logout','auto_logout_time','dashboard_setting'));
          // print_r($sellerData);die;
#set session data


// $this->session->name = '';
 #default value
// $this->session->profileImage = '';
 #default value
    $userData = '';
    switch ($authenticationData['authorization_id']){
      case 1:
#got for admin user at employ table & check for authentication ID and get school id
    // $userData = $this->Login_model->getEmployDetails($authenticationData['user_id']);
    // $this->session->SchoolId = $userData['school_id'];
// $this->session->organizationName = $userData['organization_name'];
    // $school_name= modules::run('admin/admin/getSchoolName',$this->session->SchoolId);
    // $this->session->SchoolName =$school_name['organization_name'];
    // $this->session->name = $userData['name'];
    // $this->session->profileImage = $userData['profile_image'];
    // $this->session->authenticationId=$authenticationData['autorization_id'];
    // echo "admin  ". $this->session->username;
 // $this->session->s_user_id = $authenticationData['id'];
      $this->session->s_f_id= $authenticationData['f_id'];
            // $this->session->s_username = $authenticationData['username']; 
            // $this->session->s_type = $authenticationData['type']; 
            // $this->session->auto_logout = $authenticationData['auto_logout_status']; 
            // $this->session->s_authorization_id = $authenticationData['authorization_id'];
      redirect ('super_admin/dashboard');
      break;
    ##for admin 
      case 2:


    // redirect ('home/dashboard');
    // break;
      case 3:
      $this->session->user_id = $authenticationData['id'];
      $this->session->username = $authenticationData['username']; 
      $this->session->type = $authenticationData['type']; 
            // $this->session->auto_logout = $authenticationData['auto_logout_status']; 
      $this->session->authorization_id = $authenticationData['authorization_id'];
      $this->session->staff_id = $authenticationData['staff_id'];
      $this->session->f_id= $authenticationData['f_id'];
      $this->session->company_name= $sellerData['company_name'];
      $this->session->profile_image= $sellerData['profile_image'];
      $this->session->name= $sellerData['name'];
      $this->session->panel_color= $sellerData['panel_color'];
      $this->session->auto_logout= $sellerData['auto_logout'];
      $this->session->auto_logout_time= $sellerData['auto_logout_time'];
      $this->session->log_id=$log;


            #for menu and submenu
      if($sellerData['menu'])
      {
        $decodedData=json_decode($sellerData['menu'],1);
        $this->session->menu_dashboard=$decodedData['dashboard'];
        $this->session->menu_staff=$decodedData['staff'];
        $this->session->menu_account=$decodedData['account'];
        $this->session->menu_ticket=$decodedData['ticket'];
        $this->session->menu_customer=$decodedData['customer'];
              // $this->session->menu_customer=$decodedData['customer'];
      }
      $this->session->sales_graph=1;
      $this->session->ticket_graph=0;
      $this->session->payment_graph=1;
      redirect ('home/dashboard');
      break;


    }
#redirect it to $autorizationData['home']
// echo 'redirect it to '. $autorizationData['home'];
// $this->output->enable_profiler(TRUE);
// echo $_SESSION['username'];
  }


// die;

  //    switch($get_data['data'][0]['authorization_id'])
  //    {
  //               ##admin
  //     case 0;
  //     redirect('super_admin/dashboard');
  //     break;
  //     case 1:
  //     $staff_id=$this->session->staff_id=$get_data['data'][0]['staff_id'];
  //      $params=array('member_id'=>$staff_id);
  //      ##if admin belong to any group so this function create session of group
  //     $groupInfo = modules::run('api_call/api_call/call_api',''.api_url().'group/myGroup',$params,'POST');
  //     try{
  //       if($groupInfo=='')
  //       {
  //         throw new Exception("server down", 1);

  //       }
  //     }
  //     catch(Exception $e)
  //     {
  //      die(show_error($e->getMessage()));
  //    }
  //    if($groupInfo['status']=='success')
  //    {
  //     $group_id=$this->session->group_id=$groupInfo['data'][0]['group_id'];
  //   }

  //   redirect('admin/dashboard');
  //   break;
  //               ##staff
  //   case 2:
  //   $staff_id=$this->session->staff_id=$get_data['data'][0]['staff_id'];
  //   $params=array('member_id'=>$staff_id);
  //   $groupInfo = modules::run('api_call/api_call/call_api',''.api_url().'group/myGroup',$params,'POST');
  //   if($groupInfo['status']=='success')
  //   {
  //     $group_id=$this->session->group_id=$groupInfo['data'][0]['group_id'];
  //   }

  //   redirect('admin/dashboard');
  //   break;

  //   case 3:


  //   redirect('profile/dashboard');
  //   break;



  // }	
}
function forgot_password()
{

 $this->load->view('forgot-password');                   


} 

function forgot_password_process()
{
  
    $username=$this->input->post('username');
    $result=$this->Login_model->fetchEmail('table_login',array('username'=>$username),array('email','clear_text'));
    // $que=$this->db->query("select pass,email from user_login where email='$email'");
    // $row=$que->row();
    // $user_email=$row->email;
    // print_r($result);die;
    if($result){
      $pass=$result['clear_text'];
      /*Mail Code*/
      $to = $result['email'];
      $subject = "Password";
      $txt = "Your password is $pass .";
      $headers = "From: password@example.com" . "\r\n" .
      "CC: ifany@example.com";

      mail($to,$subject,$txt,$headers);
      
    }
    else{
      $data['error']="Invalid Email ID !";
  $this->load->view('forgot_password',@$data); 
    }
    
  
}



public function logout(){
 $log_id=$this->session->log_id;
 echo  $log_id;
 $logout_time=date("Y-m-d H:i:s");
 echo $this->Login_model->set_logout_time($log_id,$logout_time);

 $this->session->unset_userdata('username');
 $this->session->unset_userdata('user_id');
  // $this->session->unset_userdata('api_key');
 $this->session->unset_userdata('staff_id');
 $this->session->unset_userdata('f_id');
 $this->session->unset_userdata('authorization_id');
 $this->session->unset_userdata('group_id');

 $this->session->sess_destroy();
 redirect('login');
}       






}

// }
?>