<?php 

try{
    $db = new PDO("mysql:host=localhost:3306;dbname=codingo;charset=utf8","root","");
}catch(PDOException $e){
    echo $e->getMessage();
}

?>