<script src="http://maps.googleapis.com/maps/api/js?sensor=true" type="text/javascript"></script>
<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>
  <?php if ($view_mode == 'full'): ?>
    <div class="content"<?php print $content_attributes; ?>>
      <div class="row">
        <div class="col-md-7 col-sm-7">
          <div id="maps-wraper"></div>          
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
<?php
drupal_add_js(drupal_get_path('theme', $GLOBALS['theme'] ).'/js/maps-google.js' , array('scope' => 'footer',));
drupal_add_js("jQuery(document).ready(function () { initializeGM('maps-wraper',52.1946316, 21.0214938, 17 , 'Centrum Przeprowadzki - Warszawa', '<p>ul. Żorska 56 (Agata Meble), ul. Malczewskiego 16,<br />05-091 Ząbki k W-wy<p>tel.: <strong>601 338 516</strong></p>'); });",
  array('type' => 'inline', 'scope' => 'footer')
);
?>