<?php
session_start();

$host = 'localhost';
$dbname = 'qwerty';
$username = 'root';
$password = 'Y1zzcK0o-Wb!';
$paragraph = $_POST['paragraph'];

$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

$sql = "select * from articles where paragraph=:paragraph";
$stmt = $pdo->prepare($sql);
$stmt->execute(["paragraph" => $paragraph]);
$task = $stmt->fetch(PDO::FETCH_ASSOC);

if (!empty($task)) {
    $_SESSION['danger'] = 'Введенная запись уже присутствует!';
    header("Location: ./task_11.php");
} else {
    $query = "insert into articles (paragraph) values (:paragraph)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":paragraph", $paragraph);

    $stmt->execute();

    $_SESSION['success'] = "Запись успешно добавлена";
    header("Location: ./task_11.php");
}




?>