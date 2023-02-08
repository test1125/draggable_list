<?php
require 'dbConnect.php';

if (isset($_POST['done'])){
    try{
        echo 'done<br>';
        $pdo = dbConnect();
        $pdo -> query("UPDATE table1 SET done = 0");
        $sql = "UPDATE table1 SET done = 1 WHERE id = ?";
        $stmt = $pdo -> prepare($sql);

        $done_array = $_POST['done'];
        foreach ($done_array as $done_id){
            $stmt -> bindValue(1, $done_id, PDO::PARAM_INT);
            $stmt -> execute();
        }
    } catch(Exception $e) {
        header('Content-Type: text/plain, cherset=UTF-8', true, 500);
        exit;
    } finally {
        $stmt = null;
        $pdo = null;
    }
}


if (isset($_POST['del'])){
    try {
        echo 'del';
        $pdo = dbConnect();
        $sql = "DELETE FROM table1 WHERE id = ?";
        $stmt = $pdo -> prepare($sql);

        $del_id = $_POST['del'];
        $stmt -> bindValue(1, $del_id, PDO::PARAM_INT);
        $stmt -> execute();
    } catch(Exception $e) {
        header('Content-Type: text/plain, charset=UTF-8', true, 500);
        exit;
    } finally {
        $stmt = null;
        $pdo = null;
    }
}

if (isset($_POST['id_array'])){
    try {
        $pdo = dbConnect();
        $sql = "UPDATE table1 SET index_number = ? WHERE id = ?";
        $stmt = $pdo -> prepare($sql);

        $id_array = $_POST['id_array'];
        $num = count($id_array) - 1;
        var_dump($id_array);

        for ($i=0; $i <= $num; $i++){
            $id_elm = $id_array[$i];
            // echo "id={$var2}のindexを{$var1}に変更しました。";
            $stmt -> bindValue(1, $i+1, PDO::PARAM_STR); //1~順番を振る
            $stmt -> bindValue(2, $id_elm, PDO::PARAM_INT);
            $stmt -> execute();
        }
    } catch(Exception $e) {
        header('Content-Type: text/plain, charset=UTF-8', true, 500);
        // echo $e -> getMessage();
        exit();

    } finally {
        $stmt = null;
        $pdo = null;
    }
}
header("Location: index.php");
exit();
?>