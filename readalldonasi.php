<?php

include 'connection.php';

$conn = getConnection();

$statement = $conn->query("SELECT * FROM donasi");
$statement->setFetchMode(PDO::FETCH_ASSOC);

$result = $statement->fetchAll();

echo json_encode($result);