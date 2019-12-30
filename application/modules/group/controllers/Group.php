<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Group extends MY_Controller
{


	function __construct()
	{
		parent::__construct();
		$this->load->model('Group_model');

	}


	function add_group()
	{
		$f_id=$this->session->f_id;
		$staff_params=array(
			'f_id'=>$f_id
		);
		// $staff_info =
		 // modules::run('api_call/api_call/call_api',''.api_url().'staff/fetchstaff',$staff_params,'POST');
		$condition=array('f_id'=>$f_id,'status'=>1);
		$staff_heading=$this->session->menu_staff?$this->session->menu_staff:'STAFF' ;


		$data['staff']= $this->Group_model->select('table_staff',$condition,array('id','name'));


		$data['_view'] = 'add';
		$this->load->view('index',$data);



	}
	function add()
	{
		##generate new group id
		$f_id=$this->session->f_id;
		$params=array(
			'f_id'=>$f_id
		);
		

		

		

		$params = array(

			'name' => $this->input->post('name'),
			'head_name' => $this->input->post('head'),
			'description' => $this->input->post('description'),
			// 'frenchizy_detail' => $this->input->post('f_detail'),

			// 'belong_business' => $this->input->post('business'),
			
			'f_id'=>$f_id,
			'created_at'=>date('Y-m-d H:i:s')
			// 'group_id'=>$group_id
		);
		$group_id=$this->Group_model->insert('table_group',$params);		
		// $get_data = modules::run('api_call/api_call/call_api',''.api_url().'group/addGroup',$params,'POST');
		
		#map group and staff
		$memberId=$this->input->post('member');
		// $mapBunch=[];
		foreach ($memberId as $row) {
			$mapping=array(
				'group_id'=>$group_id,
				'member_id'=>$row
			);
			// $mapInfo = modules::run('api_call/api_call/call_api',''.api_url().'group/addMappingToStaff',$mapping,'POST');
			$data=$this->Group_model->insert('table_map_group',$mapping);		
			
		}		
		$this->session->alerts = array(
			'severity'=> 'success',
			'title'=> 'succesfully add'

		);
		redirect('group/all_group_list');
	}

	function all_group_list()
	{

		$f_id=$this->session->f_id;
		$condition=array(
			'f_id'=>$f_id
		);
		// $get_data = modules::run('api_call/api_call/call_api',''.api_url().'group/groupList',$params,'POST');
		$data['group']=$this->Group_model->select('table_group',$condition,array('id','name','head_name','created_at','description'));   
		$data['_view'] = 'groupList';
		$this->load->view('index',$data);

	}
	## details of group are shown
	function group_info()
	{
		$f_id=$this->session->f_id;
		$group_id=$this->input->get('group_id');
		$condition=array(
			'id'=>$group_id
		);
		$staff_params=array(
			'map_group_member.group_id'=>$group_id
		);
		$condition_staff=array(
			'f_id'=>$f_id
		);
		##details of group 
		// $get_data = modules::run('api_call/api_call/call_api',''.api_url().'group/groupList',$params,'POST');

		$data['group_data']=$this->Group_model->select_id('table_group',$condition,array('id','name','head_name','created_at','description'));
		#list of group member
		
		$data['staff_group'] = $this->Group_model->fetch_staff_by_group($staff_params,array('staff.id','name','mobile'));
		
		##fetch total staff of current frenchise to give option in dropdown
		
		$data['staff']= $this->Group_model->select('table_staff',$condition_staff,array('id','name','mobile'));
		// echo '<pre>';
		// print_r($data );die;
			$data['_view'] = 'groupInfo';
			$this->load->view('index',$data);


	}

	function mapGroupMember()
	{
		#map group and staff
		$memberId=$this->input->post('member');
		$groupId=$this->input->post('group_id');
		// $mapBunch=[];
		foreach ($memberId as $row) {
			$mapping=array(
				'group_id'=>$groupId,
				'member_id'=>$row

			);
			$mapInfo = modules::run('api_call/api_call/call_api',''.api_url().'group/addMappingToStaff',$mapping,'POST');
			if($mapInfo['status']=='success')
			{
				echo json_encode($mapInfo['status']);
			}
			
		}
	}
	function deleteMember()
	{
		$member_id=$this->input->post('member_id');
		$groupId=$this->input->post('group_id');
		$params=array('group_id'=>$groupId,'member_id'=>$member_id);
		$deleteInfo = modules::run('api_call/api_call/call_api',''.api_url().'group/removeMemberFromGroup',$params,'POST');
		if($deleteInfo['status']=='success')
		{
			echo "success";
		}

	}

	function deleteGroup()
	{
		$group_id=$this->input->post('group_id');
		$params=array(
			'group_id'=>$group_id	


		);	
		$deleteInfo = modules::run('api_call/api_call/call_api',''.api_url().'group/deleteGroup',$params,'POST');
		try
		{
			if($deleteInfo=='')
			{
				throw new Exception("server down", 1);
				log_error("group/groupList function error");
				
			}
			if(isset($deleteInfo['error']))
			{
				throw new Exception($deleteInfo['error'], 1);
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
		if($deleteInfo['status']='success')
		{
			$this->session->alerts = array(
				'severity'=> 'success',
				'title'=> 'successfully deleted'

			);
			redirect('group/all_group_list');
		}
		elseif($deleteInfo['status']='failure')
		{

			$this->session->alerts = array(
				'severity'=> 'failure',
				'title'=> 'not deleted'

			);
		}
		else
		{
			echo($deleteInfo['error']);
			
		}

	}
	function my_group()
	{
		$staff_id=$this->session->staff_id;
		$params=array('member_id'=>$staff_id);
		$groupInfo = modules::run('api_call/api_call/call_api',''.api_url().'group/myGroup',$params,'POST');
		try
		{
			if($groupInfo=='')
			{
				throw new Exception("server down", 1);
				log_error("group/groupList function error");
				
			}
			if(isset($groupInfo['error']))
			{
				throw new Exception($groupInfo['error'], 1);
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
		if($groupInfo['status']=='success')
		{
			$data['group']=$groupInfo['data'];
			$data['_view'] = 'groupList';
			$this->load->view('index',$data);
		}
		elseif($groupInfo['status']=='not found')
		{
			$data['group']=[];
			$data['_view'] = 'groupList';
			$this->load->view('index',$data);
		}
		
	}
	

	function edit($id)
	{
		$data['title']="Edit Group";
		$params=array('id'=>$id);
		$f_id=$this->session->f_id;
		##details of group 
		$data['group'] = modules::run('api_call/api_call/call_api',''.api_url().'group/groupList',$params,'POST');
		// var_dump($get_data['group']['data'][0]['id']);die;
		if(isset($data['group']['data'][0]['id']))
		{
			$this->load->library('form_validation');

			
			$this->form_validation->set_rules('name','Name','required');
			if($this->form_validation->run() )     
			{   
				$updateParams = array(

					'name' => $this->input->post('name'),
					'head_name' => $this->input->post('head'),
					'description' => $this->input->post('description'),
					'frenchizy_detail' => $this->input->post('f_detail'),

					'belong_business' => $this->input->post('business'),

					'f_id'=>$f_id,
					'created_at'=>date('d-m-y:h-m-s'),
					'group_id'=>$data['group']['data'][0]['group_id'],
					'id'=>$data['group']['data'][0]['id']


				);
				// var_dump($updateParams);
				$update_data = modules::run('api_call/api_call/call_api',''.api_url().'group/updateGroup',$updateParams,'POST');

				if($update_data['status']=='success')
				{

					$this->session->alerts = array(
						'severity'=> 'success',
						'title'=> 'successfully edited'
					);
					redirect('group/all_group_list');
				}
			}
			else
			{
				$data['_view'] = 'edit';
				$this->load->view('index',$data);
			}
		}
		else
			show_error('The group you are trying to edit does not exist.');
	} 


	
}


?>