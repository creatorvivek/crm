

<?php include "header.php" ?>

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="<?= base_url(); ?>uploads/frenchise/<?= $this->session->logo ?> " alt=" "
        class="brand-image img-circle elevation-3" 
        style="opacity: .8" >
        <span class="brand-text font-weight-light" style="font-size: 17px"><?php if(isset($this->session->frenchise_name)){echo $this->session->frenchise_name; }else{echo ''; } ?></span>
    </a>

    <!-- Sidebar <-->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) --> 
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <!-- <img src="<?= base_url('uploads/') . $this->session->profileImage; ?>" class="img-circle elevation-2"
                    alt=""> -->
                </div>
                <div class="info">
                    <a href="<?= base_url()?>profile/adminProfile<?= $this->session->profile_pic ?>" class="d-block"> (<?= $this->session->username ?>)</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                       with font-awesome or any other icon font library -->
                    <!--  <li class="nav-item has-treeview menu-open">
                       <a href="#" class="nav-link active">
                         <i class="nav-icon fa fa-dashboard"></i>
                         <p>
                           Dashboard
                           <i class="right fa fa-angle-left"></i>
                         </p>
                       </a>
                       <ul class="nav nav-treeview"> -->
                        <!-- <li class="nav-item has-treeview">
                            <a href="<?= site_url() ?>admin" class="nav-link <?php if($this->uri->segment(1)=="admin"){ ?> active <?php } ?>">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>DASHBOARD</p>
                            </a>
                        </li> -->


                        <li class="nav-item">
                            <a href="<?= site_url() ?>admin/dashboard" class="nav-link">
                                <i class="fa fa-sign-out nav-icon"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview <?php if($this->uri->segment(1)=="nas"){ ?> menu-open <?php } ?> ">
                            <a href="#" class="nav-link <?php if($this->uri->segment(1)=="nas"){ ?> active <?php } ?>">
                                <i class="nav-icon fa fa-mortar-board"></i>
                                <p>
                                    NAS
                                    <i class="fa fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">

                                <li class="nav-item">
                                    <a href="<?= site_url() ?>nas/add_nas" class="nav-link">
                                        <i class="nav-icon fa fa-th"></i>
                                        <p>
                                            ADD NAS
                                            
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= site_url() ?>nas/nas_list" class="nav-link">
                                        <i class="nav-icon fa fa-th"></i>
                                        <p>
                                           NAS LIST

                                       </p>
                                   </a>
                               </li>
                           </ul>
                       </li>     
               
                <li class="nav-item has-treeview <?php if($this->uri->segment(1)=="frenchise"){ ?> menu-open <?php } ?> ">
                    <a href="#" class="nav-link <?php if($this->uri->segment(1)=="frenchise"){ ?> active <?php } ?>">
                        <i class="nav-icon fa fa-mortar-board"></i>
                        <p>
                            FRENCHISE
                            <i class="fa fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                        <a href="<?= site_url() ?>frenchise/add_frenchise" class="nav-link">
                            <i class="fa fa-sign-out nav-icon"></i>
                            <p>ADD FRENCHISE</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= site_url() ?>frenchise/frenchise_list" class="nav-link">
                            <i class="fa fa-sign-out nav-icon"></i>
                            <p>FRENCHISE LIST</p>
                        </a>
                    </li>
                       
                   </ul>
               </li>     
                       
                  
        
                     <!-- <li class="nav-item">
                        <a href="<?= site_url() ?>crn/all_user_list" class="nav-link">
                            <i class="fa fa-sign-out nav-icon"></i>
                            <p>USER LIST</p>
                        </a>
                    </li> -->
                    
                    <!-- <li class="nav-item">
                        <a href="<?= site_url() ?>crn/add_crn" class="nav-link">
                            <i class="fa fa-sign-out nav-icon"></i>
                            <p>ADD CRN</p>
                        </a>
                    </li> -->
                   
                    <li class="nav-item">
                        <a href="<?= site_url() ?>setting/frenchise_setting" class="nav-link">
                            <i class="fa fa-sign-out nav-icon"></i>
                            <p>PROFILE SETTING</p>
                        </a>
                    </li>
                    
                   
                  
               
              <!--  <li class="nav-item has-treeview <?php if($this->uri->segment(1)=="reports"){ ?> menu-open <?php } ?> ">
                <a href="#" class="nav-link <?php if($this->uri->segment(1)=="reports"){ ?> active <?php } ?>">
                    <i class="nav-icon fa fa-mortar-board"></i>
                    <p>
                        REPORTS
                        <i class="fa fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">

                    <li class="nav-item">
                        <a href="<?= site_url() ?>reports/invoice_report" class="nav-link">
                            <i class="nav-icon fa fa-th"></i>
                            <p>
                               INVOICE REPORTS

                           </p>
                       </a>
                   </li>
                   <li class="nav-item">
                    <a href="<?= site_url() ?>reports/debit_credit_report" class="nav-link">
                        <i class="nav-icon fa fa-th"></i>
                        <p>
                           DEBIT CREDIT REPORTS

                       </p>
                   </a>
               </li>
               <li class="nav-item">
                <a href="<?= site_url() ?>reports/user_ledger_report" class="nav-link">
                    <i class="nav-icon fa fa-th"></i>
                    <p>
                       USER LEDGER REPORTS

                   </p>
               </a>
           </li>
            <li class="nav-item">
                <a href="<?= site_url() ?>reports/reciept_report" class="nav-link">
                    <i class="nav-icon fa fa-th"></i>
                    <p>
                       RECIEPT REPORTS

                   </p>
               </a>
           </li>
       </ul>
   </li>      -->
  
<!-- <li class="nav-item">
    <a href="<?= base_url() ?>log/user_audit" class="nav-link">
        <i class="fa fa-sign-out nav-icon"></i>
        <p>User Audit</p>
    </a>
</li> -->

<li class="nav-item">
    <a href="<?= site_url() ?>login/logout" class="nav-link">
        <i class="fa fa-sign-out nav-icon"></i>
        <p>LOGOUT</p>
    </a>
</li>

</ul>

</nav>
</div>
<!-- </div> -->
<!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <!-- <h2><?= ucfirst($this->uri->segment(1)) ?></h2> -->
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url()?>admin">Home</a></li>
              <li class="breadcrumb-item active"><?= $this->uri->segment(1) ?></li>
              <!-- <li class="breadcrumb-item active"><?= $this->uri->segment(2) ?></li> -->
          </ol>
      </div>
  </div>
</div><!-- /.container-fluid -->
</section>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        <?php if (isset($this->session->alerts)) {
            $alert = $this->session->alerts; ?>
            <div class="alert alert-<?= $this->session->alerts['severity'] ?> alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fa fa-check"></i> <?= $this->session->alerts['title'] ?>!</h5>
                <?= isset($this->session->alerts['description'])?$this->session->alerts['description']:'' ?>
            </div>
            <?php $this->session->alerts = null; } ?>


            <?php if (isset($_view) && $_view)
            $this->load->view($_view);
            ?>


            <!-- </div> -->
            <!-- /.col -->
            <!-- </div> -->
            <!-- /.row -->
        </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Control Sidebar -->

<!-- /.control-sidebar -->

<!-- Main Footer -->

<script>

  $('.mt-2 ul li').find('a').each(function () {
    if (document.location.href == $(this).attr('href')) {
        $(this).parents().addClass("active");
        $(this).addClass("active");
                // add class as you need ul or li or a 
            }
        });
    </script>


    <?php include "footer.php"; ?>
