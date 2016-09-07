<?php
require 'connect.php';

if(isset($_POST['del'])){
    $stmt2 = $conn->prepare("DELETE FROM categories WHERE name = :name ");
    $stmt2->bindParam(':name', $_POST['del']);
    $stmt2->execute();
    echo 'Category was successful delited';
}
$stmt = $conn->query("SELECT * FROM categories");
?>


<form method="post" action="">
    <p>Delete categoty:</p>
    <select name="del">
        <?php while ($data = $stmt->fetch()) {
            echo "<option value='{$data['name']}' name='{$data['name']}'>{$data['alt_name']}</option>";
        }?>
    </select>
    <input type="submit" value="DELETE">
</form>
<a href="cat.php">Back</a>

<?php
unset($conn);
?>