 <div class="row clearfix">
    <div class="col-xs-12 col-sm-3">
        <div class="card profile-card">
            <div class="profile-header">&nbsp;</div>
            <div class="profile-body">
                <!-- <div class="image-area">
                    <img src="../../images/user-lg.jpg" alt="AdminBSB - Profile Image" />
                </div> -->
                <div class="content-area">
                    <h3><?= $staff_details['name'] ?></h3>
                    <p><?= $staff_details['designation'] ?></p>
                    <!-- <p>Administrator</p> -->
                </div>
            </div>
            <div class="profile-footer">
                <ul>
                    <li>
                        <span>Employee Id</span>
                        <span><?= $staff_details['employee_code']  ?></span>
                    </li>
                    <li>
                        <span>Mobile</span>
                        <span><?= $staff_details['mobile']  ?></span>
                    </li>
                    <li>
                        <span>Email</span>
                        <span><?= $staff_details['email']  ?></span>
                    </li>
                    <li>
                        <span>Gender</span>
                        <span><?= $staff_details['gender']  ?></span>
                    </li>
                    <li>
                        <span>Date of Birth</span>
                        <span><?= $staff_details['dob']  ?></span>
                    </li>
                    <li>
                        <span>Date of Joining</span>
                        <span><?= $staff_details['date_of_joining']  ?></span>
                    </li>
                    <li>
                        <span>Department</span>
                        <span><?= $staff_details['department']  ?></span>
                    </li>
                    <li>
                        <span>Qualfication</span>
                        <span><?= $staff_details['qualification']  ?></span>
                    </li>
                    <li>
                        <span>Experience</span>
                        <span><?= $staff_details['experience']  ?></span>
                    </li>
                </ul>
                <!-- <button class="btn btn-primary btn-lg waves-effect btn-block">FOLLOW</button> -->
            </div>
        </div>

        <!-- <div class="card card-about-me">
            <div class="header">
                <h2>ABOUT ME</h2>
            </div>
            <div class="body">
                <ul>
                    <li>
                        <div class="title">
                            <i class="material-icons">library_books</i>
                            Education
                        </div>
                        <div class="content">
                            B.S. in Computer Science from the University of Tennessee at Knoxville
                        </div>
                    </li>
                    <li>
                        <div class="title">
                            <i class="material-icons">location_on</i>
                            Location
                        </div>
                        <div class="content">
                            Malibu, California
                        </div>
                    </li>
                    <li>
                        <div class="title">
                            <i class="material-icons">edit</i>
                            Skills
                        </div>
                        <div class="content">
                            <span class="label bg-red">UI Design</span>
                            <span class="label bg-teal">JavaScript</span>
                            <span class="label bg-blue">PHP</span>
                            <span class="label bg-amber">Node.js</span>
                        </div>
                    </li>
                    <li>
                        <div class="title">
                            <i class="material-icons">notes</i>
                            Description
                        </div>
                        <div class="content">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.
                        </div>
                    </li>
                </ul>
            </div>
        </div> -->
    </div>
    <div class="col-xs-12 col-sm-9">
        <div class="card">
            <div class="body">
                <div>
                    <ul class="nav nav-tabs" role="tablist">
                        <!-- <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Home</a></li> -->
                        <li role="presentation"><a href="#profile_settings" class="active" aria-controls="settings" role="tab" data-toggle="tab">Salary Details</a></li>
                        <li role="presentation"><a href="#change_password_settings" aria-controls="settings" role="tab" data-toggle="tab">leave approvel</a></li>
                    </ul>

                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade in " id="home">
                    

                           
                        </div>
                        <div role="tabpanel" class="tab-pane fade in active" id="profile_settings">
                            <div class="table-responsive">
                                <table class="table table-bordered  table-hover js-basic-example dataTable" id="invoiceTable">
                                  <thead>
                                    <tr>

                                      <th>name</th>
                                      <th>Gross Salary</th>
                                      <th>Year</th>
                                      <th>Month</th>
                                      <th>Issue date</th>

                                      <th>Actions</th>
                                  </tr>
                              </thead>
                              <tbody>

                                  <?php 



                                  foreach ($salary as $row) { 



                                    ?>
                                    <tr>


                                       <td><?= $row['name'] ?></td>
                                       <td><?= $row['gross_salary'] ?></td>
                                       <td><?= $row['year'] ?></td>
                                       <td><?= $row['month'] ?></td>
                                       <td><?= $row['created_at'] ?></td>
                                       <td> 

                                          <div class="btn-group" role="group">

                                            <!-- <a href="<?= base_url() ?>crn/update/<?= $row['id'] ?>" class="btn btn-primary waves-effect" data-toggle="tooltip" data-placement="top" title="edit"><i class="material-icons">create</i></a> -->
                                            <a href="<?= base_url() ?>payroll/salary_slip/<?= $row['id'] ?>" class="btn btn-primary waves-effect" data-toggle="tooltip" data-placement="top" title="Salary slip"><i class="material-icons">explore</i></a>
                                            <!--  <a href="<?= base_url() ?>sms/index?mobile=<?= $row['mobile'] ?>" class="btn btn-info waves-effect" data-toggle="tooltip" data-placement="top" title="send sms"><i class="material-icons">textsms</i></a> -->

                                        </div>


                                    </td>




                                </tr>
                            <?php } ?>
                        </tbody>

                    </table>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane fade in" id="change_password_settings">
               <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                             Leave Application
                             <!-- STOCK LIST -->
                         </h2>

                     </div>
                     <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="invoiceTable">
                                <thead>
                                    <tr>

                                        <th>From</th>
                                        <th>To</th>
                                        <th>leave Category</th>
                                        <th>status</th>
                                        <th>reason</th>

                                        <th>created at</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    <?php 



                                    foreach ($leave_application as $row) { 



                                      ?>
                                      <tr>


                                         <td><?= $row['start_date'] ?></td>
                                         <td><?= $row['end_date'] ?></td>
                                         <td><?= $row['category_name'] ?></td>
                                         <!-- <td><?=$row['created_at'] ?></td> -->
                                         <td><span class="label <?php if($row['status']==0){
                                          echo 'label-danger';
                                          $status='pending';

                                          } else if($row['status']==1){
                                            echo 'label-success';
                                            $status='Approved';
                                            } else{
                                                echo 'label-danger';
                                                $status='rejected';
                                            }
                                            ?>"><?= $status ?></span></td>
                                            <td><?= $row['reason'] ?></td>
                                            <td class="date"> <?=  date('j F Y ', strtotime( $row['created_at']) ) ; ?><br>
                                                <?=  date('h :i a', strtotime($row['created_at']) ) ; ?></td>
                                                <!-- <td><select><option value="">--select--</option><option value="1">Approved</option><option value="2">reject</option></select></td> -->

                                            </tr>
                                        <?php } ?>
                                    </tbody>

                                </table>
                            </div>


                        </div>
                    </div>
                    <!-- end leave -->
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<script src="<?= base_url() ?>assets/admin/plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/admin/js/pages/tables/jquery-datatable.js"></script>