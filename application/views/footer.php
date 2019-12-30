
<script type="text/javascript">
 window.setTimeout(function() {
  $(".alert").fadeTo(500, 0).slideUp(500, function(){
    $(this).remove(); 
  });
}, 4000);

 function isNumberKey(evt) {
  var charCode = (evt.which) ? evt.which : evt.keyCode;
  // Added to allow decimal, period, or delete
  if (charCode == 110 || charCode == 190 || charCode == 46) 
    return true;
  
  if (charCode > 31 && (charCode < 48 || charCode > 57)) 
    return false;
  
  return true;
} // isNumberKey

function isAlpha(evt) {
  var charCode = (evt.which) ? evt.which : event.keyCode
  if ((charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122))
    return false;

  return true;
}

function checkSpcialChar(event){
  if(!((event.keyCode >= 65) && (event.keyCode <= 90) || (event.keyCode >= 97) && (event.keyCode <= 122) || (event.keyCode >= 48) && (event.keyCode <= 57)|| event.keyCode==32)){
   event.returnValue = false;
   return;
 }
 event.returnValue = true;
}
/*use to make whole project autocomplete off*/
$(document).ready(function(){ 
  $("input").attr("autocomplete", "off");

leave_notification();

function leave_notification()
{

var url="<?= base_url()?>leave/leave_application_list/"
  $.ajax({
    type: "get",
    url: "<?= base_url() ?>leave/fetch_leave_notification",
  
    success: function (data) {
      var obj=JSON.parse(data);
      // console.log(obj);
      var row='';

      for(var i=0;i<obj.length;i++)
      {
        row += '<li>'
        +'<a href="'+url+obj[i].id+'" class="waves-effect waves-block">'
        +'<div class="icon-circle bg-blue-grey">'
        +'<i class="material-icons">comment</i>'
        +'</div>'
        +'<div class="menu-info">'
        +'<h4>'+obj[i].name+'</h4>'
        +'</div>'
        +'</a>'
        +'</li>'
      }
      // console.log(row);
      $('#leave_notification').html('<ul class="menu">'+row+'</ul>');
      $('#leave_notification_number').html(obj.length);
    }
  });
}
// <a href="javascript:void(0);" class=" waves-effect waves-block">
//                                             <div class="icon-circle bg-blue-grey">
//                                                 <i class="material-icons">comment</i>
//                                             </div>
//                                             <div class="menu-info">
//                                                 <h4><b>John</b> commented your post</h4>
//                                                 <p>
//                                                     <i class="material-icons">access_time</i> 4 hours ago
//                                                 </p>
//                                             </div>
//                                         </a>
}); 
</script>








<!-- Jquery Core Js -->


<!-- Bootstrap Core Js -->
<script src="<?= base_url() ?>assets/admin/plugins/bootstrap/js/bootstrap.min.js"></script>

<script src="<?= base_url() ?>assets/jquery-ui.js"></script>
<!-- Select Plugin Js -->
<!-- <script src="<?= base_url() ?>assets/admin/plugins/bootstrap-select/js/bootstrap-select.min.js"></script> -->

<!-- Slimscroll Plugin Js -->
<!-- <script src="<?= base_url() ?>/assets/admin/plugins/jquery-slimscroll/jquery.slimscroll.js"></script> -->

<!-- Waves Effect Plugin Js -->
<script src="<?= base_url() ?>assets/admin/plugins/node-waves/waves.min.js"></script>

<!-- Jquery CountTo Plugin Js -->




<!-- Custom Js -->
<script src="<?= base_url() ?>assets/admin/js/admin.js"></script>
<!-- <script src="<?= base_url() ?>/assets/admin/js/pages/index.js"></script> -->

<!-- Demo Js -->
<!-- <script src="<?= base_url() ?>/assets/admin/js/demo.js"></script> -->

   

   
  </body>

  </html>