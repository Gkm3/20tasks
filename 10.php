<?php
session_start();

$host = 'localhost';
$dbname = 'qwerty';
$username = 'root';
$password = 'Y1zzcK0o-Wb!';

$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
$query = "insert into articles (paragraph) values (:paragraph)";
$stmt = $pdo->prepare($query);
$stmt->bindParam(":paragraph", $paragraph);

$paragraph = $_POST['paragraph'];
$stmt->execute();

header("Location: ./task_10.php");

?>