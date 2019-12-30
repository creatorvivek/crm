 <!-- <?= var_dump($ticket_detail) ?>  -->
<h4>Ticket Response</h4>
<div class="card">
  <div class="card-header">
   <h3 class="card-title"><div class="row"><div class="col-md-3" style="color:#1158a3">
     Ticket Id- <?= $ticket_detail['ticket_id'] ?>  </div><div class="col-md-3"> <i class="fa fa-user" aria-hidden="true"> 
      <?= $ticket_detail['name'] ?></i> </div><div class="col-md-3"><button class="btn btn-info">Call  <?= $ticket_detail['mobile'] ?> </button></div><div class="col-md-3" style="font-size: 14px;"><i class="fa fa-clock-o" style="font-size:15px"></i>&nbsp<?= $ticket_detail['created_at'] ?></div> </div> </h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">

     <b>CUSTOMER-ID</b>  -  <?= $ticket_detail['crn_number'] ?>    
     <hr>
     <b>ISSUE</b>  <?= $ticket_detail['comment'] ?>       		
   </div>
 </div>

 <div class="card">
 	<div class="card-header">
 		<h3 class="card-title">Reply</h3>
 	</div> <!-- /.card-header -->
  <div class="card-body">
    <form method="post" action="<?= base_url() ?>ticket/reply">
       <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
     <div class="mb-3">

      <textarea class="textarea" placeholder="Place some text here" id="reply" name="reply"
      style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
    </div>
    <div class="form-group">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" value="yes" name="sms" >
        <label class="form-check-label">Reply For Customer</label>
      </div>

   <!--  <div class="form-check">
      <input class="form-check-input" type="checkbox" value="yes" name="status" >
      <label class="form-check-label">Resolve and Request to close</label>
    </div> -->
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="yes" name="status" >
      <label class="form-check-label">Resolve and request to close</label>
    </div> 
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="yes" name="statusclose" >
      <label class="form-check-label">Resolve and close</label>
    </div>
    <div class="col-md-3">
    <div class="form-group" id="assignIndivisual">
      <label for="assign" class="col-md-4 control-label">Assign</label>
      <select class="form-control select" name="assign" id="assign"   style="width: 100%;">
        <option value="">--select--</option>
        <?php for($i=0;$i<count($staff);$i++) { 
              if($this->session->staff_id!=$staff[$i]['id'])  {  ?>
            
          <option value="<?= $staff[$i]['id'] ?>"><?= $staff[$i]['name'] ?></option>
        <?php  } } ?> 
      </select>
    </div>
  </div>
    <input type="hidden" name="ticket_id" value="<?= $ticket_detail['ticket_id'] ?>">
    <input type="hidden" name="comment" value="<?= $ticket_detail['comment'] ?>">
    <input type="hidden" name="mobile" value="<?= $ticket_detail['mobile'] ?>">
    <input type="hidden" name="crn_number" value="<?= $ticket_detail['crn_number'] ?> ">
  </div>

  <button class="btn btn-info" type="submit">add new reply</button>
</form>
</div>

</div>



 <script type="text/javascript">
   $(document).click(function(){
    $("#show_search_result").hide();
  });
   $(document).ready(function() {
    //Initialize Select2 Elements
    $('.select2').select2();

    //Datemask dd/mm/yyyy
    
  });
</script>