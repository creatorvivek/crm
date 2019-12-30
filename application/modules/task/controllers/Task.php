<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Task extends MY_Controller
{

 function __construct()
 {
  parent::__construct();
  $this->load->model('Task_model');
}





// function add_task()
// {
//   $f_id=$this->session->f_id;
//   $staff_params=array(
//     'f_id'=>$f_id
//   );
//   $staff_info = modules::run('api_call/api_call/call_api',''.api_url().'staff/fetchstaff',$staff_params,'POST');
//   try
//     {
//       if($staff_info=='')
//       {
//         throw new Exception("server down", 1);
//         log_error("account/getInvoiceData function error");

//       }
//       if(isset($staff_info['error']))
//       {
//         throw new Exception($staff_info['error'], 1);
//       }
//     }
//     catch(Exception $e)
//     {
//       die(show_error($e->getMessage()));
//     }
//     catch(Exception $e)
//     {
//       die(show_error($e->getMessage()));
//     }
//   if($staff_info['status']=='success')
//   {

//     $data['staff']=$staff_info['data'];

//   }

//   $data['_view'] = 'add_task';
//   $this->load->view('index',$data);
// }

// function task_list()
// {

//   /*future use*/
//   $f_id=$this->session->f_id;
//   $staff_id=$this->session->staff_id;
//   $params=array('assign'=>$staff_id,'f_id'=>$f_id);
//   $get_data=modules::run('api_call/api_call/call_api',''.api_url().'task/fetchtask',$params,'POST');
//    try
//     {
//       if($get_data=='')
//       {
//         throw new Exception("server down", 1);
//         log_error("account/getInvoiceData function error");

//       }
//       if(isset($get_data['error']))
//       {
//         throw new Exception($get_data['error'], 1);
//       }
//     }
//     catch(Exception $e)
//     {
//       die(show_error($e->getMessage()));
//     }
//     catch(Exception $e)
//     {
//       die(show_error($e->getMessage()));
//     }
//   if($get_data['status']=='success')
//   {
//     $data['task']=$get_data['data'];
//     $data['_view'] = 'taskList';
//     $this->load->view('index',$data);

//   }
//   elseif($get_data['status']=='not found')
//   {
//     $data['task']=[];
//     $data['_view'] = 'taskList';
//     $this->load->view('index',$data);
//   }


// }




// function add()
// {
//   $f_id=$this->session->f_id;
//   $ticket_id = $this->input->post('ticket',true);

//   $task = $this->input->post('task');
//   $assign = $this->input->post('assign');
//   // $f_id=$this->session->f_id;

//   $params=array(
//     'ticket_id'=>$ticket_id,
//     'task'=>$task,
//     'assign'=>$assign,
//     'created_by'=>'admin', /*hardcoded this data will come by session*/
//     'f_id'=>$f_id

//   );
// // print_r($params);die;
//   $get_data=modules::run('api_call/api_call/call_api',''.api_url().'task/addtask',$params,'POST');
//    try
//     {
//       if($get_data=='')
//       {
//         throw new Exception("server down", 1);
//         log_error("task/addtask function error");

//       }
//       if(isset($get_data['error']))
//       {
//         throw new Exception($get_data['error'], 1);
//       }
//     }
//     catch(Exception $e)
//     {
//       die(show_error($e->getMessage()));
//     }
//     catch(Exception $e)
//     {
//       die(show_error($e->getMessage()));
//     }
//   if($get_data['status']=='success')
//   {
//     $this->session->alerts = array(
//       'severity'=> 'success',
//       'title'=> 'successfully added'
//     );
//     redirect('task/add_task');

//   }
//   else
//   {
//     $data['error']="TASK ADDED FAILED";
//     $data['_view'] = 'add_task';
//     $this->load->view('index',$data);
//   }


// }

function add_issue()
{
 $f_id=$this->session->f_id;
 $condition=array('f_id'=>$f_id);
 $data['issue_category']=$this->Task_model->select('table_issue_category',$condition,array('id','category_name'));

 $data['_view'] = 'issue_add';
 $this->load->view('index.php',$data);

}

function add_issue_process()
{
 $f_id=$this->session->f_id;
 $staff_id=$this->session->staff_id;
 $category = $this->input->post('category',1);
 $issue = $this->input->post('issue',1);
 $ans = $this->input->post('solution',1);
 $date=date('Y-m-d');
 $issueparams=array(

  'f_id'=>$f_id,
  'staff_id'=>$staff_id,
  'issue'=>$issue,
  'solution'=>$ans,
  'category'=>$category,
  'created_at'=>$date

);
 $issue_report=$this->Task_model->insert('table_issue_report',$issueparams);
}

function daily_report()
{
 $data['_view'] = 'daily_reports';
 $this->load->view('index.php',$data);
}


function daily_report_add()
{
     // print_r($this->input->post());
  $f_id=$this->session->f_id;
  $staff_id=$this->session->staff_id;
  $task = strip_tags($this->input->post('task',true));

  $complete_percent = strip_tags($this->input->post('completion_percent',true));
  $work_did = strip_tags($this->input->post('work',true));
  $category = $this->input->post('category',1);
  $task_complete = $this->input->post('task_completion',true);
  $issue = $this->input->post('issue',1);
  $ans = $this->input->post('solution',1);
  $date=date('Y-m-d');
      // print_r($issue_report);


// die;
  $this->load->library('form_validation');
  
  $this->form_validation->set_rules('task','Task','required');

  $this->form_validation->set_rules('work','Work Did','required');
  // $this->form_validation->set_rules('category','category' ,'required');
  $this->form_validation->set_rules('completion_percent','Goal Percent','required');

  if($this->form_validation->run() )     
  {  

    $date=date('Y-m-d');
    $reportparams=array(
      'staff_id' => $staff_id,
      'task' =>$task,
      'f_id' => $f_id,
      'complete_percent' => $complete_percent,
      'task_completed'=>$task_complete,
      'work_did'=>$work_did,
      'created_at'=>$date
    );
    $report_id= $this->Task_model->insert('table_daily_report',$reportparams);
// print_r($reportparams);die;
## if issue occured
    if(count($issue)>0)
    {
      for($i=0;$i<count($issue);$i++)
      {



      }
    }  
    if($report_id)
    {



      $this->session->alerts = array(
        'severity'=> 'success',
        'title'=> 'succesfully add'

      );
      redirect('task/daily_report');

    }
  }
  else
  {
    $this->daily_report();
  }

}

function issue_list()
{

 $f_id=$this->session->f_id;
 $catCondition=array('f_id'=>$f_id);
 $data['issue_category']=$this->Task_model->select('table_issue_category',$catCondition,array('id','category_name'));

 if($this->input->post())
 {
  $category=$this->input->post('category',1);
  $condition=array('issue_report.f_id'=>$f_id,'category'=>$category);
  }
else
{
    $condition=array('issue_report.f_id'=>$f_id);

}
$data['issue_list']=$this->Task_model->issueList('table_issue_report',$condition,array('issue','solution','staff.name as staff_name','category','issue_report.created_at'));
$data['_view'] = 'issue_list';
$this->load->view('index.php',$data);
  
}

function report_analysis()
{
  $f_id=$this->session->f_id;
  $this->load->helper('user_helper');
  $staffCondition=array('f_id'=>$f_id,'status'=>1);
  $heading= (isset($this->session->menu_staff)?$this->session->menu_staff:'STAFF' );

  $data['staff_name']=$heading;

  $data['staff']= $this->Task_model->select('table_staff',$staffCondition,array('id','name'));
  if($this->input->post())
  {
    $date_range = explode(' - ',$this->input->post('date_range'));
    $start_date = date_change_db($date_range[0]);
    $end_date = date_change_db($date_range[1]);
    $staff_id=$this->input->post('staff');
    if($staff_id)
    {
      $condition=array('daily_report.f_id'=>$f_id,'staff_id'=>$staff_id);

    }
    else
    {
      $condition=array('daily_report.f_id'=>$f_id);
    }
  }
  else
  {
    $condition=array('daily_report.f_id'=>$f_id);
    $start_date='';
    $end_date='';

  }
  $data['report']=$this->Task_model->dailyReport('table_daily_report',$condition,array('task','task_completed','complete_percent','work_did','daily_report.created_at','staff.name as staff_name'),$start_date,
    $end_date);
// $this->output->enable_profiler(TRUE);
   // print_r($data['report']);
  $data['_view'] = 'report_analysis';
  $this->load->view('index.php',$data);
}




/*all function end*/
}
?>	