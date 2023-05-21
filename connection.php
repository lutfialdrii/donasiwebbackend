<?php
try{
    $conn = new PDO("mysql:host=localhost;dbname=donasi_web","root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e){
    echo $e;
}

