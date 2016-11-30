<?php

/**
 * @file
 * Default theme implementation to display a node.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: An array of node items. Use render($content) to print them all,
 *   or print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $user_picture: The node author's picture from user-picture.tpl.php.
 * - $date: Formatted creation date. Preprocess functions can reformat it by
 *   calling format_date() with the desired parameters on the $created variable.
 * - $name: Themed username of node author output from theme_username().
 * - $node_url: Direct URL of the current node.
 * - $display_submitted: Whether submission information should be displayed.
 * - $submitted: Submission information created from $name and $date during
 *   template_preprocess_node().
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - node: The current template type; for example, "theming hook".
 *   - node-[type]: The current node type. For example, if the node is a
 *     "Blog entry" it would result in "node-blog". Note that the machine
 *     name will often be in a short form of the human readable label.
 *   - node-teaser: Nodes in teaser form.
 *   - node-preview: Nodes in preview mode.
 *   The following are controlled through the node publishing options.
 *   - node-promoted: Nodes promoted to the front page.
 *   - node-sticky: Nodes ordered above other non-sticky nodes in teaser
 *     listings.
 *   - node-unpublished: Unpublished nodes visible only to administrators.
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type; for example, story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Node status variables:
 * - $view_mode: View mode; for example, "full", "teaser".
 * - $teaser: Flag for the teaser state (shortcut for $view_mode == 'teaser').
 * - $page: Flag for the full page state.
 * - $promote: Flag for front page promotion state.
 * - $sticky: Flags for sticky post setting.
 * - $status: Flag for published status.
 * - $comment: State of comment settings for the node.
 * - $readmore: Flags true if the teaser content of the node cannot hold the
 *   main body content.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * Field variables: for each field instance attached to the node a corresponding
 * variable is defined; for example, $node->body becomes $body. When needing to
 * access a field's raw values, developers/themers are strongly encouraged to
 * use these variables. Otherwise they will have to explicitly specify the
 * desired field language; for example, $node->body['en'], thus overriding any
 * language negotiation rule that was previously applied.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 * @see template_process()
 *
 * @ingroup themeable
 */
?>
<?php
global $language;
$_url_array = array(
  'pl' => 'aktualnosci',
  'en' => 'en/news',
  'ru' => 'ru/news',
);
?>
<div id="node-<?php print $node->nid; ?>" class="<?php print $classes.' node-'.$view_mode; ?> clearfix "<?php print $attributes; ?>>
  <?php if ($view_mode == 'teaser') : ?>
    <div class="row">
      <div class="col-md-2 col-sm-2">
        <div class="created font-base-r">
          <p class="mounth"><?php print t(date('M',$node->created))?></p>
          <p class="day"><?php print date('d',$node->created)?></p>
        </div>
      </div>
      <div class="box-content col-md-10 col-sm-10">
        <h3 class="font-base-r"><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h3>
        <?php print render($content['field_image']);  ?>
        <?php print render($content['body']);  ?>
      </div>
    </div>
  <?php elseif ($view_mode == 'full'): ?>
    <?php print strip_tags(render($content['field_image']),'<img>');  ?>
    <br />
    <?php print render($content['body']);  ?>
    <div class="clearfix bottom-navi">
      <?php print mind_node_sibling($node,'next',true,'','<div class="read-more-lab">'.t('next').'</div>',''); ?>
      <a class="back-link read-more-butt" href="<?php print base_path().$_url_array[$language->language];?>" ><div class="read-more-lab"><?php print t ('back');?></div>« <?php print t('News'); ?></a>
      <?php print mind_node_sibling($node,'prev',true,'','<div class="read-more-lab">'.t('prev').'</div>',''); ?>
    </div>
  <?php elseif ($view_mode == 'token'): ?>
    <div class="row">
      <div class="col-md-3 col-sm-3 col-xs-4">
        <?php print strip_tags(render($content['field_image']),'<img><a>');  ?>
      </div>
      <div class="col-md-9 col-sm-8 col-xs-8">
        <h5 class="font-base-r"><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h5>
        <p class="add-data"><?php print t('add').': '.date('d',$node->created).' '.t(date('M',$node->created)).' '.date('Y',$node->created);?></p>
        <p><?php print strip_tags(render($content['body']));  ?></p>
      </div>
    </div>
  <?php elseif ($view_mode == 'rss'): ?>
    <div class="row">
      <div class="col-md-3 col-sm-3 col-xs-4">
        <?php print strip_tags(render($content['field_image']),'<img><a>');  ?>
      </div>
      <div class="col-md-9 col-sm-8 col-xs-8">
        <h5 class="font-base-r"><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h5>
        <p><?php print strip_tags(render($content['body']));  ?></p>
      </div>
    </div>
  <?php else: ?>
    <?php if (!$page): ?>
      <h3<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h3>
    <?php endif; ?>
    <div class="content"<?php print $content_attributes; ?>>
      <?php print render($content); ?>
    </div>
  <?php endif; ?>
</div>
