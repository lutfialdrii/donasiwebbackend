<?php

include 'connection.php';

if($_POST){
    $id = $_POST["id"];

    $statement = $conn->prepare("SELECT * FROM donasi WHERE id = :id");
    $statement->bindParam(':id', $id);
    $statement->execute();
    $statement->setFetchMode(PDO::FETCH_OBJ);
    $result = $statement->fetch();

    echo json_encode($result);
}