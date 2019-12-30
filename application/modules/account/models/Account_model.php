<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



class Account_model extends MY_Model{
    function __construct(){
        parent::__construct();
    }


 function get_max_invoice_no($table_invoices,$params)
  {
   
   $this->db->select_max('invoice_id');
   $this->db->from($this->$table_invoices);
   $this->db->where($params);       
   $id = $this->db->get()->row_array();
      // return json_encode($id);
   if(is_null($id['invoice_id']))
   {
   // $id=1;
     $returnData= array('status'=>'not found','status_code'=>404) ;
   }
   else
   {
     $id= ++$id['invoice_id'];
     $returnData= array('status'=>'success','data'=>$id,'status_code'=>200) ;
   }
   return json_encode($returnData);
 }

 function get_max_payment_no($params)
 {
   
   $this->db->select_max('payment_id');
   $this->db->from($this->table_payment_details);
   $this->db->where($params);       
   $id = $this->db->get()->row_array();
      // return json_encode($id);
      // die;
   if(is_null($id['payment_id']))
   {
   // $id=1;
     $returnData= array('status'=>'not found','status_code'=>404) ;
   }
   else
   {
     $id= ++$id['payment_id'];
     $returnData= array('status'=>'success','data'=>$id,'status_code'=>200) ;
   }
   return json_encode($returnData);



 }
  function get_max_vendor_payment_no($params)
 {
   
   $this->db->select_max('payment_id');
   $this->db->from($this->table_vendors_payment);
   $this->db->where($params);       
   $id = $this->db->get()->row_array();
      // return json_encode($id);
      // die;
   if(is_null($id['payment_id']))
   {
   // $id=1;
     $returnData= array('status'=>'not found','status_code'=>404) ;
   }
   else
   {
     $id= ++$id['payment_id'];
     $returnData= array('status'=>'success','data'=>$id,'status_code'=>200) ;
   }
   return json_encode($returnData);



 }
 function get_invoice_data($table_invoices,$table_master_invoices,$params)
 {

  $returnData=array('status'=>'not found','status_code'=>404);
  
  $this->db->select('');
  $this->db->from($this->$table_invoices);
  $this->db->where($params);
  $this->db->join($this->$table_master_invoices,''.$this->$table_master_invoices.'.crn_number='.$this->table_login.'.crn_number');
  $this->db->join($this->table_frenchise,''.$this->table_login.'.f_id='.$this->table_frenchise.'.id');
  $this->db->join($this->table_frenchise_tax,''.$this->table_frenchise_tax.'.f_id='.$this->table_login.'.f_id');
    // $this->db->join('plan_day','plan_day.plan_id=plan_details.id');
    // $this->db->join('plan_amount','plan_amount.plan_id=plan_details.id');
    // $this->db->where(array('after_expire'=>0));
  $data=$this->db->get()->result_array();
  if($data)
  {
    $returnData= array('status'=>'success','data'=>$data,'status_code'=>200) ;
  }

  return json_encode($returnData);

}
function fetch_seller_details($table_name,$condition,$select_contents)
{
	$this->db->select($select_contents);
  	$this->db->from($this->$table_name);
  $this->db->where($condition);
  $this->db->join($this->table_seller,''.$this->table_seller.'.id='.$this->$table_name.'.f_id');
   $data=$this->db->get()->result_array();
   return $data;

}

function maintain_status_invoice($paid,$f_id,$invoice_id)
{
  ##search invoice data by base of condition
  
  $this->db->select('total,paid,status');
  $this->db->where(array('f_id'=>$f_id,'invoice_id'=>$invoice_id));

  $this->db->where('status!=','paid');
  $this->db->limit(1);   
  $record=$this->db->get('invoices')->row_array();
  // var_dump($record);
  if(is_null($record))
  {
    return false;
    die;
  }
  else if($record['status']=='partially')
  {
   $this->db->where(array('f_id'=>$f_id,'invoice_id'=>$invoice_id));
   $this->db->where('status','partially');
   $this->db->limit(1);  
   echo  $addition=$record['paid']+$paid;
   if($addition==$record['total'])
   {
     $this->db->set('status',"paid");
     $this->db->set('paid',$record['total']);
     return $this->db->update('invoices');
   }
   else if($addition>$record['total'])
   {
     $this->db->where(array('f_id'=>$f_id,'invoice_id'=>$invoice_id));
                            // $this->db->where('status!=','paid');
     $this->db->limit(1);  
     $this->db->set('status',"paid");
     $reamaining=$addition-$record['total'];
     $this->db->set('paid',$record['total']);
     $this->db->update('invoices');


     $this->maintain_status_invoice($reamaining,$f_id,$invoice_id);

   }
   else
   {
     $this->db->set('paid', $addition);
     return $this->db->update('invoices');
   }



 }
 elseif($record['total']==$paid)
 {
  ##again serch another row 
  $this->db->where(array('f_id'=>$f_id,'invoice_id'=>$invoice_id));
  $this->db->where('status!=','paid');
  $this->db->limit(1);  
  $this->db->set('status',"paid");
  $this->db->set('paid',$paid);
  return $this->db->update('invoices');
}
else if($record['total']>$paid)
{
  $this->db->where(array('f_id'=>$f_id,'invoice_id'=>$invoice_id));
  $this->db->where('status!=','paid');
  $this->db->limit(1);  
  $this->db->set('status',"partially");
  $this->db->set('paid',$paid);
  return $this->db->update('invoices');
}
else if($record['total']<$paid)
{
  $this->db->where(array('f_id'=>$f_id,'invoice_id'=>$invoice_id));
  $this->db->where('status!=','paid');
  $this->db->limit(1);  
  $this->db->set('status',"paid");
  $reamaining=$paid-$record['total'];
  $this->db->set('paid',$record['total']);
  $this->db->update('invoices');


  $this->maintain_status_invoice($reamaining,$f_id,$invoice_id);
}
}
function fetch_customer_outstanding_balance($table_name,$condition,$selected_contents)
{
   $this->db->select($selected_contents);
  $this->db->from(''.$this->$table_name.' as t1');
  $this->db->where($condition);

        
  $this->db->join(''.$this->table_invoices.' as t2','t1.reference_id=t2.id');
          
  $data=$this->db->get()->result_array();
  return $data;

}


function maintain_status_purchase($paid,$f_id,$purchase_id)
{
  ##search invoice data by base of condition
  
  $this->db->select('total_amount,paid,status');
  $this->db->where(array('f_id'=>$f_id,'purchase_id'=>$purchase_id));

  $this->db->where('status!=','paid');
  $this->db->limit(1);   
  $record=$this->db->get('purchase_master')->row_array();
  // var_dump($record);
  if(is_null($record))
  {
    return false;
    die;
  }
  else if($record['status']=='partially')
  {
   $this->db->where(array('f_id'=>$f_id,'purchase_id'=>$purchase_id));
   $this->db->where('status','partially');
   $this->db->limit(1);  
   echo  $addition=$record['paid']+$paid;
   if($addition==$record['total_amount'])
   {
     $this->db->set('status',"paid");
     $this->db->set('paid',$record['total_amount']);
     return $this->db->update('purchase_master');
   }
   else if($addition>$record['total_amount'])
   {
     $this->db->where(array('f_id'=>$f_id,'purchase_id'=>$purchase_id));
                            // $this->db->where('status!=','paid');
     $this->db->limit(1);  
     $this->db->set('status',"paid");
     $reamaining=$addition-$record['total_amount'];
     $this->db->set('paid',$record['total_amount']);
     $this->db->update('purchase_master');


     $this->maintain_status_purchase($reamaining,$f_id,$purchase_id);

   }
   else
   {
     $this->db->set('paid', $addition);
     return $this->db->update('purchase_master');
   }



 }
 elseif($record['total_amount']==$paid)
 {
  ##again serch another row 
  $this->db->where(array('f_id'=>$f_id,'purchase_id'=>$purchase_id));
  $this->db->where('status!=','paid');
  $this->db->limit(1);  
  $this->db->set('status',"paid");
  $this->db->set('paid',$paid);
  return $this->db->update('purchase_master');
}
else if($record['total_amount']>$paid)
{
  $this->db->where(array('f_id'=>$f_id,'purchase_id'=>$purchase_id));
  $this->db->where('status!=','paid');
  $this->db->limit(1);  
  $this->db->set('status',"partially");
  $this->db->set('paid',$paid);
  return $this->db->update('purchase_master');
}
else if($record['total_amount']<$paid)
{
  $this->db->where(array('f_id'=>$f_id,'purchase_id'=>$purchase_id));
  $this->db->where('status!=','paid');
  $this->db->limit(1);  
  $this->db->set('status',"paid");
  $reamaining=$paid-$record['total_amount'];
  $this->db->set('paid',$record['total_amount']);
  $this->db->update('purchase_master');


  $this->maintain_status_purchase($reamaining,$f_id,$purchase_id);
}
}


function get_max_journal_no($table_name,$params)
{

   
   $this->db->select_max('journal_no');
   $this->db->from($this->$table_name);
   $this->db->where($params);       
   $id = $this->db->get()->row_array();
      // return json_encode($id);
   if(is_null($id['journal_no']))
   {
   // $id=1;
     $returnData= array('status'=>'not found','status_code'=>404) ;
   }
   else
   {
     $id= ++$id['journal_no'];
     $returnData= array('status'=>'success','data'=>$id,'status_code'=>200) ;
   }
   return json_encode($returnData);
 }







}