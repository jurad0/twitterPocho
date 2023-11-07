<?php

require_once "../connection/connection.php";
session_start();

class Publications {
    private $id;
    private $userId;
    private $text;
    private $createDate;
    

    public function __construct($id, $userId, $text, $createDate) {
        $this->id = $id;
        $this->userId = $userId;
        $this->text = $text;
        $this->createDate = $createDate;
    }
}

?>