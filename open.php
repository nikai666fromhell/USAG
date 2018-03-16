<?php

session_start();

$id = $_POST['abrir'];
$_SESSION['active_project'] = $id;

header("location:geraUVM.php");
$_SESSION['new_project'] = 0;

?>