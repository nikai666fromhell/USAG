<?php
session_start();

$connect = mysql_connect('localhost','root','');

$id = $_SESSION['active_project'];

$user = $_SESSION['user'][0];

$name = $_POST['name'];

$content = $_POST['content'];

$db = mysql_select_db('usag_db', $connect);

$query = "INSERT INTO project_has_files (id_project, file_name) VALUES ('$id','$name')";

$query_project = mysql_query($query,$connect);

$folder = "projetos/".$user."/".$id."/";

chdir($folder);

$make_name = $name;
	$make = $content;
		$f = @fopen($make_name, "r+");
			if ($f !== false) {
   				ftruncate($f, 0);
   		 		fclose($f);
			}
$fp = fopen($make_name, "a");
$escreve = fwrite($fp, $make);
fclose($fp);

?>