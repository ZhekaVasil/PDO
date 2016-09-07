<?php
require 'connect.php';
if(isset($_POST['del'])){
    $stmt = $conn->prepare("DELETE FROM news WHERE name = :name ");
    $stmt->bindParam(':name', $_POST['del']);
    $stmt->execute();
}
$stmt = $conn->query("SELECT name FROM news");
?>
<form method="post" action="">
    <p>Delite news</p>
    <label>Choose news: <select name="del">' ;
            <?php while($data = $stmt->fetch()){
            echo "<option name ='{$data['name']}' value='{$data['name']}'>{$data['name']}</option>";
            }?>
            </select></label>
    <input type='submit' value='DELITE'></form>
<?php
unset($conn);
?>
<a href="news.php">Back</a>