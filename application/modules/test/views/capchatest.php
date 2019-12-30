 <script type="text/javascript">
       $(document).ready(function(){
        var d;
// alert(getEndDate());
// alert(test());
a = new Date();
// alert (d);
 var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
     var year = a.getFullYear();
     var month = a.getMonth()+1;
     var date = a.getDate();
     var hour = a.getHours();
     var min = a.getMinutes();
     var sec = a.getSeconds();
     // var time = date + '/' + month + '/' + year + ' ' + hour + ':' + min;
     var time = year + '-' + month + '-' + date + ' ' + hour + ':' + min + ':' +sec;
alert(time);
  // return time;
});





function getEndDate(startDate,day)
{
  var result=false;
  $.ajax({
   type: "POST",
   url: "<?= base_url() ?>recharge/get_end_date",
   data: {validity:30,start_date:'2018-10-10 07:11:11'},

  success: function (data) {

   result = data;
        // console.log(result);
      }, 
      async: false,
      error: function ()
       {
            alert('Error occured');
                    }
    });
  return result;
  // console.log(result);
}
 </script>
