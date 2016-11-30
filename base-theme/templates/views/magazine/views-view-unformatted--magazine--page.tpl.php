<div class="row">
<?php foreach ($rows as $id => $row): ?>
  <div class="col-md-4 col-sm-4<?php if ($classes_array[$id]):?> <?php print $classes_array[$id];?> <?php endif; ?>">
    <?php print $row; ?>
  </div>
<?php endforeach; ?>
</div>
