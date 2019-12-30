<?php


class Email extends MX_Controller{
  function __construct()
  {
    parent::__construct();
    $this->load->model('Email_model');
    
  } 


  

  function send_email($params)
  {


    $to=$params['email_address'];
    $subject=$params['subject'];
    $body=$params['body'];
    $f_id=$this->session->f_id;
    $condition=array('f_id'=>$f_id);
    $getInfoEmailGateway=$this->Email_model->select('table_email_configuration',$condition,array('protocol','smtp_host','smtp_port','smtp_user','smtp_password'));
    // $getInfoEmail=json_decode($getInfoEmailGateway,1);
    // var_dump($getInfoEmail);
    $config=array(
      'protocol'=>$getInfoEmailGateway[0]['protocol'],
      'smtp_host'=>$getInfoEmailGateway[0]['smtp_host'],
      'smtp_port'=>$getInfoEmailGateway[0]['smtp_port'],
      'smtp_user'=>$getInfoEmailGateway[0]['smtp_user'],
      'smtp_pass'=>$getInfoEmailGateway[0]['smtp_password']
    );
    $this->load->library('email',$config);
    $from_email = $getInfoEmailGateway[0]['smtp_host'];
//Load email library
    $this->email->from($from_email, 'Identification');
    $this->email->to($to);
    $this->email->subject($subject);
    $this->email->message($body);
//Send mail
    if($this->email->send())
    {
      $emaillog=array(
        'email'=>$to,
        'subject'=>$subject,
        'body'=>$body,
        'f_id'=>$f_id,
        'sender_id'=>$getInfoEmailGateway[0]['smtp_host']
      );
      $insertInfo=$this->Email_model->insert('table_outgoing_email_log',$emaillog);
      echo "send";
      log_message('warning', 'email is sent id '+$insertInfo+'');
#send log
    }
    else
      echo "not send";
  }

  function send_email_notification($params)
  {
    $email=$params['email'];
    $username=$params['username'];
    $password=$params['password'];
    $f_id=$params['f_id'];
    $module=$params['module'];
    $templateParams=array('module'=>$module,'f_id'=>$f_id);
    $url=base_url();
    $fetchtemplateEmail=$this->Email_model->select('table_email_template',$templateParams,array('context'));
    $context=$fetchtemplateEmail[0]['context'];
    $subject=$fetchtemplateEmail[0]['subject'];
    $contextString=array('{username','{password','{name','{url','}');
    $ReplaceString=array($username,$password,'',$url,'');
    $message=str_replace($contextString,$ReplaceString,$context);
    $emailParams=array('email_address'=>$mobile,'body'=>$message,'subject'=>$subject);
    $this->send_email($emailParams);

  }


  function test_email()
  {
    $email_address=$this->input->post('email');
    $params=array('email_address'=>$email_address,'subject'=>'test','body'=>'testing');
    $result=$this->send_email($params);
    if($result=='true')
    {
      redirect('email/email/configure');
    }
  }







}
?>