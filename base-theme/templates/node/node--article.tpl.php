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
<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix node-<?php print $view_mode;?> <?php if ($view_mode == 'teaser') : ?> panel panel-default <?php endif; ?>"<?php print $attributes; ?>>
  <?php if ($view_mode == 'full') : ?>
  <div class="content"<?php print $content_attributes; ?>>
    <?php  print render($content['body']);  ?>
  </div>
  <?php elseif ($view_mode == 'teaser') : ?>
    <div class="panel-heading" role="tab" id="heading-<?php print $node->nid;?>">
      <h4 class="panel-title">
        <a class="font-base-r" role="button" data-toggle="collapse" data-parent="#accordion-magazine" href="#collapse-<?php print $node->nid;?>" aria-expanded="false" aria-controls="collapse-<?php print $node->nid;?>">
          <?php print $title; ?>
        </a>
      </h4>
    </div>
    <div id="collapse-<?php print $node->nid;?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-<?php print $node->nid;?>">
      <div class="panel-body">
        <?php  print render($content['body']);  ?>
        <div class="attachment"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> <span><?php print t('Download article:'); ?></span> <?php  print strip_tags(render($content['field_attachment']),'<a>');  ?></div>
        <div class=" clearfix">
          <div class="ico ico-user a-left"><i class="fa fa-user" aria-hidden="true"></i> <span><?php print t('Author:'); ?></span> <?php print mind_get_article_urlbyname(strip_tags($name));  ?></div>
          <div class="ico ico-tags a-left"><i class="fa fa-tags" aria-hidden="true"></i> <span><?php print t('Tags:'); ?></span> <?php print strip_tags(render($content['field_tags']),'<a>');  ?></div>
        </div>
      </div>
    </div>
  <?php elseif ($view_mode == 'token') : ?>
    <h5 class="font-base-r"><?php print $title; ?></h5>
    <div class="ico ico-date"><i class="fa fa-calendar" aria-hidden="true"></i> <span><?php print t('Data:'); ?></span> <?php print t(date('d',$node->changed))?> <?php print t(date('M',$node->changed))?> <?php print t(date('Y',$node->changed))?></div>
    <?php  print render($content['body']);  ?>
    <div class="clearfix buttons-action">
      <a href="<?php print $node_url; ?>" class="btn btn-default btn-info btn-xs"><?php print t('view'); ?></a>
      <a href="/node/<?php print $node->nid;?>/edit" class="btn btn-danger btn-xs"><?php print t('edit'); ?></a>
    </div>
  <?php else: ?>
  <div class="content"<?php print $content_attributes; ?>>
    <?php print render($title_prefix); ?>
    <?php if (!$page): ?>
      <h3 class="font-base-r"><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h3>
    <?php endif; ?>
    <?php print render($title_suffix); ?>
    <?php  print render($content);  ?>
  </div>
  <?php endif; ?>
</div>


