<?php
if(isset($_POST['name'])){
    require 'connect.php';
    $name = $_POST['name'];
    $alt_name = $_POST['alt_name'];
    $stmt = $conn->prepare("INSERT INTO categories (name, alt_name) VALUES (:name, :alt_name)");
    $stmt->bindParam(':name', $name );
    $stmt->bindParam(':alt_name', $alt_name );
    if($stmt->execute()){
        echo 'Category was successful added';
    } else {
        echo 'Ooops! An Error;';
    };
    unset($conn);
}
?>
<form method="post" action="">
    <p>Add new category</p>
    <label>Name: <input type="text" name="name"></label>
    <label>Alt Name: <input type="text" name="alt_name"></label>
    <input type="submit" value="ADD">
</form>
<a href="cat.php">Back</a>