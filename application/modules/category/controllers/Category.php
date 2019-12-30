<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Category extends MY_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Category_model');
	}



	function add_category()
	{
		$f_id=$this->session->f_id;
		$data['title']="add category";
		$data['_view'] = 'add';
		$params=array('f_id'=>$f_id);
		$category=$this->Category_model->select('table_category',$params,array('category_id','name'));
// var_dump($category);die;
		$data['category']=$category;
		$this->load->view('index.php',$data);

	}

	function add()
	{
		$f_id=$this->session->f_id;
		$category_name=strip_tags($this->input->post('name',1));
		$parent_cat_id=strip_tags($this->input->post('category_id'));
		##fetch category id according to f_id
		$params=array('f_id'=>$f_id);
		$category_id=$this->Category_model->fetchCategoryID('table_category',$params);
		$params=array(
			'f_id'=>$f_id,
			'name'=>$category_name,
			'category_id'=>$category_id,
			'parent_cat_id'=>$parent_cat_id,
			'created_at'=>date('Y-m-d H-i-s')
		);
		$this->Category_model->insert('table_category',$params);
		// $get_data=modules::run('api_call/api_call/call_api',''.api_url().'category/addCategory',$params,'POST');
		// var_dump($get_data);	
		$this->session->alerts = array(
			'severity'=> 'success',
			'title'=> 'successfully added'

		);
		##if category add by ajax thats get redirect==1 pass response=1
		if($this->input->get('redirect')==1)
		{
			echo "1";
		}
		else
		{
			redirect('category/category_list');
		}
	}

	function category_edit($id)
	{


		$data['title']='category';
		
		$f_id=$this->session->f_id;
		$condition=array('f_id'=>$f_id,'id'=>$id);
		$conditionCat=array('f_id'=>$f_id);
		$data['category_option']=array('category_id' => 0, 'name' => 'No Parent Category ');
		$data['category_option1']=$this->Category_model->select('table_category',$conditionCat,array('id','category_id','name','parent_cat_id'));
		array_push($data['category_option1'],$data['category_option']);
		$data['category']=$this->Category_model->select_id('table_category',$condition,array('id','category_id','name','parent_cat_id'));
		// echo '<pre>';
		// print_r($data['category_option1']);die;
		$parentCondition=array('category_id'=>$data['category']['parent_cat_id'],'f_id'=>$f_id);
		$data['parent_category']=$this->Category_model->select_id('table_category',$parentCondition,array('id','category_id','name'));
		// print_r($data['parent_category']);die;
		if(!$data['parent_category'])
		{
			$data['parent_category']=array('category_id' => 0, 'name' => 'No Parent Category ');
		}
		// print_r($data['parent_category']);
		if(isset($data['category']['id']))
		{
			$parent_cat_id = strip_tags($this->input->post('category_id',1));
			$name = strip_tags($this->input->post('name',1));
			$this->load->library('form_validation');
			$this->form_validation->set_rules('name','Category Name','required');
			if($this->form_validation->run())     
			{  

				$date=date('Y-m-d H:i:s');
				$Params=array(

					'name' => $name,
					'parent_cat_id'=>$parent_cat_id

				);
				$updateCondition=array('id'=>$id);
				$id= $this->Category_model->update_col('table_category',$updateCondition,$Params);
				if($id)
				{
					$this->session->alerts = array(
						'severity'=> 'success',
						'title'=> 'succesfully update'

					);


					redirect('category/category_list');

				}
				else
				{
					$this->session->alerts = array(
						'severity'=> 'danger',
						'title'=> 'not add'

					);


					redirect('category/category_list');

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

	function categoryTree($parent_id =0, $sub_mark = ''){
    // $db2=$this->load->database('portal',TRUE);
		$f_id=$this->session->f_id;
		$params=array('f_id'=>$f_id,'parent_cat_id'=>$parent_id);
		$get_data=$this->Category_model->select('table_category',$params,array('category_id','name'));;
		// var_dump($get_data);die;
     // $this->db->select('*');
		for($i=0;$i<count($get_data);$i++)
		{
			echo '<option value="'.$get_data[$i]['category_id'].'">'.$sub_mark.$get_data[$i]['name'].'</option>';
			$this->categoryTree($get_data[$i]['category_id'], $sub_mark.'-');
		}




	}
	function call()
	{
		// echo '<select name="category">';
		echo  $this->categoryTree();
// 
		// echo '</select>';
	}

	function categoryTreeForMembers($parent_id =0, $sub_mark = ''){
    // $db2=$this->load->database('portal',TRUE);
		// $params=array('group_id'=>$parent_id);
		// $db2=$this->load->database('portal',TRUE);
		$this->db->select('staff.name,staff.id,map_group_member.group_id,map_group_member.member_id,team_group.name as group_name,map_group_member.parent_id');
		$this->db->from('map_group_member');
		$this->db->where(array('map_group_member.group_id'=>$parent_id));
		$this->db->join('staff','map_group_member.member_id=staff.id');
		$this->db->join('team_group','map_group_member.group_id=team_group.group_id');
		$row=$this->db->get()->result_array();
  		 // var_dump($row);die;
		// $get_data=modules::run('api_call/api_call/call_api',''.api_url().'category/fetchCategoryTree',$params,'POST');
		// var_dump($get_data);die;
     // $this->db->select('*');
		for($i=0;$i<count($row);$i++)
		{
			echo '<option value="'.$row[$i]['group_id'].'">'.$sub_mark.$row[$i]['group_name'].'</option>';
			echo '<option value="'.$row[$i]['member_id'].'">'.$sub_mark.$row[$i]['name'].'</option>';
			// $this->categoryTreeForMembers($row[$i]['id'], $sub_mark.'-');
		}




	}



	function category_list()
	{	
		$condition=array('f_id'=>$this->session->f_id);
		$data['category']=$this->Category_model->select('table_category',$condition,array('id','category_id','name'));
		$data['_view'] = 'category_list';
		$this->load->view('index.php',$data);

	}
	function fetch_category()
	{
		$categoryParam = array('f_id'=>$this->session->f_id);
    // $this->load->model('category/Category_model');
		$category = $this->Category_model->select('table_category', $categoryParam, array('category_id', 'name'));
		echo json_encode($category);
    // $data['category'] = $category;
	}

	public function getItem()
	{
		$f_id=$this->session->f_id;
		$data = [];
		$parent_key = '0';
		$row = $this->db->query('SELECT category_id, name from category where f_id='.$f_id.'');

		if($row->num_rows() > 0)
		{
			$data = $this->membersTree($parent_key);
		}else{
			$data=["id"=>"0","name"=>"No Members presnt in list","text"=>"No Members is presnt in list","nodes"=>[]];
		}

		echo json_encode(array_values($data));
	}

    /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function membersTree($parent_key)
    {
    	$f_id=$this->session->f_id;
    	$row1 = [];
    	$row = $this->db->query('SELECT category_id, name from category WHERE parent_cat_id="'.$parent_key.'" and f_id="'.$f_id.'" ')->result_array();

    	foreach($row as $key => $value)
    	{
    		$id = $value['category_id'];
    		$row1[$key]['id'] = $value['category_id'];
    		$row1[$key]['name'] = $value['name'];
    		$row1[$key]['text'] = $value['name'];
    		$row1[$key]['nodes'] = array_values($this->membersTree($value['category_id']));
    	}

    	return $row1;
    }

}
?>	