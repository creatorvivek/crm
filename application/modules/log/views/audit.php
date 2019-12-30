
 <!-- <?php var_dump($audit) ;?>  -->
<form action="<?= base_url() ?>log/user_audit" method="post">
 <div class="row">
  <div class="col-md-12">
    <div class="card card-danger card-outline">
      <div class="card-body">
        <div class="row">
          <div class="col-md-3">
           <div class="input-group">
          <span class="input-group-text">Customer name</span>
              
<select class="crn_number"  name="crn_number"></select>
                          
          </div><!-- /.form group -->
        </div>
         
      
        <div class="col-md-1">
          <div class="form-group">
            <!-- <label>dfsdf </label> -->
            <input type="submit" name="dat_range" value="Search"  class="btn btn-primary form-control" >
          </div>
        </div>

           
     </div>
   </div>
 </div>
</div>
</div>

<ul class="timeline timeline-inverse">
  <!-- timeline time label -->
  <?php $length=count($audit) ;
  for($i=0;$i<$length;$i++) { ?>
    <li class="time-label">
      <span class="bg-danger">
  <!-- <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3> -->
        <?php

        echo date('j F Y', strtotime($audit[$i]['date']));

        ?>
      </span>
    </li>
    <!-- /.timeline-label -->
    <!-- timeline item -->
    <li>
      <i class="fa fa-envelope bg-primary"></i>

      <div class="timeline-item">
        <span class="time"><i class="fa fa-clock-o"></i><?= date('h i a', strtotime($audit[$i]['date'])); ?></span>

        <h3 class="timeline-header"><b>by</b>  <?= $audit[$i]['staff_name'] ?></h3>

        <div class="timeline-body">
         <?= $audit[$i]['activity'] ;?>
       </div>

     </div>
   </li>
   <!-- END timeline item -->
   <!-- timeline item -->

 <?php } ?>
</ul>
</form>
<script type="text/javascript">
$(document).ready(function() {
   
    $.ajax({
      type: "GET",
      url: "<?= base_url() ?>crn/getCrnNumber",
      
      success: function (data) {
        console.log(data);
          var obj=JSON.parse(data);
          var i,result;
          for (i = 0; i <obj.length; i++) {
            result+='<option value='+obj[i].crn_id+'>'+obj[i].name+'</option>';
          }
          $('.crn_number').html(result);
        },
      });
      });
    </script>