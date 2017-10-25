<?php

/**
 * @file
 * General theme settings elements.
 */

function base_theme_name_form_system_theme_settings_alter(&$form, &$form_state) {
  $form['base_theme_name_settings'] = array(
    '#type' => 'vertical_tabs',
    '#weight' => -10,
    '#prefix' => t('<h3>Adsolutions BasicTheme Settings</h3>'),
    '#attached' => array(
      'css' => array(drupal_get_path('theme', 'base_theme_name') . '/css/admin.css'),
      'js' => array(
        drupal_get_path('theme', 'base_theme_name') . '/js/admin/admin.js',
      ),
    ),
  );


  /* GENERAL SETTINGS */
  $form['base_theme_name_settings']['google'] = array(
    '#type' => 'fieldset',
    '#title' => t('Google setings'),
    '#weight' => 6,
  );

  $form['base_theme_name_settings']['google']['google-analytics']= array(
    '#type' => 'fieldset',
    '#title' => t('Google Tag Manager'),
    '#description' => t(''),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );

  $form['base_theme_name_settings']['google']['google-analytics']['googletracker'] = array(
    '#type' => 'textfield',
    '#title' => t('Tracker'),
    '#default_value' => theme_get_setting('googletracker'),
  );

  /* LAYOUT SETTINGS */

  $form['base_theme_name_settings']['layout'] = array(
    '#type' => 'fieldset',
    '#title' => t('Layout'),
    '#weight' => 2,
  );

  $form['base_theme_name_settings']['layout']['display'] = array(
    '#type' => 'fieldset',
    '#title' => t('Display settings'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
  );

  $form['base_theme_name_settings']['layout']['display']['layoutWidth'] = array(
    '#type' => 'radios',
    '#field_prefix' => t('Select the layout width. If a background color and/or image is being used, the "boxed" width is recommended.<br/><br/>'),
    '#title' => t('Layout Width'),
    '#options' => array(
      'fullwidthlayout' => t('Full Width'),
      'boxedlayout' => t('Boxed')
    ),
    '#default_value' => theme_get_setting('layoutWidth')
  );


  $form['base_theme_name_settings']['layout']['display']['responsive'] = array(
    '#type'          => 'checkbox',
    '#prefix'		 => '<label class="custom-label">Responsive Layout</label>',
    '#title'         => t('Enable Responsive Layout?'),
    '#description'         => t('Checking this option will enable a responsive layout on tablet/mobile devices.'),
    '#default_value' => theme_get_setting('responsive'),
  );

  $form['base_theme_name_settings']['layout']['display']['sticky-header'] = array(
    '#type'          => 'checkbox',
    '#prefix'		 => '<label class="custom-label">Sticky Header</label>',
    '#title'         => t('Enable Sticky Header?'),
    '#description'         => t('Checking this option will enable a sticky header on desktop/widescreen devices.'),
    '#default_value' => theme_get_setting('sticky-header'),
  );

  $form['base_theme_name_settings']['layout']['media'] = array(
    '#type' => 'fieldset',
    '#title' => t('Media settings'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
  );

  $form['base_theme_name_settings']['layout']['media']['basicTopImage'] = array(
    '#title' => 'Upload default - Top Image',
    '#type' => 'managed_file',
    '#upload_validators' => array(
      'file_validate_extensions' => array(0 => 'png jpg jpeg gif'),
    ),
    '#upload_location' => 'public://theme-seting/',
    '#description' => t("Upload an image."),
    '#default_value' => theme_get_setting('basicTopImage'),
  );

  $form['base_theme_name_settings']['layout']['page-settings'] = array(
    '#type' => 'fieldset',
    '#title' => t('Page settings'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
  );

  $form['base_theme_name_settings']['layout']['page-settings']['cs_pagetitle'] = array(
    '#type' => 'textfield',
    '#title' => t('Homepage Title'),
    '#default_value' => theme_get_setting('cs_pagetitle'),
  );

  $form['base_theme_name_settings']['layout']['page-settings']['cs_subpagetitle'] = array(
    '#type' => 'textarea',
    '#rows' => '3',
    '#title' => t('Homepage Subtitle'),
    '#default_value' => theme_get_setting('cs_subpagetitle'),
  );

  $form['base_theme_name_settings']['layout']['page-settings']['mainphone'] = array(
    '#type' => 'textfield',
    '#title' => t('Main Phone number'),
    '#default_value' => theme_get_setting('mainphone'),
  );

  $form['base_theme_name_settings']['layout']['page-settings']['mainmobile'] = array(
    '#type' => 'textfield',
    '#title' => t('Main Mobile Phone number'),
    '#default_value' => theme_get_setting('mainmobile'),
  );

  $form['base_theme_name_settings']['layout']['page-settings']['mainaddress'] = array(
    '#type' => 'textfield',
    '#title' => t('Main address'),
    '#default_value' => theme_get_setting('mainaddress'),
  );

  /* GLOBAL SETTINGS */
  base_theme_name_settings_global_tab($form);
}

function base_theme_name_settings_global_tab(&$form) {
  // Toggles
  $form['theme_settings']['toggle_logo']['#default_value'] = theme_get_setting('toggle_logo');
  $form['theme_settings']['toggle_name']['#default_value'] = theme_get_setting('toggle_name');
  $form['theme_settings']['toggle_slogan']['#default_value'] = theme_get_setting('toggle_slogan');
  $form['theme_settings']['toggle_node_user_picture']['#default_value'] = theme_get_setting('toggle_node_user_picture');
  $form['theme_settings']['toggle_comment_user_picture']['#default_value'] = theme_get_setting('toggle_comment_user_picture');
  $form['theme_settings']['toggle_comment_user_verification']['#default_value'] = theme_get_setting('toggle_comment_user_verification');
  $form['theme_settings']['toggle_favicon']['#default_value'] = theme_get_setting('toggle_favicon');
  $form['theme_settings']['toggle_secondary_menu']['#default_value'] = theme_get_setting('toggle_secondary_menu');


  $form['logo']['default_logo']['#default_value'] = theme_get_setting('default_logo');
  $form['logo']['settings']['logo_path']['#default_value'] = theme_get_setting('logo_path');
  $form['favicon']['default_favicon']['#default_value'] = theme_get_setting('default_favicon');
  $form['favicon']['settings']['favicon_path']['#default_value'] = theme_get_setting('favicon_path');

  $form['base_theme_name_settings']['global_settings'] = array(
    '#type' => 'fieldset',
    '#title' => t('Global'),
    '#weight' => 1,
  );
  $form['theme_settings']['#collapsible'] = TRUE;
  $form['theme_settings']['#collapsed'] = TRUE;
  $form['logo']['#collapsible'] = TRUE;
  $form['logo']['#collapsed'] = FALSE;
  $form['favicon']['#collapsible'] = TRUE;
  $form['favicon']['#collapsed'] = FALSE;
  $form['base_theme_name_settings']['global_settings']['logo'] = $form['logo'];
  $form['base_theme_name_settings']['global_settings']['favicon'] = $form['favicon'];
  $form['base_theme_name_settings']['global_settings']['theme_settings'] = $form['theme_settings'];

  unset($form['theme_settings']);
  unset($form['logo']);
  unset($form['favicon']);
}
