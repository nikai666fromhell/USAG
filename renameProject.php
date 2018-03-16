<?php

$rename = $_POST['name'];
$id = $_POST['project'];

$connect = mysql_connect('localhost','root','');

$db = mysql_select_db('usag_db', $connect);

$query = "UPDATE user_has_project SET project_name = '$rename' WHERE project_id = '$id'";

$query_project = mysql_query($query,$connect);

header("location:myProjects.php");

?>
