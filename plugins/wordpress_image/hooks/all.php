<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


/**
 * @param $ref
 * @return void
 * Wird ausgelöst sobald eine Resource erstellt wurde
 * Hier würde ich die Daten aus Cover direkt mal eintragen
 */
function HookWordpress_imageAllResourcecreate($ref)
{
    global $userref, $filename_field;
    $title = "Default Title";
    $caption = $_REQUEST['file_name'];


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
    ob_start();
    $data = get_resource_data($ref,false);
    var_dump($data);
    $caption = ob_get_clean();
    update_field($ref,18,$caption);
    $config = get_plugin_config('wordpress_image');
    $data = get_image_sizes($ref);
    $imageFilePath = $data[0]['path'];
    $wordpressUrl = $config['wordpress_image_url'] . '/wp-json/wp/v2/media';
    $username = $config['wordpress_image_user'];
    $password = $config['wordpress_image_key'];

    $ch = curl_init();

    $headers = array(
        'Authorization: Basic ' . base64_encode("$username:$password"),
        'Content-Disposition: attachment; filename="' . basename($imageFilePath) . '"',
    );
    $file = new CURLFile($imageFilePath, mime_content_type($imageFilePath), basename($imageFilePath));
    $postFields = array('file' => $file);

    curl_setopt($ch, CURLOPT_URL, $wordpressUrl);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // to capture the response
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {

        curl_close($ch);
        return null;
    } else {
        $result = json_decode($response, true);
        curl_close($ch);
        return $result['id'];
    }

}