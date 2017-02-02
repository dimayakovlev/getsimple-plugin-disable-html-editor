<?php
/*
Plugin Name: Disable HTML Editor
Description: Disable HTML Editor At the Page Level
Version: 1.0
Author: Dmitry Yakovlev
Author URI: http://dimayakovlev.ru/
*/

# get correct id for plugin
$thisfile=basename(__FILE__, ".php");

# register plugin
register_plugin(
	$thisfile, 
	'Disable HTML Editor', 	
	'1.0', 		
	'Dmitry Yakovlev',
	'http://dimayakovlev.ru/', 
	'Disable HTML Editor At the Page Level',
	'',
	''  
);

add_action('edit-extras', 'plugin_disable_html_editor');
add_action('changedata-save', 'plugin_disable_html_editor_save');

function plugin_disable_html_editor() {
  global $data_edit, $HTMLEDITOR;
  $checked = '';
  if(isset($data_edit) && (string)$data_edit->noHTMLEditor) {
    $HTMLEDITOR = '';
    $checked = ' checked';
  }
  echo '<p class="inline clearfix"><input type="checkbox" name="post-noHTMLEditor" style="width: auto" value="1"'.$checked.'> <label for="post-noHTMLEditor">Disable HTML Editor At the Page Level</label></p>';
}

function plugin_disable_html_editor_save() {
  global $xml;
  if (isset($_POST['post-noHTMLEditor'])) {
    $xml->addChild('noHTMLEditor')->addCData('1');
  } else {
    $xml->addChild('noHTMLEditor');
  }
}