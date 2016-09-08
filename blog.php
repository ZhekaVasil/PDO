<?php
require 'connect.php';
$stm = $conn->query("SELECT * FROM news");
while ($data = $stm->fetch()){
    echo " 
  <div>
    <h1>{$data['name']}</h1>
</div>";
}