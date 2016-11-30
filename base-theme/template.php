<?php

/**
 * Add body classes if certain regions have content.
 */
function mind_preprocess_page(&$variables , $hook) {
	variable_get('text_contactsupport_info', '');
	
	$variables['custom_page_type_str'] = '';
	if (isset($variables['node'])) {
		$variables['custom_page_type_str'] = $variables['node']->type ;
		if ($variables['node']->type == 'news-' || $variables['node']->type == 'topic-' ){
			$variables['custom_page_type'] = true;
		} else {
			$variables['custom_page_type'] = false;
		}
	} else {
		if (isset($_GET['q']) && $_GET['q'] == 'userspj'){
			$variables['custom_page_type'] = true;
			$variables['custom_page_type_str'] = 'userspj';
		} else if (isset($_GET['q']) && $_GET['q'] == 'artykuly'){
			$variables['custom_page_type'] = true;
			$variables['custom_page_type_str'] = 'artykuly';
		}	else {
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
function mind_css_alter(&$css) {

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
function mind_js_alter(&$js) {
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
function mind_process_html(&$variables) {
	$variables['sticky_classes'] = '';
  	if(theme_get_setting('sticky-header') == 1) {
		$variables['sticky_classes'] = 'sticky-header';
	} 
}
/**
 * Override or insert variables into the page template.
 */
function mind_process_page(&$variables) {
}


/**
 * Override or insert variables into the node template.
 */
function mind_preprocess_node(&$variables) {
  if ($variables['view_mode'] == 'full' && node_is_page($variables['node'])) {
    $variables['classes_array'][] = 'node-full';
  }
}

/**
 * Override or insert variables into the block template.
 */
function mind_preprocess_block(&$variables) {
  // In the header region visually hide block titles.
  if ($variables['block']->region == 'header') {
    $variables['title_attributes_array']['class'][] = 'element-invisible';
  }
}

/**
 * Override or insert variables into the block template.
 */
function mind_preprocess_textfield(&$vars) {
	if (isset($vars['element'])  ){
		$vars['element']['#attributes']['class'][] = 'form-control';
	}
}

/**
 * Override or insert variables into the block template.
 */
function mind_preprocess_password(&$vars) {
	if (isset($vars['element'])  ){
		$vars['element']['#attributes']['class'][] = 'form-control';
	}
}

/**
 * Override or insert variables into the block template.
 */
function mind_preprocess_textarea(&$vars) {
	if (isset($vars['element'])  ){
		$vars['element']['#attributes']['class'][] = 'form-control';
	}
}

/**
 * Override or insert variables into the block template.
 */
function mind_form_alter(&$form,&$form_state, $form_id) {
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
			drupal_add_js(drupal_get_path('theme', 'mind') .'/js/select.boot.override.action.js');

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
			drupal_add_js(drupal_get_path('theme', 'mind') .'/js/select.action.js');
		}
	}
} 
/**
 * Override breadcrumb.
 */
function mind_breadcrumb($variables) {
  $sep = '  &raquo; ';
  if (count($variables['breadcrumb']) > 0) {
    return implode($sep, $variables['breadcrumb']) . $sep;
  }
  else {
    return t("Home");
  }
}
/**
 * Override breadcrumb.
 */
function mind_preprocess_image(&$variables) {
	
	if ( isset($variables['style_name']) ) {
		if ($variables['style_name'] == 'thumb-002-round'){
			$variables['attributes']['class'][] = 'img-responsive ';
			$variables['attributes']['class'][] = 'img-circle ';
		} else {
			$variables['attributes']['class'][] = 'img-responsive';
		}
    } else {
	}
}
/**
 * get articles by user name
 */
function mind_get_article_urlbyname($name){
	$user 	 = user_load_by_name($name);
	$uname	 = '';
	if ( isset($user) && isset($user->uid) ) {
		$profile = profile2_load_by_user($user->uid);
		$uname = $user->name;
		if (isset($profile['author']->field_profile_name)){
			$uname = $profile['author']->field_profile_name['und'][0]['value'];
		}
		if (isset($profile['author']->field_profile_surname)){
			$uname .= ' '.$profile['author']->field_profile_surname['und'][0]['value'];
		}
		return l($uname, 'articles/author/' . $user->uid, array('attributes' => array('class' => '',)));
	} else {
		return false;
	}
}


function mind_spanReplace($str){
	$subject 	= " | ";
	$space_location = strpos($str,$subject);
	if($space_location){
		$str = "<span>".str_replace ($subject, "</span>", $str);
	} 
	return $str;
}

function mind_getAhrehfromstr($str){
	$doc = new DOMDocument(); 
	$doc->loadHTML($str); 
	$arr = $doc->getElementsByTagName("a"); 
	foreach($arr as $item) { 
		$href = $item->getAttribute("href"); 
	}
	return $href;
}

function mind_getStrfromstr($str){
	$dom = new DOMDocument();
	$dom->loadHTML($str);
	return $dom->getElementsByTagName('img')->item(0)->getAttribute('src');
}

function mind_child_select_nodes_type($type,$renderContent = true, $items = 0,$wOrder = false) {
	$query = db_select('node', 'n')
    ->fields('n', array('nid'))
    ->fields('n', array('type'))
    ->condition('n.type', $type);
	
	if ($wOrder == true){
	    $query->join('weight_weights', 'w', 'w.entity_id = n.nid');
		$order = array('w.weight'=>'ASC', 'n.created' => 'ASC');
		foreach ($order as $field => $direction) {
    		$query->orderBy($field, $direction);
			list($table_alias, $name) = explode('.', $field);
		    $query->addField($table_alias, $name);
  		}	
    } else {
		$query->orderBy('n.created', 'DESC');
	}
	$nids = $query->execute()->fetchCol(); 
	$children = node_load_multiple($nids);
	$returnContent 	= '';
	$itemCunter 	= 0;
	if (count ($children ) > 0){
		foreach ($children as $index =>$nodes) {
			$nodeObj = node_load($nodes->nid);
			$view_mode = 'token'; // Or 'full' for example
			if ($nodeObj->status == 1){
				$view = node_view($nodeObj, $view_mode);
				if ($renderContent){
					print render($view);
				} else {
					$returnContent .= render($view);
				}
			}
			$itemCunter++;
			if ($items > 0 && $itemCunter >= $items){
				break;
			}
		}
		if (!$renderContent){
			return $returnContent;
		}
	} else {
		return false;
	}
}

function mind_node_sibling($node, $dir = 'next', $next_node_text=false,$field_name='',$prepend_text = '', $append_text = '', $extra_class = 'read-more-butt') {
	if ($field_name != ''){ $tmp_terms = field_get_items('node', $node, $field_name); }
	if (isset($tmp_terms[0]['tid']) && $tmp_terms[0]['tid'] > 0){
		$query = 'SELECT n.nid, n.title FROM {node} n WHERE nid IN (
					SELECT nid FROM {taxonomy_index} ti
					LEFT JOIN {taxonomy_term_data} td ON ti.tid = td.tid
					WHERE td.tid = :tid) AND '
           . 'n.created ' . ($dir == 'prev' ? '<' : '>') . ' :created AND n.type = :type AND n.status = 1 '
           . "AND language IN (:lang, 'und') "
           . 'ORDER BY n.created ' . ($dir == 'prev' ? 'DESC' : 'ASC') . ' LIMIT 1';
		$row = db_query($query, array(':tid' => $tmp_terms[0]['tid'] ,':created' => $node->created, ':type' => $node->type, ':lang' => $node->language))->fetchObject();
	} else {
		$query = 'SELECT n.nid, n.title FROM {node} n WHERE '
           . 'n.created ' . ($dir == 'prev' ? '<' : '>') . ' :created AND n.type = :type AND n.status = 1 '
           . "AND language IN (:lang, 'und') "
           . 'ORDER BY n.created ' . ($dir == 'prev' ? 'DESC' : 'ASC') . ' LIMIT 1';	   
		$row = db_query($query, array(':created' => $node->created, ':type' => $node->type, ':lang' => $node->language))->fetchObject();
	}
	if ($row) {
		drupal_add_html_head_link(array(
      		'rel' => $dir,
		    'type' => 'text/html',
      		'title' => $row->title,
      		'href' => url('node/' . $row->nid, array('absolute' => TRUE)),
    	));
    	if ($next_node_text){
			$text = (strlen($row->title)<30)? $row->title : substr($row->title, 0,30).' ...';
			return l($prepend_text.$text.$append_text, 'node/' . $row->nid, array('html' => true, 'attributes' => array('class' => ' '.$dir.'-page '.$extra_class,'rel' => array($dir))));
		} else {
			return l($prepend_text.$append_text, 'node/' . $row->nid, array('attributes' => array('class' => ' '.$dir.'-page '.$extra_class,'rel' => array($dir))));
		}
  	} else {
    	return FALSE;
  	}
}