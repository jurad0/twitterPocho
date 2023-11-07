<?php

require_once "../connection/connection.php";
session_start();

class Users {
    private $id;
    private $username;
    private $email;
    private $password;
    private $description;
    private $createDate;
    private $followList = [];

    private $followersList = [];
    private $publicationList = [];

    public function __construct($id, $username, $email, $password, $description) {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->description = $description;
        $this->createDate = date('Y-m-d H:i:s');
    }
}
