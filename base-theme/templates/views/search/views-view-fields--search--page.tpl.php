<?php global $base_url; ?>
<div class="counter tab-item font-base-r"><?php print strip_tags($fields['counter']->content); ?>.</div>
<div class="content tab-item">
  <h5 class="font-base-r"><a href="<?php print drupal_get_path_alias('node/'.strip_tags($fields['nid']->content)); ?>"><?php print strip_tags($fields['title']->content); ?></a></h5>
  <p><?php print strip_tags($fields['body']->content); ?></p>
  <a class="url-adress" href="<?php print $base_url.base_path().drupal_get_path_alias('node/'.strip_tags($fields['nid']->content)); ?>"><?php print $base_url.base_path().drupal_get_path_alias('node/'.strip_tags($fields['nid']->content)); ?></a>
</div>

