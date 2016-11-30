<?php foreach ($rows as $id => $row): ?>
  <div class="<?php if ($classes_array[$id]):?> <?php print $classes_array[$id];?> <?php endif; ?>">
    <?php print $row; ?>
  </div>
<?php endforeach; ?>
