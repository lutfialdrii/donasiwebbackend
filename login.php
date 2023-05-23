<?php

include 'connection.php';

$conn = getConnection();

if($_POST){
    $username = $_POST["username"];
    $password = md5($_POST["password"]);

    try {
        $statement = $conn->prepare("SELECT * FROM user WHERE username = :username AND password = :password");
        $statement->bindParam(":username", $username);
        $statement->bindParam(":password", $password);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $result = $statement->fetch();

        if($result){
            echo json_encode($result);
        } else {
            $response["message"]= "akun tidak ditemukan";
            http_response_code(404);
            echo json_encode($response, JSON_PRETTY_PRINT);
        }

    } catch (PDOException $e){
        $response["message"]= "error $e";
        echo json_encode($response, JSON_PRETTY_PRINT);
    }
}