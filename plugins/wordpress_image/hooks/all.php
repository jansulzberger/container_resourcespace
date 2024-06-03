<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include get_plugin_path('wordpress_image') . '/include/CollectionManager.php';
include get_plugin_path('wordpress_image') . '/include/WordpressManager.php';
include get_plugin_path('wordpress_image') . '/include/OpenaiManger.php';


/**
 * @param $ref
 * @return void
 * Wird ausgelöst sobald eine Resource erstellt wurde
 * Hier würde ich die Daten aus Cover direkt mal eintragen
 */
function HookWordpress_imageAllResourcecreate($ref)
{
    
    global $userref, $filename_field;
    $originalFilename = $_REQUEST['file_name'];
    $collection = CollectionManager::mapCollection($originalFilename);
    //$example = OpenaiManger::prompt('write a blind text with 100 words');

    update_field($ref, 8, $originalFilename);
    update_field($ref, 18, 'This is a description');
}

/**
 * @param $ref
 * @return void
 * Wird ausgelöst, wenn eine Resource geändert wurde
 */
function HookWordpress_imageAllAftersaveresourcedata($ref)
{
    $wpid = get_data_by_field($ref, 88);
    if(!$wpid){
        $wpId = WordpressManager::upload($ref);
        if($wpId) {
            update_field($ref, 88, $wpId);
        }
    }
    WordpressManager::update($ref);

}