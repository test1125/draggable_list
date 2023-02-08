<?php
require 'dbConnect.php';

if(isset($_POST['submit'])){
    try{
        $pdo = dbConnect();

        $sql = 'INSERT INTO table1 (item, done, index_number) values (?, 0, ?)';
        $stmt = $pdo -> prepare($sql);
        
        $new_item = $_POST['new_item'];
        $new_index = $_POST['new_index'];

        $stmt->bindValue(1, $new_item, PDO::PARAM_STR);
        $stmt->bindValue(2, $new_index, PDO::PARAM_INT);
        $stmt->execute();
    } catch (Exception $e) {
    var_dump($e);
    header('Content-Type: text/plain; charset=UTF-8', true, 505);
    exit();
    } finally {
    $stmt = null;
    $pdo = null;
    $new_item = null;
    }
}
header('Location: index.php');
exit();
?>