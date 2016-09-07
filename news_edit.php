<?php
require 'connect.php';
if(isset($_POST['name'])){
    $stmt = $conn->prepare("UPDATE news SET name = :new_name, text = :new_text WHERE name = :name");
    $stmt->bindParam(':name', $_POST['name']);
    $stmt->bindParam(':new_name', $_POST['new_name']);
    $stmt->bindParam(':new_text', $_POST['new_text']);
    $stmt->execute();
}
$stmt = $conn->query("SELECT * FROM news");

?>
<!DOCTYPE html>
<html>
<head>
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script>tinymce.init({ selector:'textarea' });</script>
</head>
<body>


<form method="post" action="" name="form" onchange='form.submit()' >
    <label>Edit news:</label>
    <select name="show">
        <option>Choose news</option>
        <?php while ($data = $stmt->fetch()) {
            if($data['name'] == $_POST['show']){
                echo "<option value='{$data['name']}' name='{$data['name']}' selected>{$data['name']}</option>";
            } else {
                echo "<option value='{$data['name']}' name='{$data['name']}'>{$data['name']}</option>";
            }

        }?>
    </select>
</form>
<?php if(isset($_POST['show'])){
    $stmt = $conn->prepare("SELECT text FROM news WHERE name = :post  ");
    $stmt->bindParam(':post',$_POST['show'] );
    $stmt->execute();
    $text = $stmt->fetch();



}?>
<form method="post" name="form2" action="">
    <input type="text" name="name" value="<?php if(isset($_POST['show'])){echo $_POST['show'];
    }?>" style="display: none">
    <label>Name: <input type="text" name="new_name" value="<?php if(isset($_POST['show'])){echo $_POST['show'];
        }?>"></label>
    <label><textarea name="new_text"><?php if(isset($_POST['show'])){ echo $text['text'];
        }?></textarea></label>
    <input type="submit" value="EDIT">
</form>

<?php
unset($conn);
?>
<a href="news.php">Back</a>
</body>
</html>
