<div class="user-wraper uswr-block row user-profile-info">
  <div class="col-md-4 col-sm-3 col-xs-4">
    <?php print strip_tags($fields['field_profile_image']->content,'<img>'); ?>
  </div>
  <div class="col-md-8 col-sm-9 col-xs-8 user-profile-info">
    <h5 class="font-base-r"><?php print strip_tags($fields['field_profile_name']->content).' '.strip_tags($fields['field_profile_surname']->content); ?></h5>
    <p class="ico academic-title"><i class="fa fa-graduation-cap" aria-hidden="true"></i> <span><?php print t('Academic title'); ?></span>: <?php print strip_tags($fields['field_profile_academic_title']->content); ?></p>
    <p class="ico branch"><i class="fa fa-users" aria-hidden="true"></i> <span><?php print t('Branch'); ?></span>: <?php print strip_tags($fields['field_profile_branch']->content); ?></p>
    <div class="bio"><?php print strip_tags($fields['field_profile_bio']->content); ?></div>
    </div>
</div>


