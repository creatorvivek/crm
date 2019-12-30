<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Vendor extends MY_Controller
{

 function __construct()
 {
  parent::__construct();
   $this->load->model('Vendor_model');

}





function add_vendor()
{
 $data['_view'] = 'add_vendor';
$this->load->view('index',$data);


}

function add()
{
// print_r($this->input->post());die;
  $f_id=$this->session->f_id;
  $staff_id=$this->session->staff_id;
  $name = strip_tags($this->input->post('name',1));
  $company_name = strip_tags($this->input->post('company_name',1));
  // $type=strip_tags($this->input->post('type',1));
  $email = strip_tags($this->input->post('email',1));
  $mobile = strip_tags($this->input->post('mobile',1));
  $city = strip_tags($this->input->post('city',1));
  $gender=strip_tags($this->input->post('gender',1));
  $location = strip_tags($this->input->post('address',1));
  $pincode = strip_tags($this->input->post('pincode',1));
 
   $this->load->library('form_validation');
  
  $this->form_validation->set_rules('name','Name','required|trim|alpha_numeric_spaces');

  // $this->form_validation->set_rules('email','Email','required|valid_email|trim');
  // $this->form_validation->set_rules('address','Address','required|trim');
  // $this->form_validation->set_rules('city','City','required|trim|alpha');
  // $this->form_validation->set_rules('pincode','Pincode','required|trim|numeric');

  // $this->form_validation->set_rules('mobile','Mobile number','required|max_length[10]|numeric');
  if($this->form_validation->run())     
  {  
  // $encrtyted_password=md5($password);
  $date=date('Y-m-d H:i:s');
  $vendorParams=array(

    'name' => $name,
    'company_name'=>$company_name,
    'email' =>$email,
    'mobile' => $mobile,
    'address' => $location,
    'pincode'=>$pincode,
    'f_id'=>$f_id,
    'city'=>$city,
    'created_at'=>$date,
    'gender'=>$gender,
    'staff_id'=>$staff_id
  );
  // print_r($vendorParams);
 
 $addvendor= $this->Vendor_model->insert('table_vendor',$vendorParams);
 
  // print_r($addvendor);
  // die;
  if($addvendor)
  {
    


    $this->session->alerts = array(
      'severity'=> 'success',
      'title'=> 'succesfully add'

    );
  
    
    redirect('vendor/vendor_list');
  
  }
}
else
{
  $this->add_vendor();
}
}

function vendor_list()
{
   $data['heading']='VENDOR';
$f_id=$this->session->f_id;
// $this->load->model('Vendor_model');
$condition=array('vendor.f_id'=>$f_id);
 $data['vendor']= $this->Vendor_model->vendor_list('table_vendor',$condition,array('vendor.name','vendor.company_name','vendor.email','vendor.mobile','vendor.gender','vendor.created_at','vendor.id'));
 $data['_view'] = 'vendor_list';

  $this->load->view('index.php',$data);



}
function update($id)
{

  $data['title']="EDIT VENDOR";
  $f_id=$this->session->f_id;
  $params=array('id'=>$id,'f_id'=> $f_id);

    ##details of group 
 // $this->load->model('Vendor_model');
 $data['vendor']= $this->Vendor_model->select('table_vendor',$params,array('*'));
    // var_dump($data['customer']);die;
  if(isset($data['vendor'][0]['id']))
  {
    $this->load->library('form_validation');

 // var_dump($data['customer']);
    $this->form_validation->set_rules('name','Name','required');
    if($this->form_validation->run() )     
    {   
      $f_id=$this->session->f_id;
        $staff_id=$this->session->staff_id;
        $name = strip_tags($this->input->post('name',1));
        $company_name = strip_tags($this->input->post('company_name',1));
        // $type=strip_tags($this->input->post('type',1));
        $email = strip_tags($this->input->post('email',1));
        $mobile = strip_tags($this->input->post('mobile',1));
        $city = strip_tags($this->input->post('city',1));
        $gender=strip_tags($this->input->post('gender',1));
        $location = strip_tags($this->input->post('address',1));
        $pincode = strip_tags($this->input->post('pincode',1));
 
      $updateVendorParams=array(
      
       
    'name' => $name,
    'company_name'=>$company_name,
    'email' =>$email,
    'mobile' => $mobile,
    'address' => $location,
    'pincode'=>$pincode,

    'city'=>$city,
   
    'gender'=>$gender,
   
        
      );
       
      $update=$this->Vendor_model->update_col('table_vendor',$params,$updateVendorParams);

     if($update)
     {
     
     $this->session->alerts = array(
      'severity'=> 'success',
      'title'=> 'succesfully updated'

    );
     redirect('vendor/vendor_list');
   }



   
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

function test_dbs()
{

  $caf_id='caf_id';
  $r='1';
  // echo $caf_id;
  $params=array(

    ''.$r.''=>100,
    'caf_id'=>12

  );  
echo $this->Vendor_model->insert('table_customer_balance',$params);


}





}
/*all function end*/
