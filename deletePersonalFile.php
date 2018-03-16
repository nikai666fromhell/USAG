<?php
session_start();

$connect = mysql_connect('localhost','root','');

$user = $_SESSION['user'][0];

$project = $_POST['project'];

$filename = $_POST['file'];

$db = mysql_select_db('usag_db', $connect);

$query = "DELETE FROM project_has_files WHERE id_project ='$project' AND file_name = '$filename'";

$query_project = mysql_query($query,$connect);

$folder = "projetos/".$user."/".$project."/";

chdir($folder);

fclose($filename);

unlink($filename);

?>