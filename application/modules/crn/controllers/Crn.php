<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Crn extends MY_Controller
{

 function __construct()
 {
  parent::__construct();
  $this->load->model('Crn_model');
}



function add_crn()
{
  $data['title']="ADD CONTACT";
  
  $data['_view'] = 'add';

  $this->load->view('index.php',$data);

}
function add_crn_process()
{
  $f_id=$this->session->f_id;
  $staff_id=$this->session->staff_id;
  $name = strip_tags($this->input->post('name',true));
  // $type=strip_tags($this->input->post('type',true));
  $email = strip_tags($this->input->post('email',true));
  $mobile = strip_tags($this->input->post('mobile',true));
  $city = strip_tags($this->input->post('city',true));
  $gender = strip_tags($this->input->post('gender',true));
  
  $location = strip_tags($this->input->post('address',true));
  $pincode = strip_tags($this->input->post('pincode',true)); 
  $contact_type = strip_tags($this->input->post('contact_type',true));
  $balance_type = strip_tags($this->input->post('balance_type',true));


  $opening_balance = strip_tags($this->input->post('opening_balance',true));
  // $username = $this->input->post('username',true);
  // $password = $this->input->post('password',true);
  $this->load->library('form_validation');
  
  $this->form_validation->set_rules('name','Name','required|trim');

  $this->form_validation->set_rules('email','Email','required|valid_email|trim');
  $this->form_validation->set_rules('address','Address','required|trim');
  $this->form_validation->set_rules('city','City','required|trim|alpha');
  $this->form_validation->set_rules('pincode','Pincode','required|trim|numeric');

  $this->form_validation->set_rules('mobile','Mobile number','required|exact_length[10]|numeric');
  $this->form_validation->set_rules('opening_balance','Opening balance','numeric');
  if($this->form_validation->run() )     
  {  
  // $encrtyted_password=md5($password);
    $date=date('Y-m-d H:i:s');
    $crnParams=array(

      'name' => $name,
    // 'type'=>$type,
      'email' =>$email,
      'mobile' => $mobile,
      'address' => $location,
      'pincode'=>$pincode,
      'f_id'=>$f_id,
      'city'=>$city,
      'gender'=>$gender,
      'created_at'=>$date,
      'contact_type'=>$contact_type,
      'initial_balance'=>$opening_balance,
    );
    $addCrn= $this->Crn_model->insert('table_crn',$crnParams);
    if($opening_balance>0)
    {

      if($contact_type==1)##customer
      {
        $account_transaction=array(

    ##for opening balance
          'reference_type'=>6,
        'ledger_group'=>6,##sundry debitors

        'customer_id'=>$addCrn,
        'f_id'=>$f_id,
        'created_at'=>date('Y-m-d')
      );
        $account_transactionDouble=array(

    ##for opening balance
          'reference_type'=>6,
        'ledger_group'=>1,##assets
        'credit'=>$opening_balance,
        'customer_id'=>$addCrn,
        'f_id'=>$f_id,
        'double_entry'=>1,
        'created_at'=>date('Y-m-d')
      );

      }
      else
        ##vendor

      {
       $account_transaction=array(

    ##for opening balance
        'reference_type'=>6,
        'ledger_group'=>7,##sundry creditors

        'customer_id'=>$addCrn,
        'f_id'=>$f_id,
        'created_at'=>date('Y-m-d')
      );
       $account_transactionDouble=array(

    ##for opening balance
        'reference_type'=>6,
        'ledger_group'=>1,##assets
        'credit'=>$opening_balance,
        'customer_id'=>$addCrn,
        'f_id'=>$f_id,
        'double_entry'=>1,
        'created_at'=>date('Y-m-d')
      );

     }
      if($balance_type==1)##debit
      {
        $account_transaction['debit']=$opening_balance;
      }
      else
      {
       $account_transaction['credit']=$opening_balance;
     }
      // print_r($account_transaction);die;


     $transaction_insert= $this->Crn_model->insert('table_account_transaction',$account_transaction);
     $transaction_insert_double= $this->Crn_model->insert('table_account_transaction',$account_transactionDouble);
   }

   if($addCrn)
   {
    $activity='crn number = '.$addCrn.'  generated  ' ;
    $crn_number=$addCrn;
    $send_log=modules::run('log/log/user_log',$crn_number,$f_id,$activity,$staff_id);


    $this->session->alerts = array(
      'severity'=> 'success',
      'title'=> 'succesfully add'

    );
    if($this->input->get('redirect_sale'))
    {
      redirect('sales/sale_add');
    }
    else if($this->input->get('redirect_sale_service'))
    {
      redirect('sales/sale_service_add');
    }
    else if($this->input->get('redirect_service'))
    {
     redirect('sales/sale_service');
   }
   else
   { 
    redirect('crn/customer_list');
  }
}
}
else
{
 $data['_view'] = 'add';

 $this->load->view('index.php',$data);
}
}


function customer_list()
{
 $data['title']="Contact Info";
 $f_id=$this->session->f_id;
 $conditionCustomer=array('f_id'=>$f_id,'contact_type'=>1,'status'=>1);
 $conditionVendor=array('f_id'=>$f_id,'contact_type'=>2,'status'=>1);
 if($_SERVER['REQUEST_METHOD'] == 'POST' )
 {
   $this->load->helper('user_helper');
   $date_range = explode(' - ',$this->input->post('date_range'));
   $start_date = date_change_db($date_range[0]);


   $end_date = date_change_db($date_range[1]);
    // }

    // $table_name,$display_contents,$condition,$start_date='',$end_date='',$status='',$coloumn='created_at'


   $customer = $this->Crn_model->report('table_crn',array('*'),$condition,$start_date,$end_date,$status='');
   
 }
 else
 {

   $customer= $this->Crn_model->select('table_crn',$conditionCustomer,array('*'));
   $vendor= $this->Crn_model->select('table_crn',$conditionVendor,array('*'));
 }
  // $customer= modules::run('api_call/api_call/call_api',''.api_url().'crn/crnList',$condition,'POST');
  // var_dump($customer);die;
 $data['customer']=$customer;
 $data['vendor']=$vendor;
 
 
 
 $data['_view'] = 'allUsersList';
 $this->load->view('index',$data);
}


function usernameCheck()
{
  $username=$this->input->post('username');
  $params=array('username'=>$username);
  $result= modules::run('api_call/api_call/call_api',''.api_url().'crn/usernameCheck',$params,'POST');
  if($result['status']=='success')
  {
    echo json_encode($result['data']);
  }
  elseif($result['status']=='not found')
  {
    $result['data']=[];
    echo json_encode($result['data']);
  }
}
function update($id)
{

  $data['title']="Edit customer details";
  $condition=array('id'=>$id,'f_id'=>$this->session->f_id);

    ##details of group 
  
  $data['customer']= $this->Crn_model->select('table_crn',$condition,array('*'));
    // var_dump($data['customer']);die;
  if(isset($data['customer'][0]['id']))
  {
    $this->load->library('form_validation');
    $this->form_validation->set_rules('name','Name','required|trim');

    $this->form_validation->set_rules('email','Email','required|valid_email|trim');
    $this->form_validation->set_rules('address','Address','required|trim');
    $this->form_validation->set_rules('city','City','required|trim|alpha');
    $this->form_validation->set_rules('pincode','Pincode','required|trim|numeric');

    $this->form_validation->set_rules('mobile','Mobile number','required|exact_length[10]|numeric');


    if($this->form_validation->run() )     
    {   
      $f_id=$this->session->f_id;
      $name = strip_tags($this->input->post('name',1));
      
            // 'username'=>$this->input->post('username'),
      $email = strip_tags($this->input->post('email',1));
      $mobile = strip_tags($this->input->post('mobile',1));
      $city = strip_tags($this->input->post('city',1));

      $location = strip_tags($this->input->post('address',1));
      $pincode = strip_tags($this->input->post('pincode',1));
      $gender = strip_tags($this->input->post('gender',1));
      
      $updateCrnParams=array(

        'name' => $name,
        
        'email' =>$email,
        'mobile' => $mobile,
        'address' => $location,
        'pincode'=>$pincode,
        'gender'=>$gender,
        // 'f_id'=>$f_id,
        'city'=>$city
        
      );
      
      $update=$this->Crn_model->update_col('table_crn',$condition,$updateCrnParams);

      if($update=='success')
      {

       $this->session->alerts = array(
        'severity'=> 'success',
        'title'=> 'succesfully updated'

      );
     }

     else
     {
      $this->session->alerts = array(
        'severity'=> 'danger',
        'title'=> 'not updated'

      );
     }
       redirect('crn/customer_list');



     
   }
   else
   {
    $data['_view'] = 'edit';
    $this->load->view('index',$data);
  }
  
}
else
  show_error('The id you are trying to edit does not exist.');
} 


function mobileCheck()
{
  $mobile=$this->input->post('mobile');
  $f_id=$this->session->f_id;
  $params=array('mobile'=>$mobile,'f_id'=>$f_id);
  $result= modules::run('api_call/api_call/call_api',''.api_url().'crn/mobileCheck',$params,'POST');
  if($result['status']=='success')
  {
    echo json_encode($result['data']);
  }
  else if($result['status']=='not found')
  {
   echo json_encode($result=[]);
 }

}


function getCrnNumber()

{
  $f_id=$this->session->f_id;
  $condition=array('f_id'=>$f_id);
  $customer= modules::run('api_call/api_call/call_api',''.api_url().'crn/crnList',$condition,'POST');
  echo json_encode($customer['data']);

}




function search_customer_details()
{

  $search_query=$this->input->post('search',1);
  $f_id=$this->session->f_id;
  $condition=array('f_id'=>$f_id,'contact_type'=>1);
  $result=$this->Crn_model->search_query('table_crn',$condition,$search_query);
  echo json_encode($result);

}
function remove($id)
{

 if($this->session->authorization_id == 2) {
  $f_id=$this->session->f_id;
  $condition=array('id'=>$id,'f_id'=>$f_id);
  
  $deleteInfo=$this->Crn_model->update_col('table_crn',$condition,array('status'=>0));
  // echo $deleteInfo;
  if($deleteInfo=='success')
  {
    echo "1";
  }
  else
  {
    echo $deleteInfo;
  }
}
else
{
  echo 'unauthorize';
}

}
function customer_info($customer_id)
{
   // $data['_view'] = 'w';
  //  $this->load->view('header');
  //  $this->load->view('w');
  //  $this->load->view('footer');
  $data['title']="CUSTOMER DETAILS";
  $f_id=$this->session->f_id;
  $id=$customer_id;
   ##get information by customer id
  $data['customer_detail']=$this->Crn_model->select_id('table_crn',array('id'=>$id),array('*'));
  $data['customer_invoice']=$this->Crn_model->select('table_invoices',array('customer_id'=>$id),array('*'));
  $data['customer_payments']=$this->Crn_model->select('table_payment_details',array('customer_id'=>$id),array('*'));
  // $data['customer_sales']=$this->Crn_model->select('table_sales',array('customer_id'=>$id),array('*'));
  $data['customer_ledger']=$this->Crn_model->select('table_account_transaction',array('customer_id'=>$id,'f_id'=>$f_id,'double_entry'=>0),array('*'),'1');
  $data['customer_id']=$customer_id;
   // echo '<pre>';
   // print_r($data);die;
  $data['_view'] = 'customer_details';
  $this->load->view('index',$data);
}
function vendor_info($customer_id)
{
   // $data['_view'] = 'w';
  //  $this->load->view('header');
  //  $this->load->view('w');
  //  $this->load->view('footer');
  $data['title']="VENDOR DETAILS";
  $f_id=$this->session->f_id;
  $id=$customer_id;
   ##get information by customer id
  $data['customer_detail']=$this->Crn_model->select_id('table_crn',array('id'=>$id),array('*'));
  // $data['customer_invoice']=$this->Crn_model->select('table_invoices',array('customer_id'=>$id),array('*'));
  $data['vendor_payments']=$this->Crn_model->select('table_vendors_payment',array('vendor_id'=>$id),array('*'));
  // $data['customer_sales']=$this->Crn_model->select('table_sales',array('customer_id'=>$id),array('*'));
  $data['customer_ledger']=$this->Crn_model->select('table_account_transaction',array('customer_id'=>$id,'f_id'=>$f_id,'double_entry'=>0),array('*'),'1');
   // echo '<pre>';
   // print_r($data);die;
  $data['_view'] = 'vendor_details';
  $this->load->view('index',$data);
}


function fetch_customer_invoice()
{
  $f_id=$this->session->f_id;
  $customer_id=$this->input->post('customer_id',1);
  // $customer_id=7;
  $condition=array(
    'customer_id'=>$customer_id,
    'f_id'=>$f_id,
    'status!='=>'paid'

  );
  $balanceCondition=array('id'=>$customer_id,
    'f_id'=>$f_id,'balance_status!='=>'paid');
  $data['customer_invoice']= $this->Crn_model->select('table_invoices',$condition,array('invoice_id','total','paid'));
  $data['initial_balance']= $this->Crn_model->select_id('table_crn',$balanceCondition,array('initial_balance','paid'));
  // $this->output->enable_profiler(TRUE);
  echo json_encode($data);

}










}
?>	