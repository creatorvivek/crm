
 
 
 
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
   <!-- <link rel="stylesheet" href="<?= base_url() ;?>assets/admin/plugins/bootstrap/css/bootstrap.css"> -->
  
  
  
 




  
   <div id="treeview"></div>
  
 <!-- <div class="col-sm-4">
          <h2>Tags as Badges</h2>
          <div id="treeview6" class="treeview"><ul class="list-group"><li class="list-group-item node-treeview6 node-selected" data-nodeid="0" style="color:#FFFFFF;background-color:#428bca;"><span class="icon expand-icon glyphicon glyphicon-stop"></span><span class="icon node-icon glyphicon glyphicon-user"></span>Parent 1<span class="badge">4</span></li><li class="list-group-item node-treeview6" data-nodeid="5" style="color:undefined;background-color:undefined;"><span class="icon glyphicon"></span><span class="icon node-icon glyphicon glyphicon-user"></span>Parent 2<span class="badge">0</span></li><li class="list-group-item node-treeview6" data-nodeid="6" style="color:undefined;background-color:undefined;"><span class="icon glyphicon"></span><span class="icon node-icon glyphicon glyphicon-user"></span>Parent 3<span class="badge">0</span></li><li class="list-group-item node-treeview6" data-nodeid="7" style="color:undefined;background-color:undefined;"><span class="icon glyphicon"></span><span class="icon node-icon glyphicon glyphicon-user"></span>Parent 4<span class="badge">0</span></li><li class="list-group-item node-treeview6" data-nodeid="8" style="color:undefined;background-color:undefined;"><span class="icon glyphicon"></span><span class="icon node-icon glyphicon glyphicon-user"></span>Parent 5<span class="badge">0</span></li></ul></div>
        </div> -->

  <script type="text/javascript" charset="utf8" src="<?= base_url() ?>assets/admin/dist/js/bootstrap-treeview.js"></script>
<script>
$(document).ready(function(){
 $.ajax({ 
   url: "<?= base_url() ?>test/tree",
   method:"POST",
   dataType: "json",       
   success: function(data)  
   {
    console.log(data);
  $('#treeview').treeview({data: data});
   }   
 });
 
});
</script>
