<?php
if (isset($_POST["tweetear"])) {
    require_once("../connection/connection.php");
    session_start();
    var_dump($_POST);
    //Recoger los datos

    $tweet= isset($_POST["text"]) ? mysqli_real_escape_string($connect, $_POST["text"]) : false;
    $userId = $_SESSION["usuario"]["id"];


    $sql = "INSERT INTO publications (userId,text,createDate)VALUES('$userId', '$tweet',NOW())";
    $guardar = mysqli_query($connect, $sql);
}else{
    echo "Error";
}
header("Location: ../index.php");

    ?>