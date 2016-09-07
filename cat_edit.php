<?php
require 'connect.php';
$stmt = $conn->query("SELECT * FROM categories");
?>
<form method="post" action="">
    <p>Edit category:</p>
    <select name="edit">
        <?php while ($data = $stmt->fetch()) {
            echo "<option value='{$data['name']}' name='{$data['name']}'>{$data['alt_name']}</option>";
        }?>
    </select>
</form>
<a href="cat.php">Back</a>
