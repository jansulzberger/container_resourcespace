<?php

class OpenaiManger
{
    public static function prompt(string $prompt):string{
        $config = get_plugin_config('wordpress_image');
        $ch = curl_init();

        $headers = array(
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $config['wordpress_image_openai_key'],
        );

        $body = [
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                [
                    'role' => 'user',
                    'content' => $prompt,
                ],
            ],
            "max_tokens" => 50,
        ];

        curl_setopt($ch, CURLOPT_URL, $config['wordpress_image_openai_url']);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // to capture the response
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            curl_close($ch);
            return '';
        } else {

            ob_start();
            var_dump($response);
            $result = ob_get_clean();
            return $result;
            curl_close($ch);
        }
        return '';
    }
}