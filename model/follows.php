<?php
require_once("../connection/connection.php");
session_start();
$con = $pdo;
$id = $_GET['id'];
$idSes = $_SESSION['usuario']['id'];

try {
    $sql = "INSERT INTO follows (users_id, userToFollowId) VALUES (:userId, :userToFollowId)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':userId', $idSes);
    $stmt->bindParam(':userToFollowId', $id);
    $stmt->execute();
} catch (PDOException $e) {
    if ($e->getCode() == 23000) {
        echo "Ya estas siguiendo a este usuario";
    } else {
        echo "Error: " . $e->getMessage();
    }
}

header("Location: ../view/profiles.php?id=$id");

?>
