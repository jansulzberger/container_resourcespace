<?php

class WordpressManager
{

    public static function update($ref):bool{
        $config = get_plugin_config('wordpress_image');
        $data = [
            'title' => get_data_by_field($ref, 8),
            'caption' => get_data_by_field($ref, 18)
        ];


        $wordpressUrl = $config['wordpress_image_url'] . '/wp-json/wp/v2/media/' . get_data_by_field($ref, 88);
        $username = $config['wordpress_image_user'];
        $password = $config['wordpress_image_key'];

        $ch = curl_init();

        $headers = array(
            'Authorization: Basic ' . base64_encode("$username:$password"),
            'Content-Type: application/json',
        );
        $postFields = array('title' => $data['title'], 'caption' => $data['caption']);

        curl_setopt($ch, CURLOPT_URL, $wordpressUrl);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postFields));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // to capture the response
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            curl_close($ch);
            return false;
        } else {
            curl_close($ch);
            return true;
        }
        return false;
    }

    public static function upload(int $ref):?int{
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
}