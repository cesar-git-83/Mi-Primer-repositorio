<?php
session_start();

include '../model/database_connection.php';
$usuario = $_POST['usuario'];
$password = $_POST['password'];

$stm = $connect->prepare("SELECT COUNT(*) AS n FROM login WHERE usuario = ? and password = ?");
$stm->bindParam(1, $usuario, PDO::PARAM_STR);
$stm->bindParam(2, $password, PDO::PARAM_STR);
$stm->execute();
$st = $stm->Fetch(PDO::FETCH_OBJ);

if($st->n == 1){
  $_SESSION['usuario'] = $_POST['usuario'];
  $_SESSION['password'] = $_POST['password'];
  include 'header.php';
}
else{
  header('Location:../index.php');
}
 ?>
