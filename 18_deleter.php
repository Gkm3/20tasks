<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$filename = $_SESSION['image']['name'];

if(file_exists("./upload/".$filename)) {
    delete_file($filename);
    delete_file_from_db($filename);
}


function delete_file($filename) {
    $path = "./upload" . "/" . $filename;
    unlink($path);

}

function delete_file_from_db($filename) {
    include_once "./db_conn.php";

    $query = "delete from images where name=:name";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":name", $filename);

    $stmt->execute();
}

header("Location: ./task_18.php");

?>