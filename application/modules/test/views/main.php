<ul class="nav nav-tabs tab-nav-right" role="tablist">
                                <li role="presentation" class="active"><a href="#home" data-toggle="tab">HOME</a></li>
                                <li role="presentation"><a href="#profile" data-toggle="tab">PROFILE</a></li>
                                <li role="presentation"><a href="#messages" data-toggle="tab">MESSAGES</a></li>
                                <li role="presentation"><a href="#settings" data-toggle="tab">SETTINGS</a></li>
                            </ul>



     <?php if (isset($_view_purchase) && $_view_purchase)
            $this->load->view($_view_purchase);
            ?>                       