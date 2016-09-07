<?php
require 'connect.php';
if(isset($_POST['name'])){
    $stmt = $conn->prepare("UPDATE categories SET name = :new_name, alt_name = :alt_name WHERE name = :name");
    $stmt->bindParam(':name', $_POST['name']);
    $stmt->bindParam(':new_name', $_POST['new_name']);
    $stmt->bindParam(':alt_name', $_POST['new_alt_name']);
    $stmt->execute();
}
$stmt = $conn->query("SELECT * FROM categories");

?>
<form method="post" action="" name="form" onchange='form.submit()' >
    <p>Edit category:</p>
    <select name="show">
        <?php while ($data = $stmt->fetch()) {
            if($data['name'] == $_POST['show']){
                echo "<option value='{$data['name']}' name='{$data['name']}' selected>{$data['alt_name']}</option>";
            } else {
                echo "<option value='{$data['name']}' name='{$data['name']}'>{$data['alt_name']}</option>";
            }

        }?>
    </select>
</form>
<?php if(isset($_POST['show'])){
    $stmt = $conn->prepare("SELECT alt_name FROM categories WHERE name= :post");
    $stmt->bindParam(':post', $_POST['show']);
    $stmt->execute();
    $alt_name = $stmt->fetch();


}?>
<form method="post" name="form2" action="">
    <input type="text" name="name" value="<?php if(isset($_POST['show'])){echo $_POST['show'];
    }?>" style="display: none">
    <label>Name: <input type="text" name="new_name" value="<?php if(isset($_POST['show'])){echo $_POST['show'];
        }?>"></label>
    <label>Alt name: <input type="text" name="new_alt_name" value="<?php if(isset($_POST['show'])){ echo $alt_name['alt_name'];
        }?>"></label>
    <input type="submit" value="EDIT">
</form>
<?php
unset($conn);
?>
<a href="cat.php">Back</a>
