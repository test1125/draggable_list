<?php
function dbConnect(){
    $dsn = "mysql:dbname=draggable_list; host=localhost; charset=utf8mb4";
    $usr = "root";
    $pwd = "";

    try{
        $pdo = new PDO($dsn, $usr, $pwd);
    }catch(PDOException $e) {
        throw $e;
    }
    $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $pdo;
}
?>