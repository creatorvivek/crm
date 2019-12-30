<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends MY_Controller
{

 function __construct()
 {
  parent::__construct();
  $this->load->model('Profile_model');
}


function index()
{

   $data['_view'] = 'profile';
   $staff_id=$this->session->staff_id;
   $condition=array('id'=>$staff_id);
   $data['profile_image']=$this->Profile_model->select('table_staff',$condition,array('profile_image'));

  $this->load->view('index.php',$data);
}

function check_password()
{
  $password=$this->input->post('password');
  $user_id=$this->session->user_id;
  $condition=array('id'=>$user_id,'password'=>md5($password));
  $password_check=$this->Profile_model->select('table_login',$condition,array('id'));
  // $password_check= modules::run('api_call/api_call/call_api',''.api_url().'profile/checkPassword',$params,'POST');
  if($password_check)
  {
    echo json_encode($password_check[0]);
    // echo json_encode($this->load->Profile_model->check_password($password));
  }
  else
  {
    echo json_encode([]);
  }
}

function change_password()
  { 
     $user_id=$this->session->user_id;
    $newpasswordMd5=md5($this->input->post('newpassword'));
    $newpassword=$this->input->post('newpassword');
    ##change in future
    $condition=array('id'=>$user_id);
    $params=array(
     
      'password'=>md5($newpassword),
      'clear_text'=>$newpassword
    );
    $password_change= $this->Profile_model->update_col('table_login',$condition,$params);
  if($password_change=='success')
  {
    echo 'success';
    // echo json_encode($this->load->Profile_model->check_password($password));
  }
  else
  {
    echo '';
  }
    
  }


function user_profile_info()
{
  // $crn_number=$this->input->post('crn_number');
  $staff_id=$this->session->staff_id;
  $condition=array(
    'staff.id'=>$staff_id
  );
  $user_info=$this->Profile_model->user_info('table_staff',$condition,array('name','email','username','profile_image','mobile','authorization_id'));
 
  echo json_encode($user_info);
 // }
}







function update_profile()
{
  
    $name=$this->input->post('name',1);
    $mobile=$this->input->post('mobile',1);
    $email=$this->input->post('email',1);
    $condition=array('id'=>$this->session->staff_id);
    $params=array(
        'name'=>$name,
        'mobile'=>$mobile,
        'email'=>$email,
        

    );
   $password_change= $this->Profile_model->update_col('table_staff',$condition,$params);

   redirect('profile');
}

function check_username()
  {

    $username=$this->input->post('username',1);
    // $params=array('username'=>'admin');
    $params=array('username'=>$username);
    $result=$this->Profile_model->select('table_login',$params,array('username'));
   
        if($result)
        {
          echo json_encode($result);
        }
        else
        {
          
          echo json_encode([]);
        }
  }

  
  function change_username()
  {
      $username=strip_tags($this->input->post('username',1));
    $user_id=strip_tags($this->input->post('user_id',1));
    // $username='surya@cyber';
    $params=array('username'=>$username,);
    $condition=array('id'=>$user_id);
    $result=$this->Profile_model->update_col('table_login',$condition,$params);

       // $result=modules::run('api_call/api_call/call_api',''.api_url().'profile/change_username',$params,'POST');
    // print_r($result);
    if($result=='success')
    {
      echo "1";
    }
    
  }    
function image_upload()  
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
                     $condition=array('id'=>$this->session->staff_id);
                     $params=array('profile_image'=> $data["file_name"]);
                      $update_data=$this->Profile_model->update_col('table_staff',$condition,$params);
                     //  // echo  json_encode($update_data);
                     echo '<img src="'.base_url().'uploads/'.$data["file_name"].'" width="120" height="120"  />';  
                }  
           }  
      }  


/*all function end*/
}
?>	