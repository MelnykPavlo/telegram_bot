<?php
const TOKEN = "5745812249:AAFoC_adqkoPLtACbJLiBYYrZjn0Ic1Iu6w";
const METHOD = "setWebhook";
const BASE_URL = "https://api.telegram.org/bot" . TOKEN . "/" . METHOD;
$options = [
    "url" => "https://pavel-melnik.dev.yeducoders.com"
];
$response = file_get_contents(BASE_URL . "?" . http_build_query($options));
var_dump($response);


const TOKEN_TRELLO = "b42f8d46c6cb387b2618bbc05034a696be66e6351bfca47fdc1a06b7b2301672";
const KEY_TRELLO = "19f2dd3d9341c6880c68e081082e62f7";
const BASE_URL_TRELLO = "https://api.trello.com/1/webhooks/?";
const ID_MODEL = "6353334b29eecd0117b535c3";
$optionsTrello = [
    "callbackURL" => "https://pavel-melnik.dev.yeducoders.com/Trello.php",
    "idModel" => ID_MODEL,
    "key" => KEY_TRELLO,
    "token" => TOKEN_TRELLO,
];

$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => BASE_URL_TRELLO,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => http_build_query($optionsTrello),
));
$response_trello = curl_exec($curl);
curl_close($curl);
var_dump($response_trello);
