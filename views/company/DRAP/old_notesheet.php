<div class="col-md-12">
                            <div class="card card-primary card-outline">
                              <div class="card-header">
                                <h3 class="card-title">Notesheet</h3>
                                <div class="card-tools">
                                </div>
                              </div>

                              <!-- /.card-header -->
                              <div class="card-body table-responsive myFixedTableHeader1" style="height: 300px;">
                                <?php $myTable = 'tabledetailhistory'; ?>
                                <table id="<?php echo $myTable; ?>" class="table table-bordered table-striped table-head-fixed" style="width: 100%;">
                                  <thead>
                                  <tr>
                                    <th>S.#</th>
                                    <th class="text-center" width="10%">Date</th>
                                    <th class="text-center" width="20%">From</th>
                                    <th class="text-center" width="20%">Designation</th>
                                    <th class="text-center" width="20%">Forwarded To</th>
                                    <th class="text-center" width="40%">Remarks</th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                    <?php 
                                      $sn = 1;
                                      $sId = 0;
                                      $total = 0;
                                    ?>
                                    <?php
                                    if(!empty($recordsDetailHistory))
                                    {
                                        foreach($recordsDetailHistory as $record)
                                        {
                                          /*if($this->roleId == 26){
                                            if($record->sendQueryToCompany == 0){
                                              continue;
                                            }
                                          }*/
                                    ?>
                                    <tr>
                                      <td class="srNo">
                                        <span><?=$sn?></span>.
                                      </td>
                                      <td class="text-center">
                                        <?php echo $record->dateTime; ?>
                                      </td>
                                      <td class="text-center">
                                        <?php echo $record->fromQ; ?>
                                      </td>
                                      <td>
                                        <?php
                                          if(!empty($historyDesignation))
                                          {
                                            foreach ($historyDesignation as $detail)
                                            {
                                                ?>
                                                <?php if($detail->id == @$record->userId){ echo $detail->userName.' &mdash; '.$detail->designation; } ?>
                                                <?php
                                            }
                                          }
                                        ?>
                                      </td>
                                      <td>
                                        <div class="col-md-12">
                                          <div class="form-group">
                                            <?php $label = 'User'; ?>
                                            <?php $column = 'forwardedTo'; ?>
                                            <select disabled <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2 required" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]">
                                              <option value="">Select <?php echo @$label; ?></option>
                                              <?php
                                                if(!empty($historyDesignation))
                                                {
                                                  foreach ($historyDesignation as $detail)
                                                  {
                                                      ?>
                                                      <option value="<?php echo $detail->id ?>" <?php if($detail->id == @$record->$column && $record->sendQueryToCompany == 0){ echo 'selected'; } ?>><?php echo $detail->userName.' &mdash; '.$detail->designation ?></option>
                                                      <?php
                                                  }
                                                }
                                              ?>
                                            </select>
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="col-md-12">
                                          <div class="form-group">
                                            <?php $column = 'remarks'; ?>
                                            <textarea disabled <?php if($myAction == 'view'){echo 'disabled';}?> id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]" class="form-control required" rows="3"><?php echo @$record->$column; ?></textarea>
                                          </div>
                                        </div>
                                        <?php if($record->sendQueryToCompany == 1){echo '<b>Sent to Applicant</b>';}?>
                                      </td>
                                    </tr>
                                    <?php $sId++ ?>
                                    <?php $sn++ ?>
                                    <?php
                                        }
                                    }
                                    ?>
                                    <tr>
                                      <td class="srNo">
                                        <span><?=$sn?></span>.
                                      </td>
                                      <td class="text-center">
                                        <?php echo date($this->dateTimeFormat); ?>

                                      </td>
                                      <td>
                                        <?php if($this->roleId == 26){ echo 'Applicant'; } else{ echo 'DRAP'; } ?>
                                        <input type="hidden" name="fromQ" value="<?php if($this->roleId == 26){ echo 'Applicant'; } else{ echo 'DRAP'; } ?>">
                                      </td>
                                      <td>
                                        <?php
                                          if(!empty($historyDesignation))
                                          {
                                            foreach ($historyDesignation as $detail)
                                            {
                                                ?>
                                                <?php if($detail->id == $this->userId){ echo $detail->userName.' &mdash; '.$detail->designation; } ?>
                                                <?php
                                            }
                                          }
                                        ?>
                                      </td>
                                      <td>
                                        <div class="col-md-12">
                                          <div class="form-group">
                                            <?php $label = 'User'; ?>
                                            <?php $column = 'forwardedTo'; ?>
                                            <select <?php if($myAction == 'view' || $this->roleId == 26){echo 'disabled';}?> class="form-control select2 allphaserequired" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo @$column; ?>_detail101">
                                              <option value="">Select <?php echo @$label; ?></option>
                                              <?php
                                                if(!empty($historyDesignation))
                                                {
                                                  foreach ($historyDesignation as $detail)
                                                  {
                                                      ?>
                                                      <option value="<?php echo $detail->id ?>"><?php echo $detail->userName.' &mdash; '.$detail->designation ?></option>
                                                      <?php
                                                  }
                                                }
                                              ?>
                                            </select>
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="col-md-12">
                                          <div class="form-group">
                                            <?php $column = 'remarks'; ?>
                                            <textarea required <?php if($myAction == 'view'){echo 'disabled';}?> id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo @$column; ?>_detail101" class="form-control allphaserequired required" rows="3"></textarea>
                                          </div>
                                        </div>
                                        <?php if($this->roleId == '18'){?>
                                        <br>
                                        <div class="col-md-12">
                                          <div class="icheck-primary">
                                            <?php $label = 'Send This Query To The Applicant? (LOQ)'; ?>
                                            <?php $column = 'sendQueryToCompany'; ?>
                                            <input type="hidden" id="<?php echo $column; ?>Hidden" name="<?php echo $column; ?>" value="0">
                                            <input <?php if($myAction == 'view'){echo 'disabled';}?> type="checkbox" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="1">
                                            <label for="<?php echo @$column; ?>"><?php echo $label; ?></label>
                                          </div>
                                        </div>
                                        <?php } ?>
                                      </td>
                                    </tr>
                                  </tbody>
                                  <!-- <tfoot>
                                  <tr>
                                    <th>Rendering engine</th>
                                    <th>Browser</th>
                                    <th>Platform(s)</th>
                                    <th>Engine version</th>
                                    <th>CSS grade</th>
                                  </tr>
                                  </tfoot> -->
                                </table>
                              </div>
                              <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                          </div>