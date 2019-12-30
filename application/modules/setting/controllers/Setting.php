<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Setting extends MY_Controller
{

 function __construct()
 {
  parent::__construct();
  $this->load->model('Setting_model');
}





function index()
{
  $condition=array('f_id'=>$this->session->f_id);
  $data['seller_data']=$this->Setting_model->select('table_seller_setting',$condition,array('tax','auto_logout','auto_logout_time','panel_color'));
  $data['tax']=json_decode($data['seller_data'][0]['tax'],1);
  // print_r($data['tax']);die;
$data['_view'] = 'general';
  $this->load->view('index',$data);
}



function initial_setting()
{

  $data['_view'] = 'initial_setting';
  $this->load->view('index',$data);
}


function sms_configure()
{
  $f_id=$this->session->f_id;
  $condition=array('f_id'=>$f_id);
  $data['sms']=$this->Setting_model->select('table_sms_configuration',$condition,array('id','auth_key','url','sender_id','route'));
  // print_r($data['sms']);die;
   $data['_view'] = 'sms_setting';
  $this->load->view('index',$data);
}

function update_sms_configuration($id)
{
  $data['title']="Sms configuration Update";
 $data['heading']="SMS CONFIGURATION";
 $f_id=$this->session->f_id;
 // $f_id=$this->input->post('f_id');
 $condition=array('id'=>$id,'f_id'=>$f_id);

 $data['sms'] = $this->Setting_model->select('table_sms_configuration',$condition,array('id','auth_key','url','sender_id','route'));
 
 


 if(isset($data['sms'][0]['id']))
 {
  $this->load->library('form_validation');

    $this->form_validation->set_rules('auth_key','Auth key','required');
    // $this->form_validation->set_rules('email','Email','max_length[50]|valid_email');

    // $this->form_validation->set_rules('paddress','Permanent Address','required');
    // $this->form_validation->set_rules('taddress','Temporary Address','required');

  if($this->form_validation->run() )     
  {   

   

   $auth_key=strip_tags($this->input->post('auth_key',1));
   $url=strip_tags($this->input->post('url',1));
  

   $sender_id=strip_tags($this->input->post('sender_id',1));
   $route=strip_tags($this->input->post('route',1));
  
   $itemParams=array(
    'auth_key'=>$auth_key,
    'url'=>$url,
    'route'=>$route,

    'sender_id'=>$sender_id
   

  );
// var_dump($params);die;

   $this->Setting_model->update($condition,'table_sms_configuration',$itemParams);      



   $this->session->alerts = array(
    'severity'=> 'success',
    'title'=> 'successfully updated'
  );
   redirect('setting/sms_setting');
 }
 else
 {
  $data['_view'] = 'sms_setting';
  $this->load->view('index',$data);
}
}
else
  show_error('The item you are trying to edit does not exist.');
} 

function sms_templates()
{
  $f_id=$this->session->f_id;
  $condition=array('f_id'=>$f_id);
    $data['template']=$this->Setting_model->select('table_sms_template',$condition,array('id','f_id','context','module')); 
    // print_r($data['template']);
 $data['_view'] = 'sms_template';
  $this->load->view('index',$data);
}

function sms_template_update()
{
 $data['title']="Sms templates";
 $data['heading']="SMS TEMPLATES";
 $f_id=$this->session->f_id;

 
 $context=$this->input->post('context');
 $id=$this->input->post('id');

  $length=count($context);
   // print_r($context);die;
  for($i=0;$i<$length;$i++)
  {
   $params=array(
    'context'=>$context[$i]
   );
    $condition=array('f_id'=>$f_id,'id'=>$id[$i]);


    $this->Setting_model->update_col('table_sms_template',$condition,$params);      

 }
// var_dump($params);die;




   $this->session->alerts = array(
    'severity'=> 'success',
    'title'=> 'successfully updated'
  );
   redirect('setting/sms_templates');

}

function color_setting()
{
   $data['_view'] = 'color_setting';
  $this->load->view('index',$data);
}
function email_configure()
{
  $f_id=$this->session->f_id;
  $condition=array('f_id'=>$f_id);
  $data['email']=$this->Setting_model->select('table_email_configuration',$condition,array('id','smtp_password','smtp_host','smtp_port','smtp_user','protocol'));
   $data['_view'] = 'email_setting';
  $this->load->view('index',$data);
}

function email_configuration_update($id)
{

  $data['title']="Email configuration Update";
  $data['heading']="EMAIL CONFIGURATION";
 $f_id=$this->session->f_id;
 
    $condition=array('f_id'=>$f_id,'id'=>$id);
  $this->load->library('form_validation');
    $this->form_validation->set_rules('protocol','Protocol','required');
    // $this->form_validation->set_rules('email','Email','max_length[50]|valid_email');

    // $this->form_validation->set_rules('paddress','Permanent Address','required');
    // $this->form_validation->set_rules('taddress','Temporary Address','required');

  if($this->form_validation->run() )     
  {   

   

   $protocol=strip_tags($this->input->post('protocol',1));
   $smtp_user=strip_tags($this->input->post('smtp_user',1));
   $smtp_host=strip_tags($this->input->post('smtp_host',1));
   $smtp_port=strip_tags($this->input->post('smtp_port',1));
   $smtp_password=strip_tags($this->input->post('smtp_password',1));
  

 
  
   $itemParams=array(
    'protocol'=>$protocol,
    'smtp_user'=>$smtp_user,
    'smtp_host'=>$smtp_host,
    'smtp_port'=>$smtp_port,
    'smtp_password'=>$smtp_password

    
   

  );
// var_dump($params);die;

   $this->Setting_model->update($condition,'table_email_configuration',$itemParams);      



   $this->session->alerts = array(
    'severity'=> 'success',
    'title'=> 'successfully updated'
  );
   redirect('setting/email_configure');
 }
 


}
function email_template()
{
  $data['_view'] = 'email_template';
  $f_id=$this->session->f_id;
   $condition=array('f_id'=>$f_id);
    $data['template']=$this->Setting_model->select('table_email_template',$condition,array('id','f_id','context','module','subject')); 
  $this->load->view('index',$data);
}
function email_template_update()
{
 $data['title']="Email templates";
 $data['heading']="Email TEMPLATES";
 $f_id=$this->session->f_id;
 // $f_id=$this->input->post('f_id');
// print_r($this->input->post());die;
 // $data['sms'] = $this->Setting_model->select('table_sms_configuration',$condition,array('id','auth_key','url','sender_id','route'));
 
 $context=$this->input->post('body');
 $subject=$this->input->post('subject');
 $id=$this->input->post('id');

  $length=count($context);
   // print_r($context);die;
  for($i=0;$i<$length;$i++)
  {
   $params=array(
    'context'=>$context[$i],
    'subject'=>$subject[$i]
   );
    $condition=array('f_id'=>$f_id,'id'=>$id[$i]);


    $this->Setting_model->update_col('table_email_template',$condition,$params);      

 }
// var_dump($params);die;




   $this->session->alerts = array(
    'severity'=> 'success',
    'title'=> 'successfully updated'
  );
   redirect('setting/email_template');

}

function menu_setting()
{
  $f_id=$this->session->f_id;
  $condition=array('f_id'=>$f_id);
  $data=$this->Setting_model->select('table_seller_setting',$condition,array('id','menu')); 
  if(isset($data[0]))
  {
  $data['menu']=json_decode($data[0]['menu'],1);
  $data['id']=$data[0]['menu'];
  }

  $data['_view'] = 'menu';
  $this->load->view('index',$data);
}

function general_setting()
{

  $condition=array('f_id'=>$this->session->f_id);
  $data['seller_data']=$this->Setting_model->select('table_seller_setting',$condition,array('tax','auto_logout','auto_logout_time','panel_color','invoice_due_day','logo'));
  $data['tax']=json_decode($data['seller_data'][0]['tax'],1);
  // print_r($data['tax']);die;
$data['_view'] = 'general';
  $this->load->view('index',$data);

}
function tax_update()
{
  // print_r($this->input->post());
  $f_id=$this->session->f_id;
  $tax_name = $this->input->post('tax_name');
  $tax_percent = $this->input->post('tax_percent');
 $name_array=explode(",",$tax_name);
  $percent_array=explode(",",$tax_percent);
$length=count($name_array);
 $fullTaxArray=[];
  for ($i=0; $i <$length ; $i++) { 
  # code...
    $taxArray = array($name_array[$i] => $percent_array[$i] );
    array_push($fullTaxArray, $taxArray);
  }

  $tax=json_encode($fullTaxArray);
// var_dump($tax);

  $taxParams=array(
  
    'tax'=>$tax

  );
  $condition=array( 'f_id'=>$f_id);
$result=$this->Setting_model->update_col('table_seller_setting',$condition,$taxParams);
if($result=='success')
{
$this->session->alerts = array(
    'severity'=> 'success',
    'title'=> 'successfully updated'
  );
}
else
{
   $this->session->alerts = array(
    'severity'=> 'danger',
    'title'=> 'not updated'
  );
}
redirect('setting/general_setting');
// print_r($result);
  // $insert_tax=modules::run('api_call/api_call/call_api',''.api_url().'frenchise/addFrenchiseTax',$taxParams,'POST');

}
function general_setting_update()
{
$f_id=$this->session->f_id;
  // $auto_logout=$this->input->post('auto_logout',1);
  // $auto_logout_time=$this->input->post('auto_logout_time',1);
  $color=$this->input->post('color',1);
    $condition=array('f_id'=>$f_id);
  $params=array(
    // 'auto_logout'=>$auto_logout,
    // 'auto_logout_time'=>$auto_logout_time,
    'panel_color'=>$color

);
  // print_r($params);die;
  $result=$this->Setting_model->update_col('table_seller_setting',$condition,$params);

  if ($result=='success') {
    # code...
  $this->session->alerts = array(
    'severity'=> 'success',
    'title'=> 'successfully updated apply after next login'
  );
}
else
{
   $this->session->alerts = array(
    'severity'=> 'danger',
    'title'=> 'Not Updated'
  );
}
  redirect('setting/general_setting');
}
function update_menu_name()
{
  $condition=array('f_id'=>$this->session->f_id);
 $dashboard=strip_tags($this->input->post('dashboard',1));
 $ticket=strip_tags($this->input->post('ticket',1));  
 $account=strip_tags($this->input->post('account',1));  
 $staff=strip_tags($this->input->post('staff',1));
 $customer=strip_tags($this->input->post('customer',1));
 $params=array('dashboard'=>$dashboard,'staff'=>$staff,'ticket'=>$ticket,'account'=>$account,'customer'=>$customer);
 $encoded_data=json_encode($params);
 $colParams=array('menu'=>$encoded_data);

 $this->Setting_model->update_col('table_seller_setting',$condition,$colParams);
   $this->session->alerts = array(
    'severity'=> 'success',
    'title'=> 'successfully updated apply after next login'
  );
   redirect('setting/menu_setting');

}
function test()
{

  $data='[{"dashboard":"dashboard","staff":"staff"}]';
  $decode=(json_decode($data,1));
  print_r($decode[0]['dashboard']);
}
function target_setting()
{
    $f_id=$this->session->f_id;
  $data['sales_count']=[];
  $condition=array('f_id'=>$f_id);
  $data['target']= $this->Setting_model->select('table_target_sales',$condition,array('start_date','end_date','target'));
  for($i=0;$i<count($data['target']);$i++)
  {
  $sales=$this->Setting_model->sum_column('table_sales',$condition,'total', $data['target'][$i]['start_date'],$data['target'][$i]['end_date'] );
  array_push($data['sales_count'],$sales);
  }
  $data['_view'] = 'target_setting';
  $this->load->view('index',$data);

}
function target_setting_update()
{
  $f_id=$this->session->f_id;
  $condition=array('f_id'=>$f_id);
  $duration= $this->input->post('duration',1);
  $result=$this->Setting_model->select('table_target_sales',$condition,array('start_date','end_date','target'));
  if($duration==1)
  {
    $start_date=date('Y-04-01');
    // $end_date=date('Y+1-3-31');
    $end_date = date('Y-03-31 23:59:59', strtotime('+1 years'));

  } 
  if($duration==2)
  {
     $start_date=date('Y-m-01');
    // $end_date=date('Y+1-3-31');
    $end_date = date('Y-m-t', strtotime($start_date));
  }
  // date('Y-m-d', strtotime($result[$i]['start_date']))
  // echo date('Y-m-d', strtotime($result[0]['start_date']));
  // echo '<br>';
  // echo $start_date;

  for($i=0;$i<count($result);$i++)
  {
    // echo  date('Y-m-d', strtotime($result[$i]['start_date']));
    // echo '<br>';
    // || date('Y-m-d', strtotime($result[$i]['end_date']))==date('Y-m-d', strtotime($end_date))
  if(date('Y-m-d', strtotime($result[$i]['start_date']))==$start_date || date('Y-m-d', strtotime($result[$i]['end_date']))==date('Y-m-d', strtotime($end_date) ))
  {
    echo "i";
  }
  else
  {
  $target=  $this->input->post('target'); 
  $params=array('target'=>$target,'start_date'=>$start_date,'end_date'=>$end_date,'f_id'=>$f_id);
  $result=$this->Setting_model->insert('table_target_sales',$params);

  redirect('setting/target_setting');
    
  }
}

}

function dashboard_setting()
{
  $f_id=$this->session->f_id;
$sales= $this->input->post('sales',1);
$payment= $this->input->post('payment',1);
$ticket= $this->input->post('ticket',1);

$params=array(

  'sales_graph'=>$sales,
  'purchase_graph'=>$payment,
  'ticket_graph'=>$ticket

);
$condition=array('f_id'=>$f_id);

$encoded_params=json_encode($params);
$paramsDashboard=array('dashboard_setting'=>$encoded_params);
 $result=$this->Setting_model->update_col('table_seller_setting',$condition,$paramsDashboard);
 if($result=='success')
 {
  $this->session->alerts = array(
    'severity'=> 'success',
    'title'=> 'successfully updated apply after next login'
  );
 redirect('setting/general_setting');
}


}

function invoice_due_notification()
{
## fetch invoice of particular duration according to setting
   $f_id=$this->session->f_id;
   $data['invoice']=[];
   $today_date=date_create(date('Y-m-d'));
  $condition=array('f_id'=>$f_id);
  ##fetch seller invoice due day
  $invoice_due_day=$this->Setting_model->select('table_seller_setting',$condition,array('invoice_due_day'));
  // print_r($invoice_due_day);die;
  for($i=0;$i<count($result);$i++)
  $result=$this->Setting_model->select('table_invoices',$condition,array('*'));
  for($i=0;$i<count($result);$i++)
  {
    $date1=date_create($result[$i]['created_at']);
    $diff=date_diff($date1,$today_date);
    $difference=$diff->format("%a");
    // echo $difference;
        if($difference>$invoice_due_day)
        {
                array_push($data['invoice'],$result[$i]);
        }
  }
  // echo '<pre>';
// print_r($invoice);
 $data['_view'] = 'invoice_due_list';

  $this->load->view('index.php',$data);


}

function invoice_setting_update()
{
  $due_day=$this->input->post('due_day');
  $f_id=$this->session->f_id;
$condition=array('f_id'=>$f_id);
$params=array('invoice_due_day'=>$due_day);
   $result=$this->Setting_model->update_col('table_seller_setting',$condition,$params);
   if($result=='success')
 {
  $this->session->alerts = array(
    'severity'=> 'success',
    'title'=> 'successfully updated apply after next login'
  );
}
else
{
  $this->session->alerts = array(
    'severity'=> 'success',
    'title'=> 'not updated'
  );
}

 redirect('setting/general_setting');

}
function logo_upload()
{
if(isset($_FILES["image_file"]["name"]))  
           {  
                $config['upload_path'] = './uploads/';  
                $config['allowed_types'] = 'jpg|jpeg|png';  
                $this->load->library('upload', $config);  
                if(!$this->upload->do_upload('image_file'))  
                {  
                     echo $this->upload->display_errors();  
                }  
                else  
                {  
                     $data = $this->upload->data();  
                     // echo $data["file_name"];
                     // print_r($data);
                     $condition=array('f_id'=>$this->session->f_id);
                     $params=array('logo'=> $data["file_name"]);
                      $update_data=$this->Setting_model->update_col('table_seller_setting',$condition,$params);
                     //  // echo  json_encode($update_data);
                     echo '<img src="'.base_url().'uploads/'.$data["file_name"].'" width="120" height="120"  />';  
                }  
           }  

}
/*all function end*/

}
?>	