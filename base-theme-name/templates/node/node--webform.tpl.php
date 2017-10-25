<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>
  <?php if ($view_mode == 'full'): ?>
    <div class="content"<?php print $content_attributes; ?>>
      <div class="row">
        <div class="col-md-7 col-sm-7">
          <?php print render($content['body']); ?>
        </div>
        <div class="col-md-5 col-sm-5">
          <?php print render($content['webform']); ?>
        </div>
    </div>
  </div>
  <?php else: ?>
    <div class="content"<?php print $content_attributes; ?>>
      <?php print render($content); ?>
    </div>
  <?php endif; ?>
</div>