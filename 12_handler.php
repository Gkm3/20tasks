<?php
session_start();

$host = 'localhost';
$dbname = 'qwerty';
$username = 'root';
$password = 'Y1zzcK0o-Wb!';

$email = $_POST['email'];
$pass = password_hash($_POST['password'], PASSWORD_DEFAULT);

$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

$sql = "select * from accounts where email=:email";
$stmt = $pdo->prepare($sql);
$stmt->execute(["email" => $email]);
$account = $stmt->fetch(PDO::FETCH_ASSOC);

if(!empty($account)) {
    $_SESSION['danger'] = "Пользователь с такой почтой уже существует!";

    header("Location: ./task_12.php");
} else {
    $query = "insert into accounts (email, password) values (:email, :password)";
    $stmt = $pdo->prepare($query);

    $stmt->execute(["email" => $email, "password" => $pass]);

    $_SESSION['success'] = "Запись успешно добавлена";
    header("Location: ./task_12.php");
}

?>