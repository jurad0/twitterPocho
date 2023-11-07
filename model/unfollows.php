<?php
require_once("../connection/connection.php");
session_start();
$con = $pdo;
$id = $_GET['id'];
$idSes = $_SESSION['usuario']['id'];

$sql = "DELETE FROM follows WHERE users_id = :userId AND userToFollowId = :userToFollowId";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':userId', $idSes);
$stmt->bindParam(':userToFollowId', $id);
$stmt->execute();

header("Location: ../view/profiles.php?id=$id");
?>