	<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class MY_Controller extends MX_Controller {
		function __construct()
		{
			parent::__construct();
			
			if (!isset($this->session->username)) {
	           
	 		           redirect('login/index');
	
	 					}
				// $this->load->model('Authentication_model');
				// 	$auth=$this->Authentication_model->check_authentication($this->uri->segment(1),$this->uri->segment(2),$this->session->user_id,$this->session-	>authorization_id);
				// 	if($auth==False)
				// 	{
				// 		 show_error('You have not permission to access this function');
				// 		die;
			// 	}




		} 

	        
		
	}
	?>