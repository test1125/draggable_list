<?php
require 'dbConnect.php';

try{
    $pdo = dbConnect();
    $sql = "SELECT * FROM table1 ORDER BY index_number";
    $stmt = $pdo -> query($sql);
    $count = $stmt->rowCount();

    $sql = "SELECT * FROM table1 WHERE done=0 ORDER BY index_number";
    $todo = $pdo -> query($sql);

    $sql = "SELECT * FROM table1 WHERE done=1 ORDER BY index_number";
    $done = $pdo -> query($sql);

} catch(Exception $e){
    $sql = null;
    $stmt = null;
    $pdo = null;
    $e -> getMessage();
    header("Content-Type: text/plain charset=UTF-8", true, 500);
    exit();
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>draggable_list</title>
    <link rel='stylesheet' href='style.css'></link>
    <link href="https://fonts.googleapis.com/css?family=Caveat rel="stylesheet">

</head>
<body>
    <div class='page'>
        <h1>To Do List</h1>
        <div class='list'>
            <form id='location' action="saveLocation.php" method='post' autocomplete="off">
                <h2>To do</h2>    
                <table>
                        <?php foreach ($todo as $row) {?>
                        <tr class="todo_items line" id=<?=$row['id']?> draggable='true'>
                            <td class='c-box'><input type="checkbox" name='done[]' value=<?=$row['id']?>></td>
                            <td>
                                <?=htmlspecialchars($row['item'], ENT_QUOTES)?>
                                <input type="hidden" name='id_array[]' value=<?=$row['id']?>>
                            </td>
                            <td class='del'>
                                <button name='del' value=<?=$row['id']?> class='del-b'><span title="削除">x</span></button>
                            </td>
                        </tr>
                        <?php } ?>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                </table>

                <h2>Done</h2>
                    <table>
                            <?php foreach ($done as $row) {?>
                            <tr class='line' id='done_items'>
                                <td class='c-box'><input type="checkbox" name='done[]' value=<?=$row['id']?> checked></td>
                                <td>
                                    <?=htmlspecialchars($row['item'], ENT_QUOTES)?>
                                    <input type="hidden" name='id_array[]' value=<?=$row['id']?>>
                                </td>
                                <td class='del'>
                                    <button name='del' value=<?=$row['id']?> class='del-b'><span title="削除">x</span></button>
                                </td>
                            </tr>
                            <?php } ?>
                            <tr class='dumy'>
                                <td><input type="checkbox" name='done[]' value=0 checked></td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                    </table>
            </form>

            <form id='add' action="addItem.php" method='POST'>
                <div>
                new items:
                <input name='new_item'>
                <input type='hidden' name='new_index' value=<?=$count+1?>>
                <button class='marker' name='submit'>add</button>
                </div>
            </form>
        </div>
    </div>
    <script src='script.js'></script>
</body>
</html>