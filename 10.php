<?php
session_start();

include "./db_conn.php";
$query = "insert into articles (paragraph) values (:paragraph)";
$stmt = $pdo->prepare($query);
$stmt->bindParam(":paragraph", $paragraph);

$paragraph = $_POST['paragraph'];
$stmt->execute();

header("Location: ./task_10.php");

?>