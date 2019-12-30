

<link href="<?= base_url() ?>assets/admin/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="print" >
<style type="text/css">
	.page-menu .nav-tabs > li > a {
	font-size: 18px;
}
/*.table-radius.table {
	width: 100%;
	background: #fff;
	border-spacing: 0;
	border-radius: 0.25rem;
	margin-bottom: 0;
}
.table-radius.table thead td, .table-radius.table thead th {
    border-top: 0 none !important;
    padding: 20px !important;
}

.table-radius.table tbody td, .table-radius.table tbody th {
    padding: 15px 20px !important;
}
.page-title-box {
	border-radius: 0;
	float: left;
	height: 60px;
	margin-bottom: 0;
	padding: 17px 20px;
}
.page-title-box h3 {
	color: #fff;
	font-size: 20px;
	font-weight: normal;
	margin: 0;
}*/
.page-title {
    color: #1f1f1f;
    font-size: 26px;
    font-weight: 500;
    margin-bottom: 20px;
}
.payslip-title {
	margin-bottom: 20px;
	text-align: center;
	text-decoration: underline;
	text-transform: uppercase;
}
.card-box {
	background-color: #fff;
	border: 1px solid #ededed;
	border-radius: 4px;
	box-shadow: 0 1px 1px 0 rgba(0, 0, 0, 0.2);
	margin-bottom: 30px;
	padding: 20px;
	position: relative;
}

.invoice-details,
.invoice-payment-details > li span {
	float: right;
	text-align: right;
}



</style>











<div class="row ">
						<div class="col-sm-5 col-4">
							<h4 class="page-title">Payslip</h4>
						</div>
						<div class="col-sm-7 col-8 text-right m-b-30">
							<div class="btn-group btn-group-sm">
								<!-- <button class="btn btn-white">CSV</button> -->
								<!-- <button class="btn btn-white" onclick="PrintDiv()">PDF</button> -->
								<button class="btn btn-info" onclick="print()"><i class="fa fa-print fa-lg"></i> Print</button>
							</div>
						</div>
					</div>
					<!-- /Page Title -->
					<div class="print_page">	
					<div class="row">
						<div class="col-md-12 col-sm-12">
							<div class="card-box">
								<h4 class="payslip-title">Payslip for the month of <?= $month  ?> <?= $staff['year'] ?> </h4>
								<div class="row">
									<div class="col-sm-6  col-xs-6 m-b-20">
										<img src="<?= base_url()?>uploads/<?= $seller_info['logo'] ?>" class="inv-logo" alt="">
										<ul class="list-unstyled mb-0">
											<li><?= $seller_info['company_name']   ?></li>
											<li><?= $seller_info['address']   ?></li>
											<li><?= $seller_info['city']   ?>, <?= $seller_info['pincode']   ?></li>
										</ul>
									</div>
									<div class="col-sm-6 col-xs-6 m-b-20">
										<div class="invoice-details">
											<h3 class="text-uppercase">Payslip #<?= $staff['payslip_id'] ?></h3>
											<ul class="list-unstyled">
												<li>Salary Month: <span><?= $month  ?>, <?= $staff['year'] ?></span></li>
											</ul>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12 col-xs-6 m-b-20 col-sm-12">
										<ul class="list-unstyled">
											<li><h5 class="mb-0"><strong><?= $staff['staff_name'] ?></strong></h5></li>
											<!-- <li><span><?= $staff['designation'] ?></span></li> -->
											<li>Employee ID: <?= $staff['employee_code'] ?></li>
											<li>Joining Date: <?= $staff['date_of_joining'] ?></li>
										</ul>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6 col-sm-6 col-xs-6">
										<div>
											<h4 class="m-b-10"><strong>Earnings</strong></h4>
											<table class="table table-bordered">
												<tbody>
													<?php 

													$earning=0;	
													foreach($salary_addition as $row) {

													$earning+=$row['amount'];		
													 ?>
														
													<tr>
														<td><strong><?= $row['payhead_name'] ?> :- </strong> <span class="float-right"><?= $row['amount'] ?>   /-</span></td>
													</tr>
													<?php }   ?>
													<!-- <tr>
														<td><strong>House Rent Allowance (H.R.A.)</strong> <span class="float-right">$55</span></td>
													</tr>
													<tr>
														<td><strong>Conveyance</strong> <span class="float-right">$55</span></td>
													</tr>
													<tr>
														<td><strong>Other Allowance</strong> <span class="float-right">$55</span></td>
													</tr> -->
													<tr>
														<td><strong>Total Earnings</strong> <span class="float-right"><strong><?= $earning ?></strong></span></td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
									<div class="col-md-6 col-sm-6 col-xs-6">
										<div>
											<h4 class="m-b-10"><strong>Deductions</strong></h4>
											<table class="table table-bordered">
												<tbody>
													<?php
													$deduction=0;
													 foreach($salary_deduction as $row) {
													 	$deduction+=$row['amount'];

													  ?>
													<tr>
														<td><strong><?= $row['payhead_name'] ?> :-  </strong> <span class="float-right"><?= $row['amount'] ?>   /-</span></td>
													</tr>
												<?php } ?>
													<!-- <tr>
														<td><strong>Provident Fund</strong> <span class="float-right">$0</span></td>
													</tr>
													<tr>
														<td><strong>ESI</strong> <span class="float-right">$0</span></td>
													</tr>
													<tr>
														<td><strong>Loan</strong> <span class="float-right">$300</span></td>
													</tr> -->
													<tr>
														<td><strong>Total Deductions</strong> <span class="float-right"><strong><?= $deduction ?></strong></span></td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
									<div class="col-md-12 col-sm-12 col-xs-12">
										<p><strong>Net Salary: <?= $staff['gross_salary'] ?>  /-</strong> (<?= $gross_in_words ?> ONLY)</p>
									</div>
								</div>
							</div>
						</div>
					</div>
                </div>

                <script src="<?= base_url() ?>assets/jquery-printme.min.js"></script>
                <script type="text/javascript">
                	function print()
                	{
						$(".print_page").printMe({path:["<?= base_url() ?>assets/admin/plugins/bootstrap/css/bootstrap.min.css","<?= base_url() ?>assets/admin/print.css"]});
                	}

                	
                </script>     