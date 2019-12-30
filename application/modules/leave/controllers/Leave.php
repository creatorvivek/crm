<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Leave extends MY_Controller
{

 function __construct()
 {
  parent::__construct();
  $this->load->model('Leave_model');

}





function leave_category()
{
  $data['title']='leave category';
  $data['_view'] = 'leave_category';
  $f_id=$this->session->f_id;
  $condition=array('f_id'=>$f_id,'status'=>1);
  $data['leave_category']=$this->Leave_model->select('table_leave_category',$condition,array('id','category_name'));
  $this->load->view('index',$data);


}

function add_leave_category()
{

  $f_id=$this->session->f_id;
  $staff_id=$this->session->staff_id;
  $name = strip_tags($this->input->post('category_name',1));
  

  $this->load->library('form_validation');
  
  $this->form_validation->set_rules('category_name','Leave Category Name','required');


  if($this->form_validation->run())     
  {  

    $date=date('Y-m-d H:i:s');
    $Params=array(

      'category_name' => $name,

      'f_id'=>$f_id


    );
    $id= $this->Leave_model->insert('table_leave_category',$Params);
    if($id)
    {



      $this->session->alerts = array(
        'severity'=> 'success',
        'title'=> 'succesfully add'

      );


      redirect('leave/leave_category');

    }
    else
    {
     $this->session->alerts = array(
      'severity'=> 'danger',
      'title'=> 'not add'

    );


     redirect('leave/leave_category');

   }
 }
 else
 {
   $this->leave_category();
 }
}

function leave_request()
{


 $data['heading']='leave';
 $f_id=$this->session->f_id;
 $condition=array('f_id'=>$f_id);
 $data['leave_category']=$this->Leave_model->select('table_leave_category',$condition,array('id','category_name'));
 $data['_view'] = 'leave_request';

 $this->load->view('index.php',$data);



}
## it will sho in top of header ajax call by footer
function fetch_leave_notification()
{
$f_id=$this->session->f_id;
 $condition=array('t1.f_id'=>$f_id,'t1.status'=>0);
  $data['leave']=$this->Leave_model->leaveNotification('table_leave_request',$condition,array('t1.id','t2.name'));
  echo json_encode($data['leave']);





}
function update_leave_category($id)
{

  $data['title']='leave category';
  $data['_view'] = 'leave_category';
  $f_id=$this->session->f_id;
  $condition=array('f_id'=>$f_id,'status'=>1);
  $data['leave_category']=$this->Leave_model->select('table_leave_category',$condition,array('id','category_name'));

  $leaveCondition=array('id'=>$id,'f_id'=>$f_id);
  $data['category_name']=$this->Leave_model->select_id('table_leave_category',$leaveCondition,array('id','category_name'));

  if(isset($data['category_name']['id']))
  {
    $name = strip_tags($this->input->post('category_name',1));
    $this->load->library('form_validation');
    $this->form_validation->set_rules('category_name','Leave Category Name','required');
    if($this->form_validation->run())     
    {  

      $date=date('Y-m-d H:i:s');
      $Params=array(

        'category_name' => $name,
      );
      $id= $this->Leave_model->update_col('table_leave_category',$leaveCondition,$Params);
      if($id)
      {
        $this->session->alerts = array(
          'severity'=> 'success',
          'title'=> 'succesfully update'

        );


        redirect('leave/leave_category');

      }
      else
      {
       $this->session->alerts = array(
        'severity'=> 'danger',
        'title'=> 'not add'

      );


       redirect('leave/leave_category');

     }
   }
   else
   {
   $data['_view'] = 'edit';
   $this->load->view('index',$data);
     // $this->leave_category();
   }

  }
 else
  show_error('The id you are trying to edit does not exist.');

}

function add_leave_request()
{
 $f_id=$this->session->f_id;
 $staff_id=$this->session->staff_id;
 $name = strip_tags($this->input->post('category_name',1));
 $todate = strip_tags($this->input->post('to',1));
 $fromdate = strip_tags($this->input->post('from',1));
 $reason = strip_tags($this->input->post('reason',1));


 $this->load->library('form_validation');

 $this->form_validation->set_rules('category_name','Leave Category','required');
 $this->form_validation->set_rules('reason','Reason','required');
 $this->form_validation->set_rules('to','To Date','required');
 $this->form_validation->set_rules('from','From Date','required');


 if($this->form_validation->run())     
 {  

  $date=date('Y-m-d H:i:s');
  $Params=array(

    'category_id' => $name,

    'f_id'=>$f_id,
    'start_date'=> $fromdate,
    'end_date'=>$todate,
    'reason'=>$reason,
    'created_at'=>$date,
    'staff_id'=>$staff_id


  );
  $id= $this->Leave_model->insert('table_leave_request',$Params);

  if($id)
  {



    $this->session->alerts = array(
      'severity'=> 'success',
      'title'=> 'succesfully add'

    );


    redirect('leave/my_leave_application');

  }
  else
  {
   $this->session->alerts = array(
    'severity'=> 'danger',
    'title'=> 'not add'

  );


   redirect('leave/my_leave_application');

 }
}
else
{
 $this->leave_request();
 

}
}

function leave_application_list($id='')
{
  $f_id=$this->session->f_id;
  if($id)
  {
  $condition=array('leave_request.f_id'=>$f_id,'leave_request.id'=>$id);

  }
  else
  {
  $condition=array('leave_request.f_id'=>$f_id);
  }
  $data['leave_application']=$this->Leave_model->leaveApplicationList('table_leave_request',$condition,array('leave_category.category_name','leave_request.*'));
  $data['_view'] = 'leave_application';

  $this->load->view('index.php',$data);


}
function my_leave_application()
{
  $f_id=$this->session->f_id;
  $staff_id=$this->session->staff_id;
  $condition=array('leave_request.f_id'=>$f_id,'staff_id'=>$staff_id);
  $data['leave_application']=$this->Leave_model->leaveApplicationList('table_leave_request',$condition,array('leave_category.category_name','leave_request.*'));
  $data['_view'] = 'my_leave_application';

  $this->load->view('index.php',$data);


}
function application_status($status,$id)
{
  $f_id=$this->session->f_id;
  $condition=array('leave_request.f_id'=>$f_id,'id'=>$id);
  $params=array('status'=>$status);
  $data['leave_application']=$this->Leave_model->update_col('table_leave_request',$condition,$params);
  // print_r($data['leave_application']);
  $this->session->alerts = array(
    'severity'=> 'success',
    'title'=> 'Application status is Changed'

  );

  redirect('leave/leave_application_list');

}

function remove_leave_category($id)
{

$f_id=$this->session->f_id;
  $this->Leave_model->update_col('table_leave_category',array('id'=>$id,'f_id'=>$f_id),array('status'=>0));
}





}
/*all function end*/
