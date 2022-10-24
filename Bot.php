<?php

class Bot
{
    protected $token;

    protected $base_url;

    protected $data;

    protected $id_user;

    protected $chat_id;

    private static $db;

    function __construct()
    {
        $this->token = "5745812249:AAFoC_adqkoPLtACbJLiBYYrZjn0Ic1Iu6w";
        $this->base_url = "https://api.telegram.org/bot" . $this->token . "/";

        self::$db = new DB();
    }

    function sendMessage($method = "sendMessage")
    {
        $this->data = json_decode(file_get_contents('php://input'), JSON_OBJECT_AS_ARRAY);
        $this->chat_id = $this->data["message"]["chat"]["id"];
        $this->id_user = $this->data["message"]["from"]["id"];
        $first_name = $this->data["message"]["from"]["first_name"];
        $last_name = $this->data["message"]["from"]["last_name"];
        $date = date("Y-m-d H:i:s", $this->data["message"]["date"]);
        if ($this->chat_id) {
            $url = $this->base_url . $method . "?" . http_build_query(["chat_id" => $this->chat_id, "text" => "Привіт, " . $first_name . "!"]);
            self::$db->insert('users', ["id" => $this->id_user , "first_name" => $first_name, "last_name" => $last_name, "date" => $date]);
            return json_decode(
                file_get_contents($url),
                JSON_OBJECT_AS_ARRAY
            );
        }
    }
}


