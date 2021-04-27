<?php

namespace App\Classe;

use Mailjet\Client;
use Mailjet\Resources;

class Mail
{
    private $api_key = '98e8541cdc35b1327e24f1749f8d6645';
    private $api_key_secret = 'e5c1d8f3a83d1bd51abc7be4e8ddf32b';

    public function send($to_email, $to_name, $subject, $content)
    {
        $mj = new Client($this->api_key, $this->api_key_secret,true,['version' => 'v3.1']);
        $body = [
            'Messages' => [
            [
                'From' => [
                'Email' => "emeric.stofati@outlook.fr",
                'Name' => "La Boutique Française"
                ],
                'To' => [
                [
                    'Email' => $to_email,
                    'Name' => $to_name
                ]
                ],
                'TemplateID' => 2835974,
                'TemplateLanguage' => true,
                'Subject' => $subject,
                'Variables' => [
                    "content" => $content
                    ]
                ]
            ]
        ];
        $response = $mj->post(Resources::$Email, ['body' => $body]);
        $response->success();
    }
}