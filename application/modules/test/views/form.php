<form action="<?= base_url() ?>test/form" method="post">
	


      
        <div>
            <input type="text" name="txtInput" id="txtInput" value="" onkeypress="return checkSpcialChar(event)">
        </div>
 <select class="form-control show-tick" data-live-search="true">

  <?php 
  foreach ($item as $row ) {  ?>
    
                                        <optgroup label="<?= $row['item_name'] ?>">
                                           <?php 
                                           $this->db->select('*');
                                           $this->db->where('item_id',$row['id']);
                                          $result= $this->db->get('purchase_item')->result_array();
                                          
                                          for($i=0;$i<count($result);$i++)

                                          { ?>
                                       <option value="<?= $result[$i]['id'] ?>"><?= $result[$i]['item_company'] ?></option>
                                     <?php } ?>
                                        </optgroup>
                                        
  <?php } ?>
                                    </select>
</form>
<a target="_parent" href="https://www.google.com">Qwiet</a>
<script type="text/javascript">

  $(document).ready(function(){  

  	test();
  });



	  function test()
  {	
  	var option=1
  $.ajax({
        type: "POST",
        data:{id:option},
         async:false,
        
        url: "<?= base_url() ?>home/line_graph_sell_purchase",

            success: function (data) {
                console.log(data);
            var obj=JSON.parse(data);
            console.log(obj);   
        },
    });







  }
  function checkSpcialChar(event){
            if(!((event.keyCode >= 65) && (event.keyCode <= 90) || (event.keyCode >= 97) && (event.keyCode <= 122) || (event.keyCode >= 48) && (event.keyCode <= 57))){
               event.returnValue = false;
               return;
            }
            event.returnValue = true;
         }
</script>