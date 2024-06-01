<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include get_plugin_path('wordpress_image') . '/include/CollectionManager.php';
include get_plugin_path('wordpress_image') . '/include/WordpressManager.php';


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
    $title = "Default Title " . CollectionManager::mapCollection($originalFilename);
    $caption = $originalFilename;



/*
    if ($resource_data) {

        $caption =  $resource_data['original_filename'];
    }*/

    // Update the resource field
    // Note: Field 8 is the default field for titles, change it if necessary
    update_field($ref, 8, $title);
    update_field($ref, 18, $caption);
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