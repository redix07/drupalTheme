<?php

/**
 * Add body classes if certain regions have content.
 */
function base_theme_name_preprocess_page(&$variables , $hook) {
	variable_get('text_contactsupport_info', '');
	
	$variables['custom_page_type_str'] = '';
	if (isset($variables['node'])) {
		$variables['custom_page_type_str'] = $variables['node']->type ;
		if ($variables['node']->type == 'news-' || $variables['node']->type == 'topic-' ){
			$variables['custom_page_type'] = true;
		} else {
			$variables['custom_page_type'] = false;
		}
	}
	$menu_tree = menu_tree_all_data('main-menu');
	$variables['mainmenu_expanded'] = menu_tree_output($menu_tree);
	
	// layout seting
	$variables['container_classes'] = '';
  	if(theme_get_setting('layoutWidth') == 'boxedlayout') {
		$variables['classes_array'][] = 'boxedlayout' ;
		$variables['container_classes'] = 'container';
	} else {
		$variables['classes_array'][] = 'fullwidthlayout';
		$variables['container_classes'] = 'container-fluid';
	}
	
	$skin = '<link href="'.$GLOBALS['base_url'].'/'.path_to_theme().'/css/'.theme_get_setting('layoutColor').'.css" rel="stylesheet"/>';
	$vars['classes_array'][] = 'colored';
	
	if(theme_get_setting('backgroundImage') !== 'no-background') {
		$vars['classes_array'][] = theme_get_setting('backgroundImage');
	}
	if(theme_get_setting('backgroundImage') == 'custom') {
		$image = 'body.custom {background-image: url('.file_create_url(file_load(theme_get_setting('backgroundCustom'))->uri).');}';
		drupal_add_css($image, 'inline', array('every_page' => TRUE, 'preprocess' => TRUE));
	}
	
	if(theme_get_setting('backgroundColor') != NULL) {
		$color = 'body { background-color: #'.theme_get_setting('backgroundColor').' !important; }';
		drupal_add_css($color, 'inline', array('every_page' => TRUE, 'preprocess' => TRUE));
	}
	
}
/**
 * Override css
 */
function base_theme_name_css_alter(&$css) {
	// Sort CSS items, so that they appear in the correct order.
	// This is taken from drupal_get_css().
	uasort($css, 'drupal_sort_css_js');
	// The Print style sheets
	// I will populate this array with the print css (usually I have only one but just in case…)
	$print = array();
	// I will add some weight to the new $css array so every element keeps its position
	$weight = 0;
	foreach ($css as $name => $style) {
		// I leave untouched the conditional stylesheets
		// and put all the rest inside a 0 group
		if ($css[$name]['browsers']['!IE']) {
			$css[$name]['group'] = 0;
			$css[$name]['weight'] = ++$weight;
			$css[$name]['every_page'] = TRUE;
		}
		// I move all the print style sheets to a new array
		if ($css[$name]['media'] == 'print') {
			// remove and add to a new array
			$print[$name] = $css[$name];
			unset($css[$name]);
		}

	}
	// I merge the regular array and the print array
	$css = array_merge($css, $print);
}
/**
 * Override js
 */
function base_theme_name_js_alter(&$js) {
	uasort($js, 'drupal_sort_css_js');
	$weight = 0;
	foreach ($js as $name => $javascript) {
		$js[$name]['group'] = -100;
		$js[$name]['weight'] = ++$weight;
		$js[$name]['every_page'] = 1;
		$js[$name]['async_js'] = TRUE;
		$js[$name]['async'] = TRUE;
	}
}
/**
 * Override or insert variables into the page template for HTML output.
 */
function base_theme_name_process_html(&$variables) {
	$variables['sticky_classes'] = '';
  	if(theme_get_setting('sticky-header') == 1) {
		$variables['sticky_classes'] = 'sticky-header';
	} 
}


/**
 * Override or insert variables into the node template.
 */
function base_theme_name_preprocess_node(&$variables) {
  if ($variables['view_mode'] == 'full' && node_is_page($variables['node'])) {
    $variables['classes_array'][] = 'node-full';
  }
}

/**
 * Override or insert variables into the block template.
 */
function base_theme_name_preprocess_block(&$variables) {
  // In the header region visually hide block titles.
  if ($variables['block']->region == 'header') {
    $variables['title_attributes_array']['class'][] = 'element-invisible';
  }
}

/**
 * Override or insert variables into the block template.
 */
function base_theme_name_preprocess_textfield(&$vars) {
	if (isset($vars['element'])  ){
		$vars['element']['#attributes']['class'][] = 'form-control';
	}
}

/**
 * Override or insert variables into the block template.
 */
function base_theme_name_preprocess_password(&$vars) {
	if (isset($vars['element'])  ){
		$vars['element']['#attributes']['class'][] = 'form-control';
	}
}

/**
 * Override or insert variables into the block template.
 */
function base_theme_name_preprocess_textarea(&$vars) {
	if (isset($vars['element'])  ){
		$vars['element']['#attributes']['class'][] = 'form-control';
	}
}

/**
 * Override or insert variables into the block template.
 */
function base_theme_name_form_alter(&$form,&$form_state, $form_id) {
  // In the header region visually hide block titles.
  if (isset($form['quickform-nameform'])) {
    $form['quickform-nameform']['#attributes']['class'][] = 'form-control';
  } 
  //!empty($form['webform']) &&
  if ( !empty($form['actions']) && $form['actions']['submit']) {
    $form['actions']['submit']['#attributes'] = array('class' => array('btn', 'btn-default'));
  }
	// exposed filter - placeholder
	if($form_id == "views_exposed_form"){

		// search page - add bootstrap class - textfiled
		if (isset($form['search_api_views_fulltext'])) {
			$form['search_api_views_fulltext']['#attributes'] = array(
				'placeholder' => array(t('Szukaj')),
				'class' 			=> array('form-control'),);
		}
		// search page - add bootstrap - select allter
		if (isset($form['type']) && is_array($form['type']['#options']) ) {
			$drp_wraper  = '<div class="dropdown"><button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"> '.t('Content type').' <span class="caret"></span></button>';
			$drp_wraper .= '<ul class="dropdown-menu custom-drop">';
			foreach ($form['type']['#options'] as $key => $item) {
				$drp_wraper .= '<li><a href="#" val="'.$key.'"> '.t($item).' </a></li>';
			}
			$drp_wraper .= '</ul>';
			$drp_wraper .= '</div>';
			$form['type']['#field_prefix'] = $drp_wraper ;
			drupal_add_js(drupal_get_path('theme', 'base_theme_name') .'/js/select.boot.override.action.js');

			// alter submit & reset boodstrap class
			if (isset($form['submit'])) {
				$form['submit']['#attributes'] = array('class' 			=> array('btn','btn-default'),);
			}
			if (isset($form['reset'])) {
				$form['reset']['#attributes'] = array('class' 			=> array('btn','btn-default'),);
			}
		}

		// views frotn page - user role
		if (isset($form['rid'])) {
			if (is_array($form['rid']['#options'])){
				$bufListAlter = '<ul id="userpi-type" class="custom-over-select font-base-r">';
				foreach ($form['rid']['#options'] as $key => $optItem){
					if ( $key == 5 || $key == 6 ) {
						if ($form['rid']['#default_value'] == $key){
							$activeClass = 'active';
						} else {
							$activeClass = '';
						}
						$bufListAlter .= '<li class="'.$activeClass.'"><a href="#" val="'.$key.'">'.t($optItem).'</a></li>';
					}
				}
				$bufListAlter .= '</ul>';
			}
			$form['rid']['#prefix'] = $bufListAlter;
			drupal_add_js(drupal_get_path('theme', 'base_theme_name') .'/js/select.action.js');
		}
	}
} 

/**
 * Override breadcrumb.
 */
function base_theme_name_preprocess_image(&$variables) {
	if ( isset($variables['style_name']) ) {
    $variables['attributes']['class'][] = 'img-responsive';
	}
}



