<!-- BEGIN PAGE HEADER-->
<?php
  $launch_id = $launch_schedule_data['launch_id'];
  $launch_name = $launch_arr[$launch_id]['launch_name'];
  $travel_date_db = $launch_schedule_data['date'];
  $travel_date = date('l F j, Y', strtotime($travel_date_db));
?>
<h1 class="page-title">
  <?php echo $launch_name; ?>
  <span class="label label-success"><?php echo $launch_schedule_data['start_from']; ?> To <?php echo $launch_schedule_data['destination_to'];?></span>
  <span class="label label-info"> <?php echo $travel_date; ?> </span>
</h1>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="<?php echo site_url(); ?>">Home</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="<?php echo site_url('/booking/launch'); ?>">Launch</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span>Cabins</span>
        </li>
    </ul>

</div>
<!-- END PAGE HEADER-->

<?php
  $cabin_types = array();
  foreach ($available_cabins as $cabins) {
      $cabin_types[] = $cabins->cabin_type;
  }
  $cabin_types = array_unique($cabin_types);
?>

<div class="row">
<div class="col-md-8">


<div class="row">
<?php foreach ($cabin_types as $cabin_type) { ?>
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject bold uppercase">Available Cabin: <?php echo $cabin_type; ?></span>
                </div>
            </div>
            <div class="portlet-body book_launch_cabin">
              <!-- [ID] => 2
              [launch_id] => 1
              [cabin_number] => S234
              [floor] => 4th
              [cabin_class] => B
              [cabin_info] => Hello world, this is VIP cabin
              [cabin_fare] => 3243
              [discount] => 0
              [cabin_type] => VIP
              [allow_person] => 2
              [is_allow] => 1
              [cabin_status] => Available -->
              <?php
              //debug($available_cabins);
              ?>
              <?php foreach ($available_cabins as $cabins) { ?>
                <?php if($cabin_type == $cabins->cabin_type){ ?>
                  <a data-cabin_id = "<?php echo $cabins->ID; ?>" data-cabin_number = "<?php echo $cabins->cabin_number; ?>" data-cabin_fare = "<?php echo $cabins->cabin_fare; ?>" href="javascript:void(0)" class="icon-btn launch_cabin">
                      <i class="fa fa-bed"></i>
                      <div> <?php echo $cabins->cabin_number; ?> </div>
                      <span class="badge badge-info"> &#x9f3;<?php echo $cabins->cabin_fare; ?> </span>
                  </a>
                  <?php } ?>
              <?php } ?>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
      </div>
  <?php } ?>
</div>

</div>
<div class="col-md-4">
    <div class="portlet light ">
        <div class="portlet-title">
            <div class="caption font-dark">
                <i class="icon-settings font-dark"></i>
                <span class="caption-subject bold uppercase">Selected Cabins</span>
            </div>
        </div>
        <div class="portlet-body">

        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th> Cabin Number </th>
                    <th> Price </th>
                </tr>
            </thead>
            <tbody class="total_cabin_items">

            </tbody>
            <tbody class="total_cabin_price">
                <tr class="hover">
                    <td> Total <span id="total_number_of_selected_cabin" class=""> 0 </span> Cabin</td>
                    <td> &#x9f3;<span id="total_price">0.00</span></td>
                </tr>
            </tbody>
        </table>
          <form id="form_process_request_cabins" action="" method="post">
            <input type="hidden" name="launch_id" value="<?php echo $launch_id; ?>">
            <input type="hidden" name="travel_date" value="<?php echo $travel_date_db; ?>">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
            <input type="submit" name="submit_cabins_request" class="btn green" value="Request To Book" />
            <input type="button" class="btn default" onClick="window.location.reload()" value="Cancle" />
          </form>
        </div>
    </div>
</div>


</div><!-- Eof parent row -->
