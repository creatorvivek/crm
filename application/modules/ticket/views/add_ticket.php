<style type="text/css">
#show_search_result{
  background-color: #Fffffe;
  list-style-type:none;
}
#show_search_result li:hover
{
  background-color:grey;
  /*color:white;*/
}
.list_design
{
  font-size: 12px;
  color:blue;
}
.customtable
{
  width:100%;
  max-width: 700px;
  min-width: 300px;
  max-height: 400px;
  border-collapse:collapse; 
  background-color: #f8f8f8;
  overflow-y: scroll;

  /*background-color:red;*/
} 
.customtable td
{

  padding:7px; 


}
.customtable tr:hover
{

  background-color:#d2d2d2;


}
.customtable tr
{

  display: block;

}


input:-webkit-autofill + label {
  // Insert your active label styles
}
</style>
<div class="row clearfix">
  <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
    <div class="card">
      <div class="header">
        <h2 align="center">
        TICKET GENERATE
            
        </h2>
        
      </div>
      <div class="body">
        <form method="post" action="<?= base_url() ?>ticket/add"  id="form_validation" >
           <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
           <div class="row clearfix">
           <div class="col-md-12">
          <div class="form-group form-float">
            <div class="form-line">
              <input type="text" class="form-control search"  aria-required="true" onkeypress="search()" >
              <label class="form-label">Search Customer by name and Mobile Number</label>
              <span style="color:red" id="error_customer"></span>
            </div>
          </div>
          <ul id="show_search_result" class="dropdown-menu customtable"></ul>
        </div>
          <div class="col-md-6">
            <div class="form-group form-float">
              <div class="form-line placeholder">
                <input type="text" id="name" name="name" class="form-control name" value="<?= $name ?>" required  >
                <label class="form-label">Name <span class="col-pink">*</span></label>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group form-float">
              <div class="form-line placeholder">
                <input type="text" id="mobile" name="mobile" class="form-control mobile" value="<?= $mobile ?>"  required="" maxlength="10" onkeypress="return isNumberKey(event)">
                <label class="form-label">Mobile <span class="col-pink">*</span></label>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group form-float">
              <div class="form-line placeholder">
                <input type="text"  class="form-control" required="" name="priority"   maxlength="1" onkeypress="return isNumberKey(event)">
                <label class="form-label">Priority <span class="col-pink">*</span></label>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group form-float">
              <div class="form-line placeholder">
                <input type="email" class="form-control email" id="email_address" name="email" value="<?= $email ?>"  required="">
                <label class="form-label">Email Address <span class="col-pink">*</span></label>
              </div>
            </div>
          </div>
          <input type="hidden" name="crn_id" value="<?= $crn ?>" class="crn_id">
          <div class="col-md-12">
            <div class="form-group form-float">
              <div class="form-line placeholder">
                <textarea class="form-control address" name="address" required></textarea>
                <label class="form-label">Addesss <span class="col-pink">*</span></label>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group form-float">
              <div class="form-line">
                <textarea class="form-control" name="discription" required></textarea>
                <label class="form-label">Description <span class="col-pink">*</span></label>
              </div>
            </div>
          </div>
          <!--   <div class="col-md-6">
            <div class="form-group form-float">
              <div class="form-line">
                <select class="form-control" name="lead" id="lead">
                  
                </select>
              </div>
            </div>
          </div> -->
          <div class="col-md-6">
            <p>
              <b>LEAD <span class="col-pink">*</span></b>
            </p>
            <div class="form-group">
            <select class="form-control show-tick" name="leads" required="" data-live-search="true">
              <option value="">-- Please select -- </option>
              <option value="camera">camera</option>
              <option value="internet">internet</option>
              <option value="router">router</option>
              <option value="software">software</option>
            
            </select>
          </div>
          </div>
          <div class="col-md-6">
            <p>
              <b>Attend type <span class="col-pink">*</span></b>
            </p>
            <div class="form-group"> 
            <select class="form-control show-tick" name="attend_type" required="" data-live-search="true">
              <option value="">-- Please select -- </option>
              <option value="sms">Sms</option>
              <option value="call">Call</option>
              <option value="email">Email</option>
              <option value="office">Office</option>
              <option value="facebook">facebook</option>
              <option value="instagram">instagram</option>
              <option value="other">Other Social</option>
            </select>
          </div>
          </div>
          <div class="col-md-6">
          <div class="form-group">
            <p>
              <b>Assign</b>
            </p>
            <select class="form-control show-tick" name="assign" id="assignType" onchange="selectAssignType();">
              <option value=''>----select-----</option>
              <option value="1">indivisual</option>
              <!-- <option value="2">group</option> -->
            </select>
          </div>
          </div>
          <!-- <div class="col-md-6" id="blank"> -->
            <div class="col-md-6" id="blank">
              <p>
              <b></b>
            </p>
             <div class="form-group" >
             </div>
            </div>
          <div class="col-md-6" id="assignIndivisual">
             <p>
              <b>Assign Indivisual</b>
            </p>
            <div class="form-group">
            <!-- <div class="form-control show-tick" id="assignIndivisual"> -->
              <!-- <label for="assign" class="col-md-6 control-label">Indivisual</label> -->
              <select class="form-control select2 show-tick" name="assign_indivisual[]"  multiple >
                <?php for($i=0;$i<count($staff);$i++) { ?>
                <option value="<?= $staff[$i]['id'] ?>"><?= $staff[$i]['name'] ?></option>
                <?php  }  ?>
              </select>
            </div>
            </div>

            <!-- <div class="col-md-6" id="assignGroup">
             <p>
              <b>Assign Group</b>
            </p>
            <div class="form-group" >
         
              <select class="form-control select2" name="assign_group[]" id="group" multiple  >
                <?php for($i=0;$i<count($group);$i++) { ?>
                <option value="<?= $group[$i]['group_id'] ?>"><?= $group[$i]['name'] ?></option>
                <?php }  ?>
              </select>
            </div>
          </div>
        -->
          <!-- <br> -->
        <div class="col-md-12">
           <!-- <div class="bodys"> -->
             <!-- <div class="col-md-6"> -->
          <button type="submit" class="btn btn-primary m-t-15 waves-effect">Generate</button>
        <!-- </div> -->
      <!-- </div> -->
    </div>
  </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script src="<?= base_url() ?>assets/admin/plugins/jquery-validation/jquery.validate.js"></script>
<script>

/* function submitForm(action) {
var form = document.getElementById('formEnquiry');
form.action = action;
form.submit();
}*/

function searchResult() {
// $("#country").keyup(function () {
var searchkeyword = $('#search').val();
var min_length = 1;
if (searchkeyword.length >= min_length) {
// console.log(keyword);
// var keyword = $('#search').val();
// console.log(keyword);
// if (e.keyCode == 13) {
$.ajax({
type: "POST",
url: "<?= base_url() ?>ticket/getSearchResult",
data: {
search_query: searchkeyword
},
success: function (data) {
console.log(data);
var obj=JSON.parse(data);
console.log(obj.length);
if(obj.length==0)
{
$('#show_search_result').hide();
}
else
{
var i,searchdata;
// console.log(obj[0].student_name);
for(i=0;i<obj.length;i++)
{
// tabledata+='<tr onclick="getRow('+obj[i].enquiry_id+')"><td>'+obj[i].customer_name+'</td><td>'+obj[i].username+'</td><td>'+obj[i].mobile+'</td><td>'+obj[i].comments+'</td></tr>'
searchdata+= '<tr onclick="getRow('+obj[i].crn_id+')"><td>'+obj[i].name+' <br><div class="list_design">'+obj[i].mobile+'&nbsp&nbsp crn number &nbsp'+obj[i].crn_id+'</div><td></tr>'
}
$('#show_search_result').show();
$('#show_search_result').html(searchdata);
}
}
});
}
}
function getRow($id) {
$.ajax({
type: "POST",
url: "<?= base_url() ?>ticket/autofill",
data: {
id: $id
},
success: function (data) {
var obj=JSON.parse(data);
console.log(obj);
$('#name').val(obj[0].name );
$('#crn').val(obj[0].crn_id );
$('#mobile').val(obj[0].mobile );
$('#email').val(obj[0].email );
$('#ticket_no').val(obj[0].ticket_id);
// $('#search').val( " " );
$('#show_search_result').hide();
var i,log;
log='<tr><th>issue</th><th>description</th><th>status</th><th>date</th></tr>';
for(i=0;i<obj.length;i++)
{
log+='<tr><td><a href="<?=base_url() ?>ticket/log_ticket_by_ticket_no/'+obj[0].ticket_id+'">'+obj[i].comment+'</a></td><td>'+obj[i].description+'</td><td>'+obj[i].status+'</td><td>'+obj[i].created_at+'</td></tr>'
}
// console.log(log);
$('.ticketLog').show();
$('#ticket_log').show();
$('#ticket_log').html(log);
}
});
}

 function search()
        {
          var search=$('.search').val();
          $.ajax({
            type: "post",
            url: "<?= base_url() ?>crn/search_customer_details",
            data:{search:search,<?= $this->security->get_csrf_token_name();?>:"<?= $this->security->get_csrf_hash();?>"},
            success: function (data) {
              // console.log(data);
              var obj=JSON.parse(data);
              console.log(obj);
              if(obj.length>0)
              {
                var row;
                for(var i=0;i<obj.length;i++)
                {
                  row += '<tr onclick="fill_detail('+obj[i]['id']+','+obj[i]['mobile']+','+obj[i]['pincode']+',\''+obj[i]['address']+'\',\''+obj[i]['city']+'\',\''+obj[i]['email']+'\',\''+obj[i].name+'\')"><td>'+obj[i]['name']+'</td><td>'+obj[i]['mobile']+'</td></tr>';

                }
                $('#show_search_result').show();
                $('#show_search_result').html(row);
              }
              else
              {
                $('#show_search_result').hide();
              }
// $('.amount'+id).val(data);
},
});

        }

 function fill_detail(id,mobile,pincode,address,city,email,name)
{
  // $('.name').val(name);
  // console.log(mobile);
  $('#error_customer').hide();
  $('.search').val(''); 
  $('.crn_id').val(id);
  $('.mobile').val(mobile); 
  $('.name').val(name); 
  $('.address').val(address+', '+city+', '+pincode);
  // $('.pincode').val(pincode);
  // $('.city').val(city);
  // alert(name) ;
  $('.email').val(email); 
  // $('.f_name').addClass('focused');
  // $('.f_email').addClass('focused');
  // $('.f_number').addClass('focused');
  // $('.f_name').addClass('focused');
  $(".placeholder").addClass("focused");
  $('#show_search_result').hide();

  // $('#details').html("<tr><th>Name</th><th>Mobile</th><th>Email</th></tr><tr><td>"+name+"</td><td>"+mobile+"</td><td>"+email+"</td></tr>");

}
function submitForm()
{
var name  = $('#name').val();
var email = $('#email').val();
var mobile = $('#mobile').val();
var lead = $('#lead').val();
var assign = $('#assignType').val();
var assign_group = $('#group').val();
var assign_indivisual = $('#assign').val();
var comment = $('#comment').val();
var description = $('#description').val();
var type  = $('#type').val();
var crn = $('#crn').val();
var priority = $('#priority').val();
var location = $('#autocomplete').val();
var attend_type = $('#attend_type').val();
// console.log(assign_group);
// console.log(attend_type);
bootbox.confirm("click ok generate ticket  ?", function(result) {
if(result)
{
$.ajax({
type: "POST",
url: "<?= base_url() ?>ticket/add",
data: {
name:name,email:email,mobile:mobile,lead:lead,comment:comment,description:description,type:type,crn:crn,location:location,assign:assign,assign_indivisual:assign_indivisual,assign_group:assign_group,priority:priority,attend_type:attend_type
},
success: function (data) {
console.log(data);
document.location.reload();
// alert("successfully ticket generate");
}
});/*ajax close*/
}/*if close*/
});/*bootbox close*/
}
function existingSubmitForm()
{
var name  = $('#name').val();
var ticket_no = $('#ticket_no').val();
var email = $('#email').val();
var mobile = $('#mobile').val();
var lead = $('#lead').val();
var comment = $('#comment').val();
var assign_group = $('#group').val();
var assign_indivisual = $('#assign').val();
var description = $('#description').val();
var type  = $('#type').val();
var assign = $('#assigntype').val();
var attend_type = $('#attend_type').val();
// var crn = $('#crn').val();
var location = $('#autocomplete').val();
bootbox.confirm("click ok generate ticket  ?", function(result) {
if(result)
{
$.ajax({
type: "POST",
url: "<?= base_url() ?>ticket/existing_add",
data: {
name:name,email:email,mobile:mobile,lead:lead,comment:comment,description:description,type:type,location:location,assign:assign,ticket_no:ticket_no,assign_indivisual:assign_indivisual,assign_group:assign_group,attend_type:attend_type
},
success: function (data) {
$('#error').show();
$('#error').html('successfully ticket generated');
document.location.reload();
// alert("successfully ticket generate");
},
});
}
});
}
function selectAssignType()
{
var assign_type=$('#assignType').val();
console.log(assign_type);
if(assign_type==1)
{
  $('#blank').hide();
$('#assignGroup').hide();
$('#assignIndivisual').show();
}
else if(assign_type==2)
{
  $('#blank').hide();
$('#assignIndivisual').hide();
$('#assignGroup').show();
}
else
{
  $('#blank').show();
$('#assignIndivisual').hide();
$('#assignGroup').hide();
}
}
function validateType()
{
var type=$('#type').val();
console.log(type);
if(type==' ')
{
$('.type_error').show();
$('.type_error').html('please select any field');
$('#type').focus();
}
else
{
$('.type_error').hide();
}
}
function validateMobile()
{
var mobile=$('#mobile').val();
console.log(mobile);
if(mobile=='')
{
$('.mobile_error').show();
$('.mobile_error').html('Please fill this field');
$('#mobile').focus();
}
else
{
$('.mobile_error').hide();
}
}

$(document).click(function(){
$("#show_search_result").hide();
});
$(document).ready(function(){
  $('#assignGroup').hide();
$('#assignIndivisual').hide();
  });
//  $(document).ready(function() {
//   $('.select2').select2();
// });


function isNumberKey(evt) {
  var charCode = (evt.which) ? evt.which : evt.keyCode;
  // Added to allow decimal, period, or delete
  if (charCode == 110 || charCode == 190 || charCode == 46) 
    return true;
  
  if (charCode > 31 && (charCode < 48 || charCode > 57)) 
    return false;
  
  return true;
} // isNumberKey
 

   $('#form_validation').validate({
       
        highlight: function (input) {
            $(input).parents('.form-line').addClass('error');
        },
        unhighlight: function (input) {
            $(input).parents('.form-line').removeClass('error');
        },
        errorPlacement: function (error, element) {
            $(element).parents('.form-group').append(error);
        }



    });
 </script>
<!-- <script type="text/javascript">
$(document).ready(function() {
$.ajax({
type: "GET",
url: "<?= base_url() ?>category/categoryTree",
/* data: {
name:name,email:email,mobile:mobile,lead:lead,comment:comment,description:description,type:type,location:location,assign:assign,ticket_no:ticket_no,assign_indivisual:assign_indivisual
},
*/
success: function (data) {
console.log(data);
// $('#lead').html(data);
// alert("successfully ticket generate");
// location.reload();
},
});
});
</script> -->
<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBwBQKHT1VzQEI4EE0YHUOEUhYcOqutJX4&libraries=places&callback=initAutocomplete"
async defer></script>