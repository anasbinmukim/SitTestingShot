<ul class="nav nav-tabs">
    <li <?php if($profile_section == 'personal-info'){ ?>class="active" <?php } ?>>
        <a href="<?php echo site_url('/profile/manage/personal-info'); ?>">Personal Info</a>
    </li>
    <li <?php if($profile_section == 'photo'){ ?>class="active" <?php } ?>>
        <a href="<?php echo site_url('/profile/manage/photo'); ?>">Profile Photo</a>
    </li>
    <li <?php if($profile_section == 'password'){ ?>class="active" <?php } ?>>
        <a href="<?php echo site_url('/profile/manage/password'); ?>">Update Password</a>
    </li>
    <li <?php if($profile_section == 'settings'){ ?>class="active" <?php } ?>>
        <a href="<?php echo site_url('/profile/manage/settings'); ?>">Privacy Settings</a>
    </li>
</ul>
