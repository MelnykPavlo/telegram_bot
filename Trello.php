<?php

class Trello
{
    protected $token;

    protected $base_url;

    protected $ApiToken;

    protected $ApiKey;

    protected $dataTrello;

    protected $chat_id;

    function __construct()
    {
        $this->token = "5745812249:AAFoC_adqkoPLtACbJLiBYYrZjn0Ic1Iu6w";
        $this->base_url = "https://api.telegram.org/bot" . $this->token . "/";
        $this->ApiToken = "b42f8d46c6cb387b2618bbc05034a696be66e6351bfca47fdc1a06b7b2301672";
        $this->ApiKey = "19f2dd3d9341c6880c68e081082e62f7";
    }

    function sendMessage($method = "sendMessage")
    {
        $this->dataTrello = json_decode(file_get_contents('php://input'), true);
        $this->chat_id = "-429973266";
        $name = $this->dataTrello["action"]["memberCreator"]['fullName'];
        $card = $this->dataTrello["action"]["data"]['card']["name"];
        $listBefore = $this->dataTrello["action"]["display"]["entities"]["listBefore"]['text'];
        $listAfter = $this->dataTrello["action"]["display"]["entities"]["listAfter"]['text'];
        if ($card && $listBefore && $listAfter){
            $url = $this->base_url . $method . "?" . http_build_query(["chat_id" => $this->chat_id, "text" => $name . " перемістив картку " .
                    $card . " з колонки " . $listBefore . " в колонку " . $listAfter]);
            return json_decode(
                file_get_contents($url),
                JSON_OBJECT_AS_ARRAY
            );
        }
    }

}

$trello = new Trello();

$trello->sendMessage();