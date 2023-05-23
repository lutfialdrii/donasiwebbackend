<?php

function getConnection(): PDO {
    return new PDO("mysql:host=localhost;dbname=donasi_web","root", "", [PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION]);
}

