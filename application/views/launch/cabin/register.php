<?php
require_once(FCPATH.'/application/views/breadcrumb.php');
require_once(FCPATH.'/application/views/success-error-message.php');
?>
<div class="row">
    <div class="col-md-12">
      <!-- BEGIN PROFILE CONTENT -->
      <div class="profile-content">
          <div class="row">
              <div class="col-md-12">
                  <div class="portlet light ">
                      <div class="portlet-title tabbable-line">
                          <div class="caption caption-md">
                              <i class="icon-globe theme-font hide"></i>
                              <span class="caption-subject font-blue-madison bold uppercase">Add New Cabin</span>
                          </div>
                      </div>
                      <div class="portlet-body">
                          <form action="" method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                      <label class="control-label">Select Launch</label>
                                        <select name="launch_id" id="launch_id" class="form-control select2me">
                                        <?php
                                          foreach($launch_arr as $lkey => $lvalue){
                                            echo '<option value="'.$lvalue['ID'].'">'.$lvalue['launch_name'].'</option>';
                                          }
                                        ?>
                                      </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Cabin Number</label>
                                        <input type="text" name="cabin_number" placeholder="D124" class="form-control" value="<?php echo set_value('cabin_number'); ?>" /> </div>
                                    <div class="form-group">
                                        <label>Cabin fare</label>
                                        <div class="input-group input-icon right">
                                            <span class="input-group-addon">
                                                TK
                                            </span>
                                            <input id="cabin_fare" name="cabin_fare" class="input-error form-control" type="text" value="<?php echo set_value('cabin_fare'); ?>"> </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Number fo Ticket</label>
                                        <input type="text" name="allow_person" placeholder="2" class="form-control" value="<?php echo set_value('allow_person'); ?>" /> </div>
                                    <div class="form-group">
                                      <label class="control-label">Cabin Type</label>
                                        <select name="cabin_type" id="cabin_type" class="form-control">
                                        <?php
                                          $cabin_type = get_launch_cabin_type();
                                          foreach($cabin_type as $dkey => $dvalue){
                                            echo '<option value="'.$dvalue.'">'.$dvalue.'</option>';
                                          }
                                        ?>
                                      </select>
                                    </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label class="control-label">Floor</label>
                                    <select name="floor" id="floor" class="form-control">
                                    <?php
                                      $cabin_floor = get_launch_cabin_floor();
                                      foreach($cabin_floor as $fkey => $fvalue){
                                        echo '<option value="'.$fkey.'">'.$fvalue.'</option>';
                                      }
                                    ?>
                                  </select>
                                </div>
                                <div class="form-group">
                                    <label>Avialable for Booking</label>
                                    <div class="mt-radio-inline">
                                        <label class="mt-radio">
                                            <input type="radio" name="is_allow" id="is_allow" value="1" checked=""> Available
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="is_allow" id="is_allow2" value="0" checked=""> Not Available
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Cabin class</label>
                                    <div class="mt-radio-inline">
                                        <label class="mt-radio">
                                            <input type="radio" name="cabin_class" id="cabin_class_a" value="A" checked=""> Class A
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="cabin_class" id="cabin_class_b" value="B"> Class B
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="cabin_class" id="cabin_class_c" value="C"> Class C
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="cabin_class" id="cabin_class_d" value="D"> Class D
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="cabin_class" id="cabin_class_e" value="E"> Class E
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                      <label class="control-label">Cabin Info</label>
                                      <textarea class="form-control" placeholder="" name="cabin_info"><?php echo set_value('cabin_info'); ?></textarea></div>
                                  </div>


                              <div class="col-md-12">
                                  <div class="margin-top-10">
                                      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                      <input type="submit" class="btn green" name="register_new_cabin" value="Add Now">
                                  </div>
                              </div>
                            </div>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <!-- END PROFILE CONTENT -->

  </div>
</div>
