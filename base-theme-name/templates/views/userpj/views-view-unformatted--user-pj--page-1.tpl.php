<?php
$headerTmp 	= '';
$pregFilter = '/<div class="item-gr">(.*?)<\/div>/';
$labelID	= 0;
?>
<?php foreach ($rows as $id => $row): ?>
  <?php
  if (strstr($row, '<div class="item-gr">')) {
    $titleMatches = array();
    preg_match_all($pregFilter, $row, $titleMatches);
    $row = preg_replace($pregFilter, '', $row);
  }
  ?>
  <?php if ($headerTmp != $titleMatches[1][0]): ?>
    <?php $headerTmp = $titleMatches[1][0]; $labelID++; ?>
    <?php if ($labelID == 1) :?>
      <h3 class="userpj-head font-base-r clearfix"><?php print t($headerTmp); ?></h3><div class="row">
    <?php elseif ($labelID == 2):?>
      </div><h3 class="userpj-head font-base-r clearfix"><?php print t($headerTmp); ?></h3><div class="row">
    <?php elseif (count($rows) == $id):?>
      </div>
    <?php endif;?>
  <?php endif; ?>
  <div class="col-md-4 col-sm-4<?php if ($classes_array[$id]):?> <?php print $classes_array[$id];?> <?php endif; ?>">
    <?php print $row; ?>
  </div>
<?php endforeach; ?>