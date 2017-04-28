<div class="page-content-wrapper">
    <!-- END PAGE HEAD-->
    <!-- BEGIN PAGE CONTENT BODY -->
    <div class="page-content">
        <div class="container">
            <!-- BEGIN PAGE BREADCRUMBS -->
            <ul class="page-breadcrumb breadcrumb">
                <li>
                    <a href="<?php echo site_url();?>">Home</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="<?php echo site_url('admin/users');?>">Users</a>
                    <i class="fa fa-circle"></i>
                </li>    
                <li>   
                    <span><?php echo ($action == 'add')?"New":"Edit"; ?></span>
                </li>
            </ul>
            <!-- END PAGE BREADCRUMBS -->
            
            

            <div class="page-content-inner">
            
            	<div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN VALIDATION STATES-->
                            <div class="portlet light portlet-fit portlet-form bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <span class="caption-subject font-dark sbold uppercase"><?php echo ($action == 'add')?"New":"Edit"; ?> User</span>
                                    </div>
                                    
                                </div>
                                <div class="portlet-body">
                                    <!-- BEGIN FORM-->
                                    <form  class="form-horizontal" enctype="multipart/form-data" method="post">
                                        <div class="form-body">
                                        	
                                            <div class="form-group <?php echo form_error('group_id')?'has-error':'';?>">
                                            	<label class="col-md-3 control-label" for="group_id">User Type<span class="required" aria-required="true"> * </span></label>
                                                <div class="col-md-5">
                                                    <select class="form-control" id="group_id" name="group_id">
                                                        <option value="">Select</option>
                                                        <option value="1" <?php echo ($row['group_id']==1)?"selected":''; ?>>Administrator</option>
                                                        <option value="2" <?php echo ($row['group_id']==2)?"selected":''; ?>>Host</option>
                                                        <option value="3" <?php echo ($row['group_id']==3)?"selected":''; ?>>Sponsor</option>
                                                    </select>
                                                    
                                                    <?php echo form_error('group_id');?>
                                                </div>
                                        	</div>
                                            
                                            <div class="form-group <?php echo form_error('email')?'has-error':'';?>">
                                        <label class="col-md-3 control-label" for="email">Email<span class="required" aria-required="true"> * </span></label>
                                        <div class="col-md-5">
                                            <input type="text" name="email" placeholder="Email" id="email" class="form-control" value="<?php echo $row['email'];?>"> 
                                            <?php echo form_error('email');?>
                                        </div>
                                    </div>
                                    <div class="form-group <?php echo form_error('first_name')?'has-error':'';?>">
                                        <label class="col-md-3 control-label" for="first_name">First Name<span class="required opt first hidden" aria-required="true"> * </span></label>
                                        <div class="col-md-5">
                                            <input type="text" name="first_name" placeholder="First Name" id="first_name" class="form-control" value="<?php echo $row['first_name'];?>"> 
                                            <?php echo form_error('first_name');?>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group <?php echo form_error('last_name')?'has-error':'';?>">
                                        <label class="col-md-3 control-label" for="last_name">Last Name<span class="required" aria-required="true"> * </span></label>
                                        <div class="col-md-5">
                                            <input type="text" name="last_name" placeholder="Last Name" id="last_name" class="form-control" value="<?php echo $row['last_name'];?>">
                                            <?php echo form_error('last_name');?>
                                        </div>
                                    </div> 
                                    
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="password">Password</label>
                                        <div class="col-md-5">
                                            <input type="password" name="password" readonly="readonly" placeholder="Password" id="password" class="form-control" value="<?php echo $row['password'];?>">
                                           
                                        </div>
                                    </div> 
                                    
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="phone">Phone</label>
                                        <div class="col-md-5">
                                            <input type="text" name="phone" placeholder="Phone" id="phone" class="form-control" value="<?php echo $row['phone'];?>">
                                        </div>
                                    </div> 
                                    
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="company">Company</label>
                                        <div class="col-md-5">
                                            <input type="text" name="company" placeholder="Company" id="company" class="form-control" value="<?php echo $row['company'];?>">
                                        </div>
                                    </div> 

                                    <div class="form-group <?php echo form_error('address')?'has-error':'';?>">
                                        <label class="col-md-3 control-label" for="address">Address<span class="required opt hidden" aria-required="true"> * </span></label>
                                        <div class="col-md-5">
                                            <input type="text" name="address" placeholder="Address" id="address" class="form-control" value="<?php echo $row['address'];?>">
                                            <?php echo form_error('address');?>
                                        </div>
                                    </div> 
                                    
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="note">Notes</label>
                                        <div class="col-md-5">
                                        	<textarea name="note" placeholder="Notes" id="note" class="form-control"><?php echo $row['note'];?></textarea>
                                          
                                        </div>
                                    </div> 
                                    
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Is Active</label>
                                        <div class="checkbox-list col-md-5">
                                            <label class="checkbox-inline" style="margin-left:5%">
                                                <input type="checkbox" id="is_active" name="is_active" value="1" <?php echo ($row['is_active'] == 1)?'checked="checked"':'';?> ></label>
                                            
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="Profile Image">Profile Image</label>
                                        <div class="col-md-5">
                                        	<?php if($row['image'] && file_exists( getcwd().'/files/profile/'.$row['id'].'/'.$row['image'] ) ){?>
                                            	<diV><img src="<?php echo base_url( 'files/profile/'.$row['id'].'/'.$row['image'] );?>" width="100" /><br /><br /></diV>
                                            <?php }?>
                                            <input type="file" name="image" id="image"> 
                                        </div>
                                    </div>

                                    
                                            
                                        </div>
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-offset-3 col-md-9">
                                                    <input class="btn red" name="invite" type="submit" value="Save" />
                                            		<input class="btn red" name="invite_close" type="submit" value="Save & Close" />
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- END FORM-->
                                </div>
                            </div>
                            <!-- END VALIDATION STATES-->
                        </div>
                    </div>
                
            </div>
            <div class="clearfix"></div>


        </div>
    </div>
    <!-- END PAGE CONTENT BODY -->
    <!-- END CONTENT BODY -->
</div>

        