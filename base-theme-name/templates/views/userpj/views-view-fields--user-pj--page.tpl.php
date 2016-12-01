<div class="user-wraper uswr-page user-profile-info">
  <div class="row">
    <div class="col-md-3 col-sm-3 col-xs-4">
      <?php print strip_tags($fields['field_profile_image']->content,'<img>'); ?>
    </div>
    <div class="col-md-9 col-sm-9 col-xs-8">
      <h5 class="font-base-r"><?php print strip_tags($fields['field_profile_name']->content).' '.strip_tags($fields['field_profile_surname']->content); ?></h5>
      <p class="ico academic-title"><i class="fa fa-graduation-cap" aria-hidden="true"></i> <span><?php print t('Academic title'); ?></span>: <?php print strip_tags($fields['field_profile_academic_title']->content); ?></p>
      <p class="ico branch"><i class="fa fa-users" aria-hidden="true"></i> <span><?php print t('Branch'); ?></span>: <?php print strip_tags($fields['field_profile_branch']->content); ?></p>
    </div>
  </div>
  <p class="bio"><?php print strip_tags($fields['field_profile_bio']->content); ?></p>
  <div class="item-gr"><?php print strip_tags($fields['rid']->content); ?></div>
</div>

