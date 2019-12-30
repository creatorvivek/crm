

<?= include "header.php" ?>

<section class="content">
        <div class="container-fluid">
           <!--  <div class="col-md-4 float-right">
            <ol class="breadcrumb breadcrumb-bg-teal">
                                <li><a href="javascript:void(0);">Home</a></li>
                                <li><a href="javascript:void(0);">Library</a></li>
                                <li><a href="javascript:void(0);">Data</a></li>
                                <li class="active">File</li>
                            </ol>
                        </div> -->

        	 <?php if (isset($this->session->alerts)) {
            $alert = $this->session->alerts; ?>
            <div class="alert alert-<?= $this->session->alerts['severity'] ?> alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true" aria-label="Close">×</button>
                <h5><i class="material-icons">done</i> <?= $this->session->alerts['title'] ?>!</h5>
                <?= isset($this->session->alerts['description'])?$this->session->alerts['description']:'' ?>
            </div>
            <?php $this->session->alerts = null; } ?>
<?php if (isset($_view) && $_view)
            $this->load->view($_view);
            ?>
    
</div>
</section>
   <?php include "footer.php"; ?>
