<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Quotation extends MY_Controller
{

 function __construct()
 {
  parent::__construct();
    $this->load->model('Quotation_model');

  // $this->ss='ff';

}
// $this->ss='ff';
// public $ss="date('Y-m-d H:i:s')";




function make_quotation()
{
 $data['_view'] = 'add_quotation';
$this->load->view('index',$data);


}

function add()
{
// print_r($this->input->post());die;
  $f_id=$this->session->f_id;
  $staff_id=$this->session->staff_id;
  $name = strip_tags($this->input->post('name',1));
  // $company_name = strip_tags($this->input->post('company_name',1));
  // $type=strip_tags($this->input->post('type',1));
  $c_email = strip_tags($this->input->post('email',1));
  $c_mobile = strip_tags($this->input->post('mobile',1));
  $product = $this->input->post('product',1);
  $qty = $this->input->post('qty',1);
  $unit_price = $this->input->post('price',1);
  $subtotal=$this->input->post('sub_total',1);
  $terms =  strip_tags($this->input->post('terms',1));
  $total = $this->input->post('total',1);
  $tax_amount = $this->input->post('tax_amount',1);
  $tax_percent=$this->input->post('tax_percent',1);
  $grand_total = $this->input->post('total_amount',1);
  // $city = strip_tags($this->input->post('city',1));
  // $gender=strip_tags($this->input->post('gender',1));
  // $location = strip_tags($this->input->post('address',1));
  // $pincode = strip_tags($this->input->post('pincode',1));
   $this->load->library('form_validation');
  
  $this->form_validation->set_rules('name','Name','required|trim|alpha_numeric_spaces');

  // $this->form_validation->set_rules('email','Email','required|valid_email|trim');
  // $this->form_validation->set_rules('address','Address','required|trim');
  // $this->form_validation->set_rules('city','City','required|trim|alpha');
  // $this->form_validation->set_rules('pincode','Pincode','required|trim|numeric');

  // $this->form_validation->set_rules('mobile','Mobile number','required|max_length[10]|numeric');
  if($this->form_validation->run())     
  {  
     $seller=modules::run('account/account/seller_info',$f_id);
  // $encrtyted_password=md5($password);
  $date=date('Y-m-d H:i:s');
    $quotationParams=array(

    'c_name' => $name,
    'f_company_name'=>$seller[0]['company_name'],
    'c_email' =>$c_email,
    'f_email' =>$seller[0]['email'],
    'c_mobile' => $c_mobile,
    'f_mobile' => $seller[0]['mobile'],
    'f_address' =>$seller[0]['address'],
    'f_city' =>$seller[0]['city'],
    'f_pincode' =>$seller[0]['pincode'],
      'grand_total'=>$grand_total,
      'tax_percent'=>$tax_percent,
      'tax'=>$tax_amount,
    'f_id'=>$f_id,
    'subtotal'=>$subtotal,
    'terms'=>$terms,
    'created_at'=>$date,
   
    'staff_id'=>$staff_id
  );
  // print_r($quotationParams);
 $addquotation= $this->Quotation_model->insert('table_quotation',$quotationParams);
 ##
 for ($i = 0; $i < count($product); $i++) { 
      # code...

    
    ##inserts sale details
      $saleDetailsParam = array(
        'item_name' => $product[$i],
        'unit_price' =>  $unit_price[$i],
        'f_id' => $f_id,
        'qty'=>$qty[$i],
        'total_price' =>  $total[$i],
        // 'created_at' =>$date,
        'quo_id'=>$addquotation
      );
      $addSalesDetails = $this->Quotation_model->insert('table_quotation_details', $saleDetailsParam);
      // print_r($addSalesDetails);
    }
  
  if($addquotation)
  {
    


    $this->session->alerts = array(
      'severity'=> 'success',
      'title'=> 'succesfully add'

    );
   
    redirect('quotation/quotation_list');
  
  }
}
else
{
   $data['_view'] = 'add_quotation';

  $this->load->view('index.php',$data);
}
}

function quotation_list()
{
   $data['heading']='QUOTATION LIST';
   $data['title']='QUOTATION LIST';
$f_id=$this->session->f_id;
// $this->load->model('quotation_model');
$condition=array('quotation.f_id'=>$f_id);
 $data['quotation']= $this->Quotation_model->select('table_quotation',$condition,array('quotation.c_name','quotation.c_mobile','quotation.c_email','quotation.created_at','quotation.id'));
 // print_r($data['quotation']);
 $data['_view'] = 'quotation_list';

  $this->load->view('index.php',$data);



}

function quotation_print($id)
{
$data['heading']='quotation';
$f_id=$this->session->f_id;
$condition=array('f_id'=>$f_id,'id'=>$id);
$detailsCondition=array('f_id'=>$f_id,'quo_id'=>$id);
$quotation= $this->Quotation_model->select('table_quotation',$condition,array('*'));
$data['quotation']=$quotation[0];
$data['quotation_details']= $this->Quotation_model->select('table_quotation_details',$detailsCondition,array('*'));
// echo '<pre>';
// print_r($data['quotation']);
// print_r($data['quotation_details']);
$this->load->view('print_quotation',$data);

}

function test()
{
  echo $this->ss;
  $seller_info=modules::run('account/account/seller_info',14);
  // print_r($seller_info);
}

}
/*all function end*/
