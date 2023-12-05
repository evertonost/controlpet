<?php 

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "teste";

try{
    $conn = new PDO("mysql: host=$host; dbname=" . $dbname, $user, $pass);
    //echo "Conexão bem sucedida";
}catch (PDOException $err) {
    echo "erro ao conectar a base de dados" . $err->getMessage();
}

?>