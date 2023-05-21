<?php

include 'connection.php';

if(isset($_GET["id"])){
    $id = $_GET["id"];

    $statement = $conn->prepare("DELETE FROM donasi WHERE id = :id");
    $statement->bindParam("id", $id);
    $statement->execute();

    $response['message'] = "Delete Data Berhasil";

} else {
    $response['message'] = "Delete Data Gagal";
}

$json = json_encode($response, JSON_PRETTY_PRINT);
echo $json;
