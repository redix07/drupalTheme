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
					'css' => array(drupal_get_path('theme', $GLOBALS['theme']) . '/css/admin.css'),
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
			'#title' => t('Google Analytics'),
			'#description' => t(''),
			'#collapsible' => TRUE,
			'#collapsed' => TRUE,
	);
	
	$form['base_theme_name_settings']['google']['google-analytics']['tracker'] = array(
			'#type' => 'textfield',
			'#title' => t('Tracker'),
			'#default_value' => theme_get_setting('tracker'),
	);
	
	$form['base_theme_name_settings']['google']['google-maps']= array(
			'#type' => 'fieldset',
			'#title' => t('Google Maps'),
			'#description' => t('Enter the latitude/longitude coordinates of your address. To lookup a set of coordinates, visit
					<a href="http://itouchmap.com/latlong.html" target="_blank">iTouchMap.com</a> and enter the street address.'),
			'#collapsible' => TRUE,
			'#collapsed' => TRUE,
	);
	
	$form['base_theme_name_settings']['google']['google-maps']['latitude'] = array(
			'#type' => 'textfield',
			'#title' => t('Longitude'),
			'#default_value' => theme_get_setting('latitude'),
	);
	
	$form['base_theme_name_settings']['google']['google-maps']['longitude'] = array(
			'#type' => 'textfield',
			'#title' => t('Longitude'),
			'#default_value' => theme_get_setting('longitude'),
	);
	
	/* LAYOUT SETTINGS */
	
	$form['base_theme_name_settings']['layout'] = array(
			'#type' => 'fieldset',
			'#title' => t('Layout'),
			'#weight' => 2,
	);
	
	$form['base_theme_name_settings']['layout']['layoutWidth'] = array(
			'#type' => 'radios',
			'#field_prefix' => t('Select the layout width. If a background color and/or image is being used, the "boxed" width is recommended.<br/><br/>'),
			'#title' => t('Layout Width'),
			'#options' => array(
					'fullwidthlayout' => t('Full Width'),
					'boxedlayout' => t('Boxed')
			),
			'#default_value' => theme_get_setting('layoutWidth')
	);

	
	$form['base_theme_name_settings']['layout']['responsive'] = array(
			'#type'          => 'checkbox',
			'#prefix'		 => '<label class="custom-label">Responsive Layout</label>',
			'#title'         => t('Enable Responsive Layout?'),
			'#description'         => t('Checking this option will enable a responsive layout on tablet/mobile devices.'),
			'#default_value' => theme_get_setting('responsive'),
	);
	
	$form['base_theme_name_settings']['layout']['sticky-header'] = array(
			'#type'          => 'checkbox',
			'#prefix'		 => '<label class="custom-label">Sticky Header</label>',
			'#title'         => t('Enable Sticky Header?'),
			'#description'         => t('Checking this option will enable a sticky header on desktop/widescreen devices.'),
			'#default_value' => theme_get_setting('sticky-header'),
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