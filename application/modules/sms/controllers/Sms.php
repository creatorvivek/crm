<?php


class Sms extends MY_Controller{
  function __construct()
  {
    parent::__construct();
    $this->load->model('Sms_model');
    
  } 


 function index()
 {

  if($this->input->get('mobile'))
  {
    $data['mobile']=$this->input->get('mobile');
  }
  else
  {
    $data['mobile']='';
  }
    $data['_view'] = 'sms_panel';
  $this->load->view('index',$data);


 }
 function send_sms()
 {
  $mobile=$this->input->post('mobile',1);
  $message=$this->input->post('message',1);
  $f_id=$this->session->f_id;
  $smsParams=array('mobile'=>$mobile,'message'=>$message,'f_id'=>$f_id);
  // $send_data=modules::run('api_call/api_call/call_api',''.api_url().'sms/sendSms',$smsParams,'POST');
  // var_dump($send_data);die;
  $send_data=$this->sendSms($mobile,$message);
  if($send_data)
  {

    $this->session->alerts = array(
      'severity'=> 'success',
      'title'=> 'message sent'

    );
    redirect('sms/index');

  }
  else{

    $this->session->alerts = array(
      'severity'=> 'danger',
      'title'=> 'message not sent'

    );
    redirect('sms/index');

  }
  

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
   
    $fetchtemplateSms=$this->Sms_model->select('table_sms_template',$templateParams,array('context'));

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
    $f_id=$this->session->f_id;
    $condition=array('f_id'=>$f_id);
    $getInfoSmsGateway=$this->Sms_model->select('table_sms_configuration',$condition,array('sender_id','auth_key','url','route'));
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
    $insertInfo=$this->Sms_model->insert('table_sms_log',$smslog);
    
    // echo json_encode($output);
  }

 
    function fetchTemplateSms_post()
    {
       $input=$this->post();
       echo $this->Sms_model->select('table_sms_template',$input,array('context'));

    }






}
?>