<?php 
session_start();

$user = $_SESSION['user']['0'];

echo $user;
$connect = mysql_connect('localhost','root','');

$db = mysql_select_db('usag_db', $connect);

$query = "INSERT INTO user_has_projects (user_id) VALUES ('$user')";

$query_project = mysql_query($query,$connect);

$_SESSION['active_project'] = mysql_insert_id();
$_SESSION['new_project'] =  1;
echo $_SESSION['active_project'];

mkdir('projetos/'.$user.'/'.mysql_insert_id().'/', 0777, true);	

header("location: geraUVM.php");

?>