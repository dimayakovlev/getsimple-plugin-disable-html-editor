<?php
/*
Plugin Name: Disable HTML Editor
Description: Disable HTML Editor At the Page Level
Version: 1.1
Author: Dmitry Yakovlev
Author URI: http://dimayakovlev.ru/
*/

# get correct id for plugin
$thisfile=basename(__FILE__, ".php");

i18n_merge($thisfile) || i18n_merge($thisfile, 'en_US');

# register plugin
register_plugin(
	$thisfile, 
	i18n_r($thisfile.'/TITLE'), 	
	'1.1', 		
	i18n_r($thisfile.'/AUTHOR'),
	'http://dimayakovlev.ru/', 
	i18n_r($thisfile.'/DESCRIPTION'),
	'',
	''  
);

add_action('edit-extras', 'plugin_disable_html_editor', array($thisfile));
add_action('changedata-save', 'plugin_disable_html_editor_save');

function plugin_disable_html_editor($thisfile) {
  global $data_edit, $HTMLEDITOR;
  $checked = '';
  if(isset($data_edit) && (string)$data_edit->noHTMLEditor) {
    $HTMLEDITOR = '';
    $checked = ' checked';
  }
  echo '<p class="inline clearfix"><input type="checkbox" name="post-noHTMLEditor" style="width: auto" value="1"'.$checked.'> <label for="post-noHTMLEditor">'.i18n_r($thisfile.'/LABEL').'</label></p>';
}

function plugin_disable_html_editor_save() {
  global $xml;
  if (isset($_POST['post-noHTMLEditor'])) {
    $xml->addChild('noHTMLEditor')->addCData('1');
  } else {
    $xml->addChild('noHTMLEditor');
  }
}