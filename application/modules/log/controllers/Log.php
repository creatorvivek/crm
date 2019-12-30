<?php


class Log extends MY_Controller{
	function __construct()
	{
		parent::__construct();

		$this->load->model('Log_model');

	} 


	function user_log($crn_number,$f_id,$activity,$staff_id)
	{
		$params=array(
			'crn_number'=>$crn_number,
			'f_id'=>$f_id,
			'activity'=>$activity,
			'staff_id'=>$staff_id
		);
		$this->Log_model->insert_log($params);

	}

	function user_audit()
	{	
		if($this->input->post('crn_number'))
		{
			$crn_number=$this->input->post('crn_number',1);
			$data['audit']=$this->Log_model->select_log($crn_number);
		}
		else
		{
			$crn_number='';
			$data['audit']=[];
		}
		$data['_view'] = 'audit';
		$this->load->view('index',$data);
	}

	function sms_log()
	{
		$f_id=$this->session->f_id;
		$condition=array('f_id'=>$f_id);
		$data['log']=$this->Log_model->select('table_sms_log',$condition,array('message','mobile','id','created_at'));
			// print_r($data['log']);die;
		$data['_view'] = 'sms_log';
		$this->load->view('index',$data);
		
	}
	function login_log()
	{
		
		$f_id=$this->session->f_id;
		$condition=array('f_id'=>$f_id);
		$data['log']=$this->Log_model->select('table_log_login',$condition,array('*'));
		
		$data['_view'] = 'login_log';
		$this->load->view('index',$data);
	}
	function delete_login_log()
	{
		$f_id=$this->session->f_id;
		$condition=array('f_id'=>$f_id);
		$this->Log_model->delete('table_log_login',$condition);
		redirect('log/login_log');
	}

}
?>