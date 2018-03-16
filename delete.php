<?php 
session_start();

$delete = $_POST['yes'];

$user = $_SESSION['user'][0];

if($_SESSION['active_project']==$delete){
	unset($_SESSION['active_project']);
}

$dir = "projetos/".$user."/".$delete."/";

echo $dir;

$connect = mysql_connect('localhost','root','');

$db = mysql_select_db('usag_db', $connect);

$query = "DELETE FROM user_has_project WHERE project_id = '$delete'";

$query_project = mysql_query($query,$connect);

/*
/ Deletar diretório
/-------------------------------------------------- */
if (is_dir($dir)) { 
    $objects = scandir($dir); 
     foreach ($objects as $object) { 
       if ($object != "." && $object != "..") { 
         if (is_dir($dir."/".$object)){
           rrmdir($dir."/".$object);
         }
         else{
           unlink($dir."/".$object); 
          }
       } 
     }
  rmdir($dir); 
 } 

header("location:myProjects.php");

?>