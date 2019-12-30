<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Test extends MY_Controller
{

 function __construct()
 {
  parent::__construct();
}

function tree()
{
#dfsdfsdfsldfksdfsdkl
  echo "hii";
$this->db->select('*');
$this->db->from('frenchise');
$row=$this->db->get()->result_array();
// var_dump($row);
for($i=0;$i<count($row);$i++)
{
 $sub_data["id"] = $row[$i]["id"];
 $sub_data["name"] = $row[$i]["name"];
 $sub_data["text"] = $row[$i]["name"];
 $sub_data["email"] = $row[$i]["email"];
 $sub_data["parent_f_id"] = $row[$i]["parent_f_id"];
 $data[] = $sub_data;
}
foreach($data as $key => &$value)
{
 $output[$value["id"]] = &$value;
}
foreach($data as $key => &$value)
{
 if($value["parent_f_id"] && isset($output[$value["parent_f_id"]]))
 {
  $output[$value["parent_f_id"]]["nodes"][] = &$value;
 }
}
foreach($data as $key => $value)
{
 if($value["email"] && isset($output[$value["parent_f_id"]]))
 {
  $output[$value["email"]]["nodes"][] = $value;
 }
}
foreach($data as $key => &$value)
{
 if($value["parent_f_id"] && isset($output[$value["parent_f_id"]]))
 {
  unset($data[$key]);
 }
}
echo json_encode($data);
// echo '<pre>';
// print_r($data);
// echo '</pre>';








}


function tree_view()
{

   // $data['_view'] = 'add_staff';

   $this->session->alerts = array(
      'severity' => 'success',
      'title' => 'successfully added'
    );
    redirect('sales/sales_list');
}


function capcha_form()
{
// $this->load->helper('captcha');
// $vals = array(
//         // 'word'          => 'Random word',
//         'img_path'      => './captcha/',
//         'img_url'       => base_url('captcha'),
//         // 'font_path'     => './path/to/fonts/texb.ttf',
//         // 'img_width'     => '150',
//         // 'img_height'    => 30,
//         'expiration'    => 7200,
//         'word_length'   => 4,
//         // 'font_size'     => 19,
//         // 'img_id'        => 'Imageid',
//         'pool'          => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',

//         // White background and border, black text and red grid
//         'colors'        => array(
//                 'background' =>array(255, 255, 255) ,
//                 'border' => array(0, 0, 0),
//                 'text' => array(0, 0, 0),
//                 'grid' => array(255, 40, 40)
//         )
// );

// $data['cap'] = create_captcha($vals);
$data['_view'] = 'capchatest';
  $this->load->view('index',$data);
// print_r($data['cap']);

}

function profiling()
{
  $this->output->enable_profiler(TRUE);
}
function time_demo()
{
$r=date('Y/m/d',strtotime("-1 days"));
echo $r;

}

function check()
{
$f=$this->frenchise_info(12);
if($f['status']=='success')
{
  print_r($f['data']);
}
}


private function frenchise_info($f_id)

{
  $params=array('f_id'=>$f_id);
  return modules::run('api_call/api_call/call_api',''.api_url().'account/checkGst',$params,'POST');
}
function demo()
{

  $data['designation']=array('0'=>array('id'=>1,'name'=>'softeware'),'1'=>array('id'=>2,'name'=>'mw'));
  $data['_view'] = 'add_staff';
  $this->load->view('index',$data);
}
function form()
{
   $this->load->model('Test_model');
   $params = array('item_list.f_id' =>14);
    $data['item'] = $this->Test_model->select('table_item',$params, array('*'));
$data['_view'] = 'form';
  $this->load->view('index',$data);
 
}


function datatable()
{
//   $this->load->library('parser');
//   $data = array(
//         'blog_title' => 'My Blog Title',
//         'blog_heading' => 'My Blog Heading'
// );

  $data['_view'] = 'dtable';
// $this->parser->parse('index', $data);
  $this->load->view('index',$data);
}

 public function ajax_list()
    {
      $this->load->model('Test_model');
        $list = $this->Test_model->get_datatables('table');
        // print_r($list);
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $customers) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $customers->name;
         
            $row[] = $customers->mobile;
            // $row[] = $customers->address;
            // $row[] = $customers->city;
            // $row[] = $customers->country;
 
            $data[] = $row;
        }
         $draw = intval($this->input->get("draw"));
          $start = intval($this->input->get("start"));
          $length = intval($this->input->get("length"));
        $output = array(
                        "draw" => @$_POST['draw'],
                        "recordsTotal" => $this->Test_model->count_all('table'),
                        "recordsFiltered" => $this->Test_model->count_filtered('table'),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
    function d2()
    {
      $this->load->model('Test_model');
         $draw = intval($this->input->get("draw"));
          $start = intval($this->input->get("start"));
          $length = intval($this->input->get("length"));


          $books = $this->Test_model->select('table_crn',array('f_id'=>1),array('*'));

          $data = array();

          foreach($books as $r) {

               $data[] = array(
                    $r['name'],
                    $r['mobile'],
                     $r['id'],
                    // $r->author,
                    // $r->rating . "/10 Stars",
                    // $r->publisher
               );
          }

          $output = array(
               "draw" => $draw,
                 "recordsTotal" => 7,
                 "recordsFiltered" => 7,
                 "data" => $data
            );
          echo json_encode($output);
    }
    function profiler()
    {

      $this->output->enable_profiler(true);
    }



// upload xlsx|xls file
    public function display() {
        $data['page'] = 'import';
        $data['title'] = 'Import XLSX | TechArise';
        $this->load->view('display', $data);
    }
    // import excel data
    public function save() {
        $this->load->library('excel');
        
        if ($this->input->post('importfile')) {
            $path = 'uploads/excel/';
 
            $config['upload_path'] = $path;
            $config['allowed_types'] = 'xlsx|xls|jpg|png';
            $config['remove_spaces'] = TRUE;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('userfile')) {
                $error = array('error' => $this->upload->display_errors());
                // print_r($error);
            } else {
                $data = array('upload_data' => $this->upload->data());
                // print_r($data);
            }
            
            if (!empty($data['upload_data']['file_name'])) {
                $import_xls_file = $data['upload_data']['file_name'];
            } else {
                $import_xls_file = 0;
            }
            $inputFileName = $path . $import_xls_file;
            try {
                $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
            } catch (Exception $e) {
                die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                        . '": ' . $e->getMessage());
            }
            $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
            
            $arrayCount = count($allDataInSheet);
            $flag = 0;
            $createArray = array('first_name', 'last_name', 'email', 'dob', 'contact_no');
            $makeArray = array('first_name' => 'first_name', 'last_name' => 'last_name', 'email' => 'email', 'dob' => 'dob', 'contact_no' => 'contact_no');
            $SheetDataKey = array();
            foreach ($allDataInSheet as $dataInSheet) {
                foreach ($dataInSheet as $key => $value) {
                    if (in_array(trim($value), $createArray)) {
                        $value = preg_replace('/\s+/', '', $value);
                        $SheetDataKey[trim($value)] = $key;
                    } else {
                        
                    }
                }
            }
            $data = array_diff_key($makeArray, $SheetDataKey);
           // print_r($data);
            if (empty($data)) {
                $flag = 1;
            }
            if ($flag == 1) {
                for ($i = 2; $i <= $arrayCount; $i++) {
                    $addresses = array();
                    $firstName = $SheetDataKey['first_name'];
                    $lastName = $SheetDataKey['last_name'];
                    $email = $SheetDataKey['email'];
                    $dob = $SheetDataKey['dob'];
                    $contactNo = $SheetDataKey['contact_no'];
                    $firstName = filter_var(trim($allDataInSheet[$i][$firstName]), FILTER_SANITIZE_STRING);
                    $lastName = filter_var(trim($allDataInSheet[$i][$lastName]), FILTER_SANITIZE_STRING);
                    $email = filter_var(trim($allDataInSheet[$i][$email]), FILTER_SANITIZE_EMAIL);
                    $dob = filter_var(trim($allDataInSheet[$i][$dob]), FILTER_SANITIZE_STRING);
                    $contactNo = filter_var(trim($allDataInSheet[$i][$contactNo]), FILTER_SANITIZE_STRING);
                    $fetchData[] = array('first_name' => $firstName, 'last_name' => $lastName, 'email' => $email, 'dob' => $dob, 'contact_no' => $contactNo);
                }              
                $data['employeeInfo'] = $fetchData;
                print_r($data['employeeInfo']);
                // $this->import->setBatchImport($fetchData);
                // $this->import->importData();
                $this->db->insert_batch('import', $data['employeeInfo']);
            } else {
                echo "Please import correct file";
            }
         }
        $this->load->view('display', $data);
        
    }


function test_db()
{

//   $caf_id='caf_id';
//   $params=array(

//     $caf_id=>12,
//     'balance'=>100

//   );  
// $this->Test_model->insert('customer_balance',$params);
$i="01";
for($i;$i<20;$i++)
{
  echo '<br>';
  echo $i;
}
}




function checkss()
{
 // $data['_view'] = 'a';
 //  $this->load->view('index', $data);
//   $datas['_view_purchase'] = 'main';
$this->load->view('a');

}


function auto()
{

  $this->load->view('autocomplete');
}


function acdata()
{

  
}


/*all function end*/
}
?>	