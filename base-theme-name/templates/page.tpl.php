<div id="page" class="font-base">
  <header id="header">
    <div class="box-header-stickup">
      <section class="section <?php print $container_classes; ?> wraper clearfix">
        <div class="clearfix" id="box-top">
          <a class="a-left" id="logo" href="<?php print $front_page; ?>" title="<?php print $site_name; ?>" rel="home">
            <img src="<?php print $logo; ?>" alt="<?php print $site_name; ?>" class="img-responsive"/>
          </a>
          <div id="bx-top-wraper" class="clearfix a-right">
            <?php if ($page['box_top']): ?>
              <?php print render($page['box_top']); ?>
            <?php endif; ?>
            <nav id="nav" class="navbar-default clearfix" role="navigation">
              <!-- Brand and toggle get grouped for better mobile display -->
              <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
              </div>
              <!-- Collect the nav links, forms, and other content for toggling -->
              <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <?php print render($mainmenu_expanded); ?>
              </div>
              <!-- /.navbar-collapse -->
            </nav>
          </div>
        </div>
      </section>
    </div>
  </header>
  <!-- /.section, /#header -->
  <div id="main-wrapper">
    <section class="section <?php print $container_classes; ?> clearfix ">
      <a id="main-content"></a>
      <?php if ($page['breadcrumb'] && !$is_front): ?>
        <?php print render($page['breadcrumb']); ?>
      <?php endif; ?>
      <div class="clearfix <?php if ($page['sidebar_first'] || $page['sidebar_second']): ?>row<?php endif; ?>">
        <div class="clearfix <?php if ($page['sidebar_first'] && $page['sidebar_second']): ?> col-md-8 col-md-push-2 <?php elseif ($page['sidebar_first']): ?> col-md-9 col-sm-8 col-md-push-3 col-sm-push-4<?php elseif ($page['sidebar_second']): ?> col-md-8 <?php endif; ?>">
          <?php if ($page['pagetop']): ?>
            <div id="top-foto">
              <?php print render($page['pagetop']); ?>
            </div>
          <?php endif; ?>
          <article id="main-article">
            <?php if ($title &&  !$custom_page_type): ////!$is_front?>
              <h1 class="title" id="page-title">
                <?php if ($is_front):?>
                  <i class="fa fa-star" aria-hidden="true"></i>
                <?php endif;?>
                <?php print $title; ?>
              </h1>
            <?php endif; ?>
            <div id="page-extrs-develop">
              <?php print $messages; ?>
              <?php if ($tabs): ?>
                <div class="tabs"><?php print render($tabs); ?></div><?php endif; ?>
              <?php print render($page['help']); ?>
              <?php if ($action_links): ?>
                <ul class="action-links"><?php print render($action_links); ?></ul><?php endif; ?>
            </div>
            <?php print render($page['content']); ?>
          </article>
          <?php if ($page['pagebottom']): ?>
            <aside id="page-bottom" class="clearfix">
              <?php print render($page['pagebottom']); ?>
            </aside>
            <!-- /#pagebottom -->
          <?php endif; ?>
          <!-- /#article -->
        </div>
        <?php if ($page['sidebar_first']): ?>
          <aside id="box-sidebar1" class="sidebar-box clearfix <?php if ($page['sidebar_second']): ?>col-md-2 col-md-pull-8 <?php else: ?> col-md-3 col-sm-4 col-md-pull-9 col-sm-pull-8<?php endif; ?>">
            <?php print render($page['sidebar_first']); ?>
          </aside>
          <!-- /#sidebar left -->
        <?php endif; ?>
        <?php if ($page['sidebar_second']): ?>
          <aside id="box-sidebar2" class="sidebar-box clearfix <?php if ($page['sidebar_first']): ?> col-md-2 <?php else: ?> col-md-4 <?php endif; ?>">
            <?php print render($page['sidebar_second']); ?>
          </aside>
          <!-- /#sidebar right -->
        <?php endif; ?>
      </div>
    </section>
    <!-- /#main-box -->
  </div>
  <!-- /#main-wrapper -->
  <footer id="footer">
    <section class="section <?php print $container_classes; ?> wraper clearfix">
      <?php if ($page['footer_firstcolumn'] || $page['footer_secondcolumn'] || $page['footer_thirdcolumn'] || $page['footer_fourthcolumn']): ?>
        <div class="row">
          <div id="footer-columns" class="clearfix">
            <div class="col-md-3 col-sm-3">
              <?php print render($page['footer_firstcolumn']); ?>
            </div>
            <div class="col-md-3 col-sm-3">
              <?php print render($page['footer_secondcolumn']); ?>
            </div>
            <div class="col-md-3 col-sm-3 col-last">
              <?php print render($page['footer_thirdcolumn']); ?>
            </div>
          </div> <!-- /#footer-columns -->
        </div>
      <?php endif; ?>
    </section>
    <section class="section <?php print $container_classes; ?> wraper clearfix">
      <?php print render($page['footer']); ?>
    </section>
  </footer>
  <!-- /#footer -->
</div>
<!-- /#page -->