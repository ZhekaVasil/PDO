<?php
require 'connect.php';
if(isset($_POST['cat_name'])){
    $stmt = $conn->prepare("SELECT id FROM categories WHERE alt_name = :post  ");
    $stmt->bindParam(':post',$_POST['cat_name'] );
    $stmt->execute();
    $id = $stmt->fetch();

    $stmt2 = $conn->prepare("INSERT INTO news (cat_id, name, text) VALUES (:cat_id, :name, :text)");
    $stmt2->bindParam(':cat_id', $id['id'] );
    $stmt2->bindParam(':name', $_POST['name'] );
    $stmt2->bindParam(':text', $_POST['text'] );
    $stmt2->execute();

}
$stmt = $conn->query("SELECT alt_name FROM categories");
?>
<!DOCTYPE html>
<html>
<head>
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script>tinymce.init({ selector:'textarea' });</script>
</head>
<body>

<form method="post" action="">
    <label>Choose category: <select name='cat_name'>
            <?php while ($data = $stmt->fetch()) {
            echo "<option value='{$data['alt_name']}' name='{$data['alt_name']}'>{$data['alt_name']}</option>";
            }?>
        </select></label><br>
    <label>Enter name: <input type='text' name='name'></label>
    <label><textarea name='text'></textarea></label>
    <input type='submit' value='ADD'>
</form>
<?php
unset($conn);
?>
<a href="news.php">Back</a>
</body>
</html>
