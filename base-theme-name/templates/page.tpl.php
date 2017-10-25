<div id="page">
  <header id="header">
    <div class="box-header-stickup">
      <section class="section <?php print $container_classes; ?> wraper clearfix">
        <a class="a-left" id="logo" href="<?php print $front_page; ?>" title="<?php print $site_name; ?>" rel="home">
          <img src="<?php print $logo; ?>" alt="<?php print $site_name; ?>" class="img-responsive"/>
        </a>
        <div id="bx-top-wraper" class="clearfix a-right">
           <nav id="nav" class="navbar-default clearfix" role="navigation">
           <!-- Brand and toggle get grouped for better mobile display -->
             <div class="navbar-header">
               <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#page-main-menu">
                 <span class="sr-only">Toggle navigation</span>
                 <span class="icon-bar"></span>
                 <span class="icon-bar"></span>
                 <span class="icon-bar"></span>
               </button>
             </div>
             <div class="collapse navbar-collapse" id="page-main-menu">
               <?php print render($mainmenu_expanded); ?>
             </div><!-- /.navbar-collapse -->
           </nav>
        </div>
      </section>
    </div>
  </header>
  <!-- /.section, /#header -->
  <div id="main-content">
    <section class="section <?php print $container_classes; ?> clearfix ">
      <?php if ($page['breadcrumb'] && !$is_front): ?>
        <?php print render($page['breadcrumb']); ?>
      <?php endif; ?>
      <div class="<?php if ($page['sidebar_first'] || $page['sidebar_second']): ?>row<?php endif; ?>">
        <article id="main-article" class="clearfix <?php if ($page['sidebar_first'] && $page['sidebar_second']): ?> col-md-8 col-md-push-2 <?php elseif ($page['sidebar_first']): ?> col-md-9 col-sm-8 col-md-push-3 col-sm-push-4<?php elseif ($page['sidebar_second']): ?> col-md-8 <?php endif; ?>">
          <?php if ($title &&  !$custom_page_type): ////!$is_front?>
            <h1 class="title" id="page-title"><?php print $title; ?></h1>
          <?php endif; ?>
          <div id="page-extrs-develop">
            <?php print $messages; ?>
            <?php if ($tabs): ?><div class="tabs"><?php print render($tabs); ?></div><?php endif; ?>
            <?php print render($page['help']); ?>
            <?php if ($action_links): ?><ul class="action-links"><?php print render($action_links); ?></ul><?php endif; ?>
          </div>
          <?php print render($page['content']); ?>
        </article><!-- /#article -->
        <?php if ($page['sidebar_first']): ?>
        <aside id="sidebar-box-1" class="sidebar-box clearfix <?php if ($page['sidebar_second']): ?>col-md-2 col-md-pull-8 <?php else: ?> col-md-3 col-sm-4 col-md-pull-9 col-sm-pull-8<?php endif; ?>">
          <?php print render($page['sidebar_first']); ?>
        </aside><!-- /#sidebar left -->
        <?php endif; ?>
        <?php if ($page['sidebar_second']): ?>
        <aside id="sidebar-box-2" class="sidebar-box clearfix <?php if ($page['sidebar_first']): ?> col-md-2 <?php else: ?> col-md-4 <?php endif; ?>">
          <?php print render($page['sidebar_second']); ?>
        </aside><!-- /#sidebar right -->
        <?php endif; ?>
      </div>
    </section>
    <!-- /#main-box -->
  </div><!-- /#main-wrapper -->
  <footer id="footer">
    <?php if ($page['footer_firstcolumn'] || $page['footer_secondcolumn'] || $page['footer_thirdcolumn'] ): ?>
    <section id="sc-footer-top" class="section <?php print $container_classes; ?> wraper clearfix">
      <div class="row">
        <div id="footer-columns" class="clearfix">
          <div class="col-md-4 col-sm-4">
            <?php print render($page['footer_firstcolumn']); ?>
          </div>
          <div class="col-md-4 col-sm-4">
            <?php print render($page['footer_secondcolumn']); ?>
          </div>
          <div class="col-md-4 col-sm-4 col-last">
            <?php print render($page['footer_thirdcolumn']); ?>
          </div>
        </div><!-- /#footer-columns -->
      </div>
    </section>
    <?php endif; ?>
    <section id="sc-footer-bottom" class="section <?php print $container_classes; ?> wraper clearfix">
      <?php print render($page['footer']); ?>
    </section>
  </footer><!-- /#footer -->
</div><!-- /#page -->