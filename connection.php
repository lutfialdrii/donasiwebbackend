<?php

function getConnection(): PDO {
    return new PDO("mysql:host=localhost;dbname=donasi_web","root", "", [PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION]);
}


//try {
//    $conn = new PDO("mysql:host=localhost;dbname=lutproje_donasi","lutproje_user1", "donasiweb", [PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION]);
//    // set the PDO error mode to exception
//    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    echo "Connected successfully";
//}
//catch(PDOException $e)
//{
//    echo "Connection failed: " . $e->getMessage();
//
//}
