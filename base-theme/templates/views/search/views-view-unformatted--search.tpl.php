<?php

/**
 * @file
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */
?>
<?php foreach ($rows as $id => $row): ?>
  <div class="wrap-tabs-row <?php if ($classes_array[$id]) { print $classes_array[$id];  } ?>"  >
    <?php print $row; ?>
  </div>
<?php endforeach; ?>
