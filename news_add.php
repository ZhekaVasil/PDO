<?php
require 'connect.php';
if(isset($_POST['cat_name'])){
    $fileSRC ='';
    if(is_uploaded_file($_FILES["filename"]["tmp_name"]))
    {
        $file = iconv('utf-8', 'utf-8', $_FILES["filename"]["name"]);
        move_uploaded_file($_FILES["filename"]["tmp_name"], "upload/".$file );
        $fileSRC = '<img src="upload/'.$file.'">';
    } else {
       /* echo("Ошибка загрузки файла");*/
    }
    $stmt = $conn->prepare("SELECT id FROM categories WHERE alt_name = :post  ");
    $stmt->bindParam(':post',$_POST['cat_name'] );
    $stmt->execute();
    $id = $stmt->fetch();

    $stmt2 = $conn->prepare("INSERT INTO news (cat_id, name, text) VALUES (:cat_id, :name, :text)");
    $stmt2->bindParam(':cat_id', $id['id'] );
    $stmt2->bindParam(':name', $_POST['name'] );
    if(strlen($fileSRC)){
        $pic = $fileSRC."<br>".$_POST['text'];
        $stmt2->bindParam(':text', $pic );
    } else {
        $stmt2->bindParam(':text', $_POST['text'] );
    }

    if($stmt2->execute()){
        header("Location: blog.php");
    };

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

<form method="post" action="" enctype="multipart/form-data" accept-charset="utf-8">
    <label>Choose category: <select name='cat_name'>
            <?php while ($data = $stmt->fetch()) {
            echo "<option value='{$data['alt_name']}' name='{$data['alt_name']}'>{$data['alt_name']}</option>";
            }?>
        </select></label><br>
    <label>Enter name: <input type='text' name='name'></label><br>
    <input type="file" name="filename" id="file" multiple>
    <label><textarea name='text'></textarea></label>
    <input type='submit' value='ADD'>
</form>

<?php
unset($conn);
?>
<a href="news.php">Back</a>
</body>
</html>
