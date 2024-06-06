<?php
session_start();

$host = 'localhost';
$dbname = 'qwerty';
$username = 'root';
$password = 'Y1zzcK0o-Wb!';

$email = $_POST['email'];
$pass = $_POST['password'];

$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

$sql = "select * from accounts where email=:email";
$stmt = $pdo->prepare($sql);
$stmt->execute(["email" => $email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if(empty($user)) {
    $_SESSION['danger'] = "Неверный логин или пароль!";

    header("Location: ./task_15.php");
    exit;
}
if(!password_verify($pass, $user['password'])) {
    $_SESSION['danger'] = "Неверный логин или пароль!";

    header("Location: ./task_15.php");
    exit;
}

$_SESSION['user'] = ["id" => $user['id'], "email" => $user['email']];
$_SESSION['success'] = "Здравствуйте, ";
header("Location: ./task_16.php");
?>
