<div class="row clearfix">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>ADD TARGET</h2>
                            
                        </div>
                        <div class="body">
                            <form id="form_validation" method="POST"  action="<?= base_url() ?>setting/target_setting_update">
                                <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <select class="form-control" name="duration" required=''>
                                                <option value="">--Select Target Duration--</option>
                                                <option value="1">This Financial Year (<?= date('Y')  ?>)</option>
                                                <option value="2">This Month (<?= date('M') ?>)</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="target" required="" aria-required="true" onkeypress="return isNumberKey(event)" >
                                        <label class="form-label">SELL TARGET</label>
                                    </div>
                                </div>
                                 <div class="form-group form-float">
                                    <button type="submit">submit</button>
                                 </div>
                            </form>
                        </div>
                    </div>
                </div>
            
                        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                    <div class="card">
                        <div class="header">
                            <h2>TASK INFO</h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="progress">
                                                    <!-- <div class="progress-bar bg-blue" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"></div> -->
                                                    <div class="progress-bar bg-blue progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 70%">22 </div>
                                                </div>
                        <?php $count=1 ; ?>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table dashboard-task-infos">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Target</th>
                                            <th>Achive</th>
                                            <!-- <th>Manager</th>
                                            <th>Progress</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($target as $row)
                                        { ?>
                                        <tr>
                                            <td><?= $count++ ?></td>
                                            <td><?= $row['start_date'] ?></td>
                                           
                                            <td><?= $row['end_date'] ?></td>
                                            <td><?= $row['target'] ?></td>
                                            <td >
                                                <div class="progress">
                                                    <!-- <div class="progress-bar bg-blue" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"></div> -->
                                                    <div class="progress-bar bg-blue progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 70%">22 </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                       
                                       
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
