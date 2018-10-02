<!-- BEGIN PAGE HEADER-->
<h1 class="page-title"><?php echo $title; ?></h1>
<div class="page-bar">
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="<?php echo site_url(); ?>">Home</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <?php
        //debug($breadcrumb);
        foreach ($breadcrumb as $key => $value) {
          if(isset($value['url']) && ($value['url'] != '')){
            ?>
            <li>
                <a href="<?php echo site_url($value['url']); ?>"><?php echo $value['name']; ?></a>
                <i class="fa fa-angle-right"></i>
            </li>
            <?php
          }else{
            ?>
            <li>
                <span><?php echo $value['name']; ?></span>
            </li>
            <?php
          }
        }
        ?>
    </ul>
</div>
<!-- END PAGE HEADER-->
