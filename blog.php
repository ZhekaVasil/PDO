<?php
if(!$_GET){
    header("Location: blog.php?page=1");
}
?>
<style>
    img {
        width: 100px;
    }
</style>
<?php
require 'connect.php';
$stm = $conn->query("SELECT * FROM news");
$numOfRows = $stm->rowCount();
$numOfPages = ceil( $numOfRows/2 );
for($i=1; $i<=$numOfPages; $i++){
    echo "<a href='blog.php?page={$i}'><input type='button' value='{$i}'></a>";
}
$page = ($_GET['page']-1)*2;
$stm2 = $conn->query("SELECT * FROM news ORDER BY id DESC LIMIT {$page},2 ");
while ($data = $stm2->fetch()){
    echo " 
  <div>
    <h1>{$data['name']}</h1>
    <p>{$data['text']}</p>
    <hr>
</div>";
}
unset($conn);