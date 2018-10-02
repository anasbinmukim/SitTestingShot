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
                              <span class="caption-subject font-blue-madison bold uppercase">Add New Route</span>
                          </div>
                      </div>
                      <div class="portlet-body">
                          <form action="" method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Route</label>
                                        <input type="text" name="route" placeholder="Dhaka To Barishal" class="form-control" value="<?php echo set_value('route'); ?>" /> </div>
                                    <div class="form-group">
                                      <label class="control-label">Place Start/End</label>
                                        <select name="place_1" id="place_1" class="form-control select2me">
                                        <?php
                                          $via_place_arr = get_via_places_arr();
                                          foreach($via_place_arr as $vpkey => $vpvalue){
                                            echo '<option value="'.$vpkey.'">'.$vpvalue['place_name'].'</option>';
                                          }
                                        ?>
                                      </select>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label">Place Start/End</label>
                                        <select name="place_2" id="place_2" class="form-control select2me">
                                        <?php
                                          $via_place_arr = get_via_places_arr();
                                          foreach($via_place_arr as $vpkey => $vpvalue){
                                            echo '<option value="'.$vpkey.'">'.$vpvalue['place_name'].'</option>';
                                          }
                                        ?>
                                      </select>
                                    </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group select2-bootstrap-prepend">
                                    <label class="control-label">Route Via Places</label>
                                    <select name="route_via_places[]" id="route_via_places" class="form-control select2me"  multiple>
                                      <?php
                                        $via_place_arr = get_via_places_arr();
                                        foreach($via_place_arr as $vpkey => $vpvalue){
                                          echo '<option value="'.$vpvalue['place_name'].'">'.$vpvalue['place_name'].'</option>';
                                        }
                                      ?>
                                    </select>
                                  </div>
                              </div>


                              <div class="col-md-12">
                                  <div class="margin-top-10">
                                      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                      <input type="submit" class="btn green" name="register_new_route" value="Register Now">
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
