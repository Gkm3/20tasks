<?php

$filename = $_FILES['image']['name'];
$file_tmpname = $_FILES['image']['tmp_name'];

for($i = 0; $i < count($_FILES['image']['name']); $i++) {
    upload_file($filename[$i], $file_tmpname[$i]);
}



function upload_file($filename, $file_tmpname) {
    $file_parts = new SplFileInfo($filename);
    $extension = $file_parts->getExtension();
    $unique_name = uniqid() . '.' . $extension;
    $path_to_file = "./upload" . '/' . $unique_name;

    move_uploaded_file($file_tmpname, $path_to_file);

    upload_file_to_db($unique_name);
}

function upload_file_to_db($unique_name) {
    include "./db_conn.php";

    $query = "insert into images (name) values (:name)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":name", $unique_name);

    $stmt->execute();
    header("Location: ./task_19.php");
}

?>