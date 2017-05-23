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
                              <span class="caption-subject font-blue-madison bold uppercase">Edit Cabin</span>
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
                                          $launch_id = $cabin_data['launch_id'];
                                          foreach($launch_arr as $lkey => $lvalue){
                                            $selected = 0;
                                            if($launch_id == $lkey)
                                              $selected = 'selected = "selected" ';
                                            echo '<option '.$selected.' value="'.$lvalue['ID'].'">'.$lvalue['launch_name'].'</option>';
                                          }
                                        ?>
                                      </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Cabin Number</label>
                                        <input type="text" disabled="disabled" name="cabin_number_display" placeholder="D124" class="form-control" value="<?php echo html_escape($cabin_data['cabin_number']); ?>" />
                                        <input type="hidden" name="cabin_number" value="<?php echo html_escape($cabin_data['cabin_number']); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Cabin fare</label>
                                        <div class="input-group input-icon right">
                                            <span class="input-group-addon">
                                                TK
                                            </span>
                                            <input id="cabin_fare" name="cabin_fare" class="input-error form-control" type="text" value="<?php echo html_escape($cabin_data['cabin_fare']); ?>"> </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Number fo Ticket</label>
                                        <input type="text" name="allow_person" placeholder="2" class="form-control" value="<?php echo html_escape($cabin_data['allow_person']); ?>" /> </div>
                                    <div class="form-group">
                                      <label class="control-label">Cabin Type</label>
                                        <select name="cabin_type" id="cabin_type" class="form-control">
                                        <?php
                                          $cabin_type = get_launch_cabin_type();
                                          $cabin_type_value = $cabin_data['cabin_type'];
                                          foreach($cabin_type as $dkey => $dvalue){
                                            $selected = 0;
                                            if($cabin_type_value == $dvalue)
                                              $selected = 'selected = "selected" ';
                                            echo '<option '.$selected.' value="'.$dvalue.'">'.$dvalue.'</option>';
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
                                      $floor = $cabin_data['floor'];
                                      foreach($cabin_floor as $fkey => $fvalue){
                                        $selected = 0;
                                        if($floor == $fkey)
                                          $selected = 'selected = "selected" ';
                                        echo '<option '.$selected.' value="'.$fkey.'">'.$fvalue.'</option>';
                                      }
                                    ?>
                                  </select>
                                </div>
                                <div class="form-group">
                                    <label>Avialable for Booking</label>
                                    <?php $is_allow = $cabin_data['is_allow']; ?>
                                    <div class="mt-radio-inline">
                                        <label class="mt-radio">
                                            <input type="radio" name="is_allow" id="is_allow" value="1" <?php if($is_allow == 1){ ?> checked="" <?php } ?>> Available
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="is_allow" id="is_allow2" value="0" <?php if($is_allow == 0){ ?> checked="" <?php } ?>> Not Available
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Cabin class</label>
                                    <?php $cabin_class = $cabin_data['cabin_class']; ?>
                                    <div class="mt-radio-inline">
                                        <label class="mt-radio">
                                            <input type="radio" name="cabin_class" id="cabin_class_a" value="A" <?php if($cabin_class == 'A'){ ?> checked="" <?php } ?>> Class A
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="cabin_class" id="cabin_class_b" value="B" <?php if($cabin_class == 'B'){ ?> checked="" <?php } ?>> Class B
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="cabin_class" id="cabin_class_c" value="C" <?php if($cabin_class == 'C'){ ?> checked="" <?php } ?>> Class C
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="cabin_class" id="cabin_class_d" value="D" <?php if($cabin_class == 'D'){ ?> checked="" <?php } ?>> Class D
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="cabin_class" id="cabin_class_e" value="E" <?php if($cabin_class == 'E'){ ?> checked="" <?php } ?>> Class E
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                      <label class="control-label">Cabin Info</label>
                                      <textarea class="form-control" placeholder="" name="cabin_info"><?php echo html_escape($cabin_data['cabin_info']); ?></textarea></div>
                                  </div>


                              <div class="col-md-12">
                                  <div class="margin-top-10">
                                      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                      <input type="hidden" name="update_cabin_id" value="<?php echo $cabin_data['ID']; ?>">
                                      <input type="submit" class="btn green" name="update_cabin" value="Update Now">
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
