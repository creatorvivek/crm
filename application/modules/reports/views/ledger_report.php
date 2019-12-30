<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<section class="content-header head">
  <h1>Credit Debit Report</h1>
</section>
<form name="form" method="post" action="<?php base_url()?>debit_credit_report">                  <!-- Date range -->

 <div class="row">
  <div class="col-md-12">
    <div class="card card-danger card-outline">
      <div class="card-body">
        <div class="row">
          <div class="col-md-3">
           <div class="input-group">
          <span class="input-group-text">Date Range</span>
              <input type="text" class="form-control" id="daterange" name="date_range" autocomplete="off" required>
                          
          </div><!-- /.form group -->
        </div>
         
        <div class="col-md-1">
          <div class="form-group">
            <!-- <label>dfsdf </label> -->
            <input type="submit" name="dat_range" value="Search"  class="btn btn-primary form-control" >
          </div>
        </div>
        <div class="col-md-5 pull-right">
         <div class="form-group">
           <!-- <label> </label> -->
           <?php
           $date_rang = (!empty($this->input->post('date_range')))? $this->input->post('date_range'): 'Please select date range';
           ?>
           Date Rang: <?=  $this->input->post('date_range')?>
         </div>
       </div>
     </div>
   </div>
 </div>
</div>
</div>
  <div class="row">
           		<div class="col-md-6">
                <div class="card card-warning">
                	<div class="card-header">
                    	<h3 class="card-title">Credited</h3>
                  			  <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                </div>
                    </div>
                     <section class="content">
                  <div class="row">
           			 <div class="col-md-12">
                  		<div class="card">
                   	 		<div class="card-body" id="colvis">                                                 
	                             <table id="example1" class="table table-striped">
                             		<thead>
                            			<tr>
                                            <th>Reciept Id</th>
                                            <th>Amount</th>
                                            <!-- <th>Details</th> -->
                                            <th>Date</th>
                               			 </tr>
                                    </thead>
                                    <tbody>
										<?php 
                                            $credit_sub = 0;
                                            $debit_sub = 0;
                                            foreach($credits as $credit) 
                                     { 
                                            

                                     	// var_dump($credit['reciept_id']);
                                                $credit_sub += $credit['credit'];
                                                ?>
                                        <tr>

                                            <td><?= $credit['reciept_id'] ?></td>
                                            <td><?= $credit['credit'] ?></td>
                                          <!-- <td><?= $credit['credit'] ?></td>  -->
                                          <td><?= $credit['date'] ?></td> 
                                        </tr>
                                        <?php  } ?>
                                        
                                     </tbody>
                                     <tfoot>
                                        <tr>
                                            <td class="text-right"><b>Sub Total:</b></td>
                                            <td><strong><?= $credit_sub;?></strong></td>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                            	</table>
                              </div>
                            </div>
                        </div>
                    </div>
                 </section>
               </div>
           </div>
           		<div class="col-md-6">
                <div class="card card-warning">
                	<div class="card-header">
                    	<h3 class="card-title">Debited</h3>
                    </div>
                     <section class="content">
                  <div class="row">
           			 <div class="col-md-12">
                  		<div class="card">
                   	 		<div class="card-body" id="colvis1">                                                 
	                             <table id="example2" class="table table-bordered table-striped">
                             		<thead>
                                        <tr>
                                            <th>Invoice Id</th>
                                            <th>Amount</th>
                                            <!-- <th>Details</th> -->
                                            <th>Date</th>
                                        </tr>
                                     </thead>
                                     <tbody>
										<?php 
                                            foreach($debits as $debit):
                                                $debit_sub += $debit['debit'];
                                        ?>
                                        <tr>
                                            <td><a href="<?= site_url('account/get_invoice/'.$debit['invoice_id']); ?>"  target="_blank"><?=$debit['invoice_id']; ?></a></td>
                                            <td><?= $debit['debit'] ?></td>
                                            <!-- <td><?= $debit['invoice_id'] ?></td> -->
                                            <td><?= $debit['date'] ?></td>
                                        </tr>
                                        <?php endforeach?>
                                        <tfoot>
                                         <tr>
                                            
                                             <td class="text-right"><b>Sub Total:</b></td>
                                            <td><strong><?= $debit_sub ?></strong></td>
                                            <td></td>
                                        </tr>
                                       
                                     </tfoot>                                        
                            	</table>
                              </div>
                            </div>
                        </div>
                    </div>
                  </section>
                </div>
           </div>
     </div>
<script>
  $(function () {

    $('#daterange').daterangepicker(
    {
      ranges: {
        'Today': [moment(), moment()],
        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month': [moment().startOf('month'), moment().endOf('month')],
        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      },
      startDate: moment().subtract(29, 'days'),
      endDate: moment()
    },
    function (start, end) {
      $('#daterange').val(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
    }
    );
  });
  



  $(document).ready(function() {
    var table = $('#example1').DataTable( { 
      "lengthMenu": [[10, 25,50,100,-1], [10 ,25,50,100,"All"]]
    } );

      // for each column in header add a togglevis button in the div
      $("#example1 thead th").each( function ( i ) {
        var name = table.column( i ).header();
        var spanelt = document.createElement( "button" );
        spanelt.innerHTML = name.innerHTML;           
    
        $(spanelt).addClass("colvistoggle");
        $(spanelt).addClass("btn btn-info");
        $(spanelt).attr("colidx",i);    // store the column idx on the button
    
        $(spanelt).on( 'click', function (e) {
        e.preventDefault(); 
        // Get the column API object
        var column = table.column( $(this).attr('colidx') );
        // Toggle the visibility
        column.visible( ! column.visible() );
        if($(spanelt).hasClass('btn-danger'))
          $(spanelt).removeClass('btn-danger');
        else
        $(spanelt).addClass("btn btn-danger");
      });
        $("#colvis").append($(spanelt));
    });
    } );
  
	$(document).ready(function() {
		var table = $('#example2').DataTable( { 
					"lengthMenu": [[10,25, 50,100,-1], [10,25,50, 100,100,"All"]]
				} );
	
			// for each column in header add a togglevis button in the div
			$("#example1 thead th").each( function ( i ) {
				var name = table.column( i ).header();
				var spanelt = document.createElement( "button" );
				spanelt.innerHTML = name.innerHTML;						
		
				$(spanelt).addClass("colvistoggle");
				$(spanelt).addClass("btn btn-primary");
				$(spanelt).attr("colidx",i);		// store the column idx on the button
		
				$(spanelt).on( 'click', function (e) {
				e.preventDefault(); 
				// Get the column API object
				var column = table.column( $(this).attr('colidx') );
				// Toggle the visibility
				column.visible( ! column.visible() );
				if($(spanelt).hasClass('btn-danger'))
					$(spanelt).removeClass('btn-danger');
				else
				$(spanelt).addClass("btn btn-danger");
			});
				$("#colvis1").append($(spanelt));
		});
	} );
    </script>
  </script>

