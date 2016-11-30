<div class="user-wraper row user-profile-info">
  <div class="col-md-3 col-sm-3 col-xs-4">
    <?php print strip_tags($fields['field_profile_image']->content,'<img><a>'); ?>
  </div>
  <div class="col-md-9 col-sm-9 col-xs-8">
    <h5 class="font-base-r"><?php print strip_tags($fields['field_profile_name']->content).' '.strip_tags($fields['field_profile_surname']->content); ?></h5>
    <p><?php print strip_tags($fields['field_profile_bio']->content); ?></p>
  </div>
  <div class="col-md-12 border"></div>
</div>

