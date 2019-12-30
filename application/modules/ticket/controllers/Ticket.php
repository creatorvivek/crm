<?php


class Ticket extends MY_Controller{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Ticket_model');

	} 


/*
* Adding a new ticket
*/
function add_ticket()
{
	##when in list user click in ticket generate button then all credential is fetch by get method 
	$data['title']="TICKET GENERATE";
	if($this->input->get())
	{
		// $data['crn']=$this->input->get('crn');
		$data['mobile']= strip_tags($this->input->get('mobile',1));
		$data['email']= strip_tags($this->input->get('email',1));
		$data['name']= strip_tags($this->input->get('name',1));
		$data['crn']=$this->input->get('crn',1);

	}
	else
	{
		// $data['crn']='';
		$data['mobile']='';
		$data['email']='';
		$data['name']='';
		$data['crn']='';
	}
	// var_dump($this->input->get());die;
	// $id=$this->session->id;
	$f_id=$this->session->f_id;
	// $params=array('f_id'=>$f_id);
	$group_data=$this->Ticket_model->select('table_group',NULL,array('id','name'));

	$data['group']=$group_data;

	// }
	// else
	// {
	// 	$data['group']=[];
	// }
	$staffCondition=array('f_id'=>$f_id);
	 // $staff_info = modules::run('api_call/api_call/call_api',''.api_url().'staff/fetchstaff',$params,'POST');
	$staff_info =$this->Ticket_model->select('table_staff',$staffCondition,array('id','name','email','mobile'));


	$data['staff']=$staff_info;

	
	$data['_view'] = 'add_ticket';
	$this->load->view('index',$data);
}
function add()
{   
	
	$f_id=$this->session->f_id;
	$staff_id=$this->session->staff_id;
	// $staff_id='admin';
	
	
##if user is new so insert data in crn table	
	$name = strip_tags($this->input->post('name',1));
	// $type=$this->input->post('type');
            // 'username'=>$this->input->post('username'),
	$email = strip_tags($this->input->post('email',1));
	$mobile = strip_tags($this->input->post('mobile',1));
	$description = strip_tags($this->input->post('discription',1));
	$location = strip_tags($this->input->post('address',1));
	$comment = strip_tags($this->input->post('comment',1));
	$assign=$this->input->post('assign');
	$lead=$this->input->post('leads');
	$priority=$this->input->post('priority');
	$crn_number=$this->input->post('crn_id');
	$date=date('Y-m-d H-i-s');
	$attend_type = $this->input->post('attend_type');
	// $crn_number=11;

	

	
	if(!$crn_number)
	{
		$crnParams=array(

			'name' => $name,
			// 'type'=>$type,
            // 'username'=>$this->input->post('username'),
			'email' =>$email,
			'mobile' => $mobile,
			
			'address' => $location,
			
			'f_id'=>$f_id,
			// 'lead'=>$lead,
			
			// 'f_id'=>$f_id,
			'created_at'=>$date
		);
		
		$crn_number=$this->Ticket_model->insert('table_crn',$crnParams);
		
		// var_dump($addCrnDetails['last_inserted_id']);
		
	}
##generate new ticket id and check previous id
	$ticketParam=array('f_id'=>$f_id);
	$ticketNo=$this->Ticket_model->getLastTicketId('table_ticket',$ticketParam);
	$ticket_arr=json_decode($ticketNo,1);

    // print_r($ticket_arr['data']);
    // die;
	if($ticket_arr['status']=='success')
	{
		$ticket_id=$ticket_arr['ticket_id'];
	}
	elseif($ticket_arr['status']=='initiate')
	{
		$ticket_id=$ticket_arr['data'];
	}
	$ticketparams = array(

		'crn_number' => $crn_number,
		// 'type'=>$type,
		'name'=>$name,
		'email' =>$email,
		'mobile' => $mobile,
		'description' => $description,
		'location' => $location,
		// 'comment' => $comment,
		'assign'=>$assign,
		'lead'=>$lead,
		'ticket_id'=>$ticket_id,
		'f_id'=>$f_id,
		'priority'=>$priority,
		'created_at'=>$date,
		'created_by'=>$staff_id,
		'attend_type'=>$attend_type
            ## testing purpose


	);
	// var_dump($ticketparams);
##insert ticket parameter in ticket table
	$addTicket=$this->Ticket_model->insert('table_ticket',$ticketparams);
	// die;
	// $ticketData= modules::run('api_call/api_call/call_api',''.api_url().'ticket/addTicket',$ticketparams,'POST');
	$assignIndivisual=$this->input->post('assign_indivisual');
	if($assignIndivisual)
	{
	##mapping of assign and ticket id
		foreach ($assignIndivisual as $row) {
			$mapping=array(
				'ticket_id'=>$ticket_id,
				'assign_id'=>$row,
				'f_id'=>$f_id,
				'created_at'=>$date

			);
			$mapInfo = $this->Ticket_model->insert('table_map_ticket_assign',$mapping);

		}
	}
	$assignGroup=$this->input->post('assign_group');
	if($assignGroup)
	{
	##mapping of assign and ticket id
		foreach ($assignGroup as $row) {
			$grpmapping=array(
				'ticket_id'=>$ticket_id,
				'assign_id'=>$row,
				'f_id'=>$f_id

			);
			$mapInfo = $this->Ticket_model->insert('table_map_ticket_assign',$grpmapping);

		}
	}
	// print_r($mapInfo);
	/*end mapping*/
##insert log in log_ticket table	
	$logParams=array(

		'created_by' =>$staff_id,
		// 'type'=>$this->input->post('type'),
            // 'username'=>$this->input->post('username'),
		'email' => $email,
		'mobile' => $mobile,
		'description' =>$description,
		'f_id'=>$f_id,
            // 'location' => $this->input->post('location'),	
		// 'comment' => $this->input->post('comment'),
		'assign'=>$assign,
		'lead'=>$lead,
		'ticket_id'=>$ticket_id,
		'reply'=>'Ticket is generated of ticket id - '.$ticket_id.'',
		'created_at'=>$date

	);
	$addLogTicket=$this->Ticket_model->insert('table_ticket_log',$logParams);
	
	if($addLogTicket)
	{
		$this->session->alerts = array(
			'severity'=> 'success',
			'title'=> 'successfully ticket generate'

		);
		redirect('ticket/ticket_list');
	}
}
// function open_ticket()
// {	
	
// 	$f_id=$this->session->f_id;
// 	$condition=array('f_id'=>$f_id,'status'=>'open');
// 	$ticketData= modules::run('api_call/api_call/call_api',''.api_url().'ticket/fetchTicketByCondition',$condition,'POST');
// 	// var_dump($ticketData);
// 	try
// 	{
// 		if($ticketData=='')
// 		{
// 			throw new Exception("server down", 1);
// 			log_error("ticket/fetchTicketByCondition");

// 		}
// 		if(isset($ticketData['error']))
// 		{
// 			throw new Exception($ticketData['error'], 1);
// 		}
// 	}
// 	catch(Exception $e)
// 	{
// 		die(show_error($e->getMessage()));
// 	}

// 	if($ticketData['status']=='success')
// 	{
// 		$data['open_ticket']=$ticketData['data'];
// 		$data['_view'] = 'open_ticket';
// 		$this->load->view('index',$data);
// 	}
// 	elseif($ticketData['status']=='not found')
// 	{
// 		$data['open_ticket']=[];
// 		$data['_view'] = 'open_ticket';
// 		$this->load->view('index',$data);
// 	}
	
	
// }
// function close_ticket()
// {	
// 	$f_id=$this->session->f_id;
// 	$condition=array('f_id'=>$f_id,'status'=>'close');
// 	$ticketData= modules::run('api_call/api_call/call_api',''.api_url().'ticket/fetchTicketByCondition',$condition,'POST');
// 	try
// 	{
// 		if($ticketData=='')
// 		{
// 			throw new Exception("server down", 1);
// 			log_error("ticket/fetchTicketByCondition");

// 		}
// 		if(isset($ticketData['error']))
// 		{
// 			throw new Exception($ticketData['error'], 1);
// 		}
// 	}
// 	catch(Exception $e)
// 	{
// 		die(show_error($e->getMessage()));
// 	}

// 	if($ticketData['status']=='success')
// 	{
// 		$data['open_ticket']=$ticketData['data'];
// 		$data['_view'] = 'open_ticket';
// 		$this->load->view('index',$data);
// 	}
// 	##if no record in table so empty table show
// 	elseif($ticketData['status']=='not found')
// 	{
// 		$data['open_ticket']=[];
// 		$data['_view'] = 'open_ticket';
// 		$this->load->view('index',$data);
// 	}
// 	##show api related error


	
// }

// function my_close_ticket()
// {
// 	$staff_id=$this->session->staff_id;
// 	$condition=array('status'=>'close','assign_id'=>$staff_id);
// 	$ticketData= modules::run('api_call/api_call/call_api',''.api_url().'ticket/myTicketList',$condition,'POST');
// 	try
// 	{
// 		if($ticketData=='')
// 		{
// 			throw new Exception("server down", 1);
// 			log_error("ticket/myTicketList");

// 		}
// 		if(isset($ticketData['error']))
// 		{
// 			throw new Exception($ticketData['error'], 1);
// 		}
// 	}
// 	catch(Exception $e)
// 	{
// 		die(show_error($e->getMessage()));
// 	}

// 	if($ticketData['status']=='success')
// 	{
// 		$data['open_ticket']=$ticketData['data'];
// 		$data['_view'] = 'open_ticket';
// 		$this->load->view('index',$data);
// 	}
// 	elseif($ticketData['status']=='not found')
// 	{
// 		$data['open_ticket']=[];
// 		$data['_view'] = 'open_ticket';
// 		$this->load->view('index',$data);
// 	}
	
// }
function my_open_ticket()
{
	// $group_id=$this->session->group_id;

$data['title']='my open ticket';
$f_id=$this->session->f_id;
	$staff_id=$this->session->staff_id;
	$condition=array('ticket.status'=>'open','ticket_assign_map.assign_id'=>$staff_id,'ticket_assign_map.f_id'=>$f_id);
	// print_r($condition);
		$ticketDataByStaffId=$this->Ticket_model->my_ticket_list('table_map_ticket',$condition,array('ticket.id','ticket.name','ticket.lead','ticket.ticket_id','ticket.created_by','ticket.comment','ticket.description','ticket.created_at','ticket.email','ticket.mobile','ticket.assign','staff.name as staff_name','attend_type','ticket.status','ticket.priority'));
		// echo '<pre>';
		// $this->output->enable_profiler(TRUE);
		// print_r($ticketDataByStaffId);
		// die;
	// $ticketDataByStaffId= modules::run('api_call/api_call/call_api',''.api_url().'ticket/myTicketList',$condition,'POST');


	##fetch group of staff member
		$fetchgroupCondition=array('member_id'=>$staff_id);
		$fetchGroupId=$this->Ticket_model->fetchGroupOfStaff('table_map_group',$fetchgroupCondition,array('group_id'));
		// print_r($fetchGroupId);die;
		$group_ticket_data=array();
		for($i=0;count($fetchGroupId)>0;$i++)
		{

		$conditionGroup=array('status'=>'open','assign_id'=>$fetchGroupId[$i]['group_id']);
	$ticketDataByGroupId= $this->Ticket_model->my_ticket_list('table_map_ticket',$condition,array('ticket.id','ticket.name','ticket.lead','ticket.ticket_id','ticket.created_by','ticket.comment','ticket.description','ticket.created_at','ticket.email','ticket.mobile','ticket.assign','staff.name as staff_name','attend_type','ticket.status','ticket.priority'));
		array_push($group_ticket_data,$ticketDataByGroupId);
	}
	
	$data['ticket']=array_merge($ticketDataByStaffId,$group_ticket_data);
	// print_r($data['ticket']);

		

		$data['_view'] = 'allTicket';
		$this->load->view('index',$data);

	
}

function check_ticket_status()
{

if($this->input->post())
{
	$ticket_id=$this->input->post('ticket_no',1);
	$f_id=$this->session->f_id;
	$condition=array('log_ticket.f_id'=>$f_id,'log_ticket.ticket_id'=>$ticket_id);
	
	$ticketLogData=$this->Ticket_model->log_by_ticket_number('table_ticket_log',$condition,array("log_ticket.ticket_id","log_ticket.id","log_ticket.type","log_ticket.comment","log_ticket.reply","log_ticket.description","log_ticket.assign","log_ticket.created_by","log_ticket.created_at","ticket.status","log_ticket.mobile","log_ticket.email","ticket.name","ticket.crn_number","staff.name as staff_name","log_ticket.f_id"));
	
	if($ticketLogData)
	{
		$data['mobile']=$ticketLogData[0]['mobile'];
		$data['comment']=$ticketLogData[0]['comment'];
		$data['name']=$ticketLogData[0]['name'];
		$data['description']=$ticketLogData[0]['description'];

		$data['staff_name']=$ticketLogData[0]['staff_name'];
		$data['created_at']=$ticketLogData[0]['created_at'];
		$data['status']=$ticketLogData[0]['status'];
		$data['ticket_id']=$ticketLogData[0]['ticket_id'];
		
	}
	else
	{
		$data['mobile']=[];
		$data['comment']=[];
		$data['name']=[];
		$data['description']=[];

		$data['staff_name']=[];
		$data['created_at']=[];
		$data['status']=[];
	}

$data['ticket_log']=$ticketLogData;
// var_dump($data['ticket_log']);die;
	$data['_view'] = 'ticket_status_show';
	
	$this->load->view('index',$data);

}	
else
{
	$data['heading']='check ticket status';
$data['_view'] = 'check_ticket_status';
		$this->load->view('index',$data);
	}

}

function statusChange()
{       
	$status=$this->input->post('status');
	$id=$this->input->post('id');
	$ticket_id=$this->input->post('ticket_id');
	$params=array(
		'status'=>$status,
		'id'=>$id
	);
	$ticketData= modules::run('api_call/api_call/call_api',''.api_url().'ticket/statusUpdate',$params,'POST');
	try
	{
		if($ticketData=='')
		{
			throw new Exception("server down", 1);
			log_error("ticket/statusUpdate error");

		}
		if(isset($ticketData['error']))
		{
			throw new Exception($ticketData['error'], 1);
		}
	}
	catch(Exception $e)
	{
		die(show_error($e->getMessage()));
	}
	catch(Exception $e)
	{
		die(show_error($e->getMessage()));
	}
	if($status=='close')
	{
		$ticketParams=array(
			'status'=>$status,
			'ticket_id'=>$ticket_id
		);
		modules::run('api_call/api_call/call_api',''.api_url().'ticket/statusUpdateMain',$ticketParams,'POST');
	}
	// echo json_encode($ticketData);die;
	if($ticketData['status']=='success')
	{
		echo "status update successfully";
	}
	elseif($ticketData['status']=='not found')
	{
		echo "not updated";
	}
	
}
#3 ticket add process


function existing_add()
{
	$staff_id=$this->session->staff_id;
	$logParams=array(

		'created_by' =>$staff_id,
		'type'=>$this->input->post('type'),
            // 'username'=>$this->input->post('username'),
		'email' => $this->input->post('email'),
		'mobile' => $this->input->post('mobile'),
		'description' => $this->input->post('description'),	
            // 'location' => $this->input->post('location'),	
		'comment' => $this->input->post('comment'),
		'assign'=>$this->input->post('assign'),
		'lead'=>$this->input->post('lead'),
		'ticket_id'=>$this->input->post('ticket_no'),
		'reply'=>NULL,
		'created_at'=>date('y m d H m i')

	);
	$ticketLogData= modules::run('api_call/api_call/call_api',''.api_url().'ticket/addTicketLog',$logParams,'POST');
	try
	{
		if($ticketLogData=='')
		{
			throw new Exception("server down", 1);
			log_error("ticket/addTicketLog function error");

		}
		if(isset($ticketLogData['error']))
		{
			throw new Exception($ticketLogData['error'], 1);
		}
	}
	catch(Exception $e)
	{
		die(show_error($e->getMessage()));
	}

	$assignIndivisual=$this->input->post('assign_indivisual');
	if($assignIndivisual)
	{
	##mapping of assign and ticket id
		foreach ($assignIndivisual as $row) {
			$mapping=array(
				'ticket_id'=>$ticket_id,
				'assign_id'=>$row

			);
			$mapInfo = modules::run('api_call/api_call/call_api',''.api_url().'ticket/mapTicketAssign',$mapping,'POST');

		}
	}
	$assignGroup=$this->input->post('assign_group');
	if($assignGroup)
	{
	##mapping of assign and ticket id
		foreach ($assignGroup as $row) {
			$grpmapping=array(
				'ticket_id'=>$ticket_id,
				'assign_id'=>$row

			);
			$mapInfo = modules::run('api_call/api_call/call_api',''.api_url().'ticket/mapTicketAssign',$grpmapping,'POST');

		}
	}
	/*end mapping*/
	if($ticketLogData['status']=='success')
	{
		$this->session->alerts = array(
			'severity'=> 'success',
			'title'=> 'successfully ticket Log generate'

		);
		echo json_encode("succesfully");
	}
	



}

function log_ticket_by_ticket_no()
{
	
	$ticket_id=$this->uri->segment(3);
	if($ticket_id)
	{
	$f_id=$this->session->f_id;
	$condition=array('log_ticket.f_id'=>$f_id,'log_ticket.ticket_id'=>$ticket_id);
	
	$ticketLogData=$this->Ticket_model->log_by_ticket_number('table_ticket_log',$condition,array("log_ticket.ticket_id","log_ticket.id","log_ticket.type","log_ticket.comment","log_ticket.reply","log_ticket.description","log_ticket.assign","log_ticket.created_by","log_ticket.created_at","ticket.status","log_ticket.mobile","log_ticket.email","ticket.name","ticket.crn_number","staff.name as staff_name","log_ticket.f_id"));
	
	if($ticketLogData)
	{
		$data['mobile']=$ticketLogData[0]['mobile'];
		$data['comment']=$ticketLogData[0]['comment'];
		$data['name']=$ticketLogData[0]['name'];
		$data['description']=$ticketLogData[0]['description'];

		$data['staff_name']=$ticketLogData[0]['staff_name'];
		$data['created_at']=$ticketLogData[0]['created_at'];
		$data['status']=$ticketLogData[0]['status'];
	}
	else
	{
		$data['mobile']=[];
		$data['comment']=[];
		$data['name']=[];
		$data['description']=[];

		$data['staff_name']=[];
		$data['created_at']=[];
		$data['status']=[];
	}

	$staffCondition=array('f_id'=>$f_id);
	$staff_info =$this->Ticket_model->select('table_staff',$staffCondition,array('id','name','email','mobile'));
	$data['staff']=$staff_info;

	// print_r($data['staff']);
	// die;
## assigning ticket map

		$ticketAssign=array('f_id'=>$f_id,'ticket_id'=>$ticket_id);
		$ticket_assign_info = $this->Ticket_model->select('table_map_ticket_assign',$ticketAssign,array('assign_id','created_at'));
		// print_r($ticket_assign_info );
				$nameStaff=array();
		if(isset($ticket_assign_info[0]['assign_id']))
		{
				for($i=0;$i<count($ticket_assign_info);$i++)
				{
						$assignCondition= array('id'=>$ticket_assign_info[$i]['assign_id'],'f_id'=>$f_id);
						$staff_name =$this->Ticket_model->select('table_staff',$assignCondition,array('id','name'));
								array_push($nameStaff,$staff_name[0]['name']);
				}		


				// print_r($nameStaff);


		}
		// print_r($ticket_assign_info);die;
		$data['assign']=$nameStaff;
// die;
		$data['assign_staff_id']=$ticket_assign_info;
	$data['ticket_id']=$ticket_id;
	$data['ticket_log']=$ticketLogData;
// var_dump($data['ticket_log']);die;
	$data['_view'] = 'log_ticket';
	
	$this->load->view('index',$data);
	}
	// $this->load->view('log_ticket');

}




function ticket_list()
{
	$data['title']='TICKET LIST';
	$ticket_uri=$this->uri->segment(3);
	// echo $ticket_uri;
	$f_id=$this->session->f_id;
	switch($ticket_uri)
	{
		case 'open':
		$condition=array('ticket.status!='=>'close','ticket.f_id'=>$f_id);
		$data['title']='OPEN TICKETS';
	$ticket_lists=$this->Ticket_model->fetch_tickets('table_ticket',$condition,array('ticket.id','ticket.name','ticket.lead','ticket.ticket_id','ticket.created_by','ticket.comment','ticket.description','ticket.created_at','ticket.email','ticket.mobile','ticket.assign','staff.name as staff_name','attend_type','ticket.status','ticket.priority'));
		
		// $in_condition=array("request to close","open");
		break;
		case 'close':
		$condition=array('ticket.status'=>'close','ticket.f_id'=>$f_id);
		$data['title']='CLOSE TICKETS';
		$ticket_lists=$this->Ticket_model->fetch_tickets('table_ticket',$condition,array('ticket.id','ticket.name','ticket.lead','ticket.ticket_id','ticket.created_by','ticket.comment','ticket.description','ticket.created_at','ticket.email','ticket.mobile','ticket.assign','staff.name as staff_name','attend_type','ticket.status','ticket.priority'));
		break;
		case 1:
		$duration='INTERVAL 1 DAY';
		$condition=array("ticket.f_id"=>$f_id);
     // $data['purchase']=$this->Home_model->getSellPurchaseSum('table_item',$condition,array("DAYNAME(created_at) as month","sum(purchase_price) as purchase_price","count(id) as count"),$duration,$group_by='DAY',$order_by='DAY');
		$ticket_lists=$this->Ticket_model->fetch_tickets('table_ticket',$condition,array('ticket.id','ticket.name','ticket.lead','ticket.ticket_id','ticket.created_by','ticket.comment','ticket.description','ticket.created_at','ticket.email','ticket.mobile','ticket.assign','staff.name as staff_name','attend_type','ticket.status','ticket.priority'),$duration);
   // echo $id;
		break;
		case 2:
		$duration='INTERVAL 6 DAY';
		$condition=array("ticket.f_id"=>$f_id);
     // $data['purchase']=$this->Home_model->getSellPurchaseSum('table_item',$condition,array("DAYNAME(created_at) as month","sum(purchase_price) as purchase_price","count(id) as count"),$duration,$group_by='DAY',$order_by='DAY');
		$ticket_lists=$this->Ticket_model->fetch_tickets('table_ticket',$condition,array('ticket.id','ticket.name','ticket.lead','ticket.ticket_id','ticket.created_by','ticket.comment','ticket.description','ticket.created_at','ticket.email','ticket.mobile','ticket.assign','staff.name as staff_name','attend_type','ticket.status','ticket.priority'),$duration);
   // echo $id;
		break;
    #last 1 month
		case 4:
		$duration='INTERVAL 1 MONTH';
		$condition=array("ticket.f_id"=>$f_id);
    // $data['purchase']=$this->Ticket_model->getSellPurchaseSum('table_item',$condition,array("DATE(payment_date) as month","sum(purchase_price) as purchase_price","count(id) as count"),$duration,$group_by='DATE',$order_by='DATE');
		$ticket_lists=$this->Ticket_model->fetch_tickets('table_ticket',$condition,array('ticket.id','ticket.name','ticket.lead','ticket.ticket_id','ticket.created_by','ticket.comment','ticket.description','ticket.created_at','ticket.email','ticket.mobile','ticket.assign','staff.name as staff_name','attend_type','ticket.status','ticket.priority'),$duration);
		break;
    ## this month
		case 3:
		$duration='%y-%m-01';
		$condition=array("ticket.f_id"=>$f_id);
    // $data['purchase']=$this->Ticket_model->getSellPurchaseSumCurrent('table_item',$condition,array("DATE(payment_date) as month","sum(purchase_price) as purchase_price","count(id) as count"),$duration,$group_by='DATE',$order_by='DATE');
		$ticket_lists=$this->Ticket_model->fetch_tickets_current('table_ticket',$condition,array('ticket.id','ticket.name','ticket.lead','ticket.ticket_id','ticket.created_by','ticket.comment','ticket.description','ticket.created_at','ticket.email','ticket.mobile','ticket.assign','staff.name as staff_name','attend_type','ticket.status','ticket.priority'),$duration);
		break;
    ##this year
		case 5:
		$duration='%y-01-01';
		$condition=array("ticket.f_id"=>$f_id);
    // $data['purchase']=$this->Ticket_model->getSellPurchaseSumCurrent('table_item',$condition,array("MONTHNAME(payment_date) as month","sum(purchase_price) as purchase_price","count(id) as count"),$duration,$group_by='MONTH',$order_by='MONTH');
		$ticket_lists=$this->Ticket_model->fetch_tickets_current('table_ticket',$condition,array('ticket.id','ticket.name','ticket.lead','ticket.ticket_id','ticket.created_by','ticket.comment','ticket.description','ticket.created_at','ticket.email','ticket.mobile','ticket.assign','staff.name as staff_name','attend_type','ticket.status','ticket.priority'),$duration);
		default:
		$condition=array('ticket.f_id'=>$f_id);
		$data['title']='TICKET LIST';
		$ticket_lists=$this->Ticket_model->fetch_tickets('table_ticket',$condition,array('ticket.id','ticket.name','ticket.lead','ticket.ticket_id','ticket.created_by','ticket.comment','ticket.description','ticket.created_at','ticket.email','ticket.mobile','ticket.assign','staff.name as staff_name','attend_type','ticket.status','ticket.priority'));

	break;
	}

	// $this->output->enable_profiler(TRUE);
	$data['ticket']=$ticket_lists;
	$data['_view'] = 'allTicket';
	$this->load->view('index',$data);
		// $this->load->view('allTicket');
	// $data['r']=3;
	// var_dump($data['open_ticket']);die;
	

}
// function autofill()
// {
// 	$id=$this->input->post("id");
// 	$params=array('crn_id'=>$id);
// 	$data=modules::run('api_call/api_call/call_api',''.api_url().'ticket/getAutoFill',$params,'POST');
// 	if($data['status']=='success')
// 	{
// 		echo json_encode($data['data']);
// 	}
// }


function getSearchResult()
{
	$search_query=$this->input->post('search_query');
	$f_id=$this->session->f_id;
	$params=array('query'=>$search_query,'f_id'=>$f_id);
	$data=modules::run('api_call/api_call/call_api',''.api_url().'ticket/getAutoSuggetions',$params,'POST');
	if($data['status']=='success')
	{
		echo json_encode($data['data']);
	}
	

}


## used to reply to customer by sms or reply in portal and assign other staff for ticket
function reply()
{


			// print_r($this->input->post());die;	
	$message=$this->input->post('sms');
	$status=$this->input->post('status');
	$mobile=$this->input->post('mobile');
	// $statusclose=$this->input->post('status');
	$ticket_id=$this->input->post('ticket_id');
	$assign=$this->input->post('assign');
	// $crn_number=$this->input->post('crn_number');
	// $crn_number=1;
	$staff_id=$this->session->staff_id;
	$f_id=$this->session->f_id;
		// print_r($this->input->post());
		// die;
	if($message)
	{
		/*send($mobile,$reply);*/
	## send reply to customer number
		// $messageParams=array('message'=>$message,'mobile'=>$mobile);

		modules::run('sms/sms/sendSms',$mobile,$message);
		// $this->Ticket_model->
	}
	##resolve and request to close
	$status_update='open';
	if($status=='status')
	{
		$status_update='request to close';
	}
	##for resolve and close
	if($status=='statusclose')
	{
		$status_update='close';
	}
	$ticketParams=array(

		'ticket_id'=>$ticket_id
	);
	$statusParam=array('status'=>$status_update);
		// print_r($statusParam);
		// $this->Ticket_model->
		// modules::run('api_call/api_call/call_api',''.api_url().'ticket/statusUpdateMain',$ticketParams,'POST');
		 // $activity='Ticket number <b>'.$ticket_id.'</b> close  ' ;
	$s=$this->Ticket_model->update_col('table_ticket',$ticketParams,$statusParam);
    // print_r($s);die;

    // $send_log=modules::run('log/log/user_log',$crn_number,$f_id,$activity,$staff_id);

	
	
	$comment=$this->input->post('comment');
	$reply=$this->input->post('reply');
	$replyData=array(
		'ticket_id'=>$ticket_id,
		'comment'=>$comment,
		'reply'=>$reply,
		'created_at'=>date('Y-m-d H-i-s'),
		'created_by'=>$staff_id,
		'f_id'=>$f_id,
		'mobile'=>$mobile,
		'status'=>isset($status_update)?$status_update:'open'
		
	);
	$this->Ticket_model->insert('table_ticket_log',$replyData);
	if($assign)
	{
		$assignParams=array('assign_id'=>$assign,'ticket_id'=>$ticket_id,'f_id'=>$f_id,'created_at'=>date('Y-m-d H-i-s'));
			// $mapInfo = modules::run('api_call/api_call/call_api',''.api_url().'ticket/mapTicketAssign',$assignParams,'POST');
		$mapInfo = $this->Ticket_model->insert('table_map_ticket_assign',$assignParams);

		$condition=array('ticket_id'=>$ticket_id,'f_id'=>$f_id);
		$assignParam=array('assign'=>1);
		$assignInfo = $this->Ticket_model->update_col('table_ticket',$condition,$assignParam);



	}

	// }
	// echo json_encode($data);
	redirect('ticket/log_ticket_by_ticket_no/'.$ticket_id);

}


}
?>