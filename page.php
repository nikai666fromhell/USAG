<?php
	$user = $_POST['user'];
	$project = $_POST['project'];

	$folder = "projetos/".$user."/".$project."/";

	chdir($folder);

/****************************************************************************/
//            		Geração do log de acesso no servidor                   //
/****************************************************************************/

	$make_name = "Log de Acesso.txt";
	$make = "Aparentemente o senhor chegou no arquivo, pasta para salvar: ".$folder.$make_name;


	$f = @fopen($make_name, "r+");
		if ($f !== false) {
   			ftruncate($f, 0);
   		 	fclose($f);
	}

	$fp = fopen($make_name, "a");
    $escreve = fwrite($fp, $make);
    fclose($fp);


/****************************************************************************/
//                 			Conexão ao banco de dados  	                    //
/****************************************************************************/

	$connect = mysql_connect('localhost','root','');

	$db = mysql_select_db('usag_db', $connect);



/****************************************************************************/
//                  Gera o arquivo físico da interface                      //
/****************************************************************************/
	$if_name = $_POST["name_interface"];
	$interface = $_POST["interface"];

	$f = @fopen($folder.$if_name, "r+");
		if ($f !== false) {
   			ftruncate($f, 0);
   		 	fclose($f);
	}
	$breaks = array("<br />","<br>","<br/>");  
    $interface = str_ireplace($breaks, "\r\n", $interface);

	$fp = fopen($if_name, "w+");
    $escreve = fwrite($fp, $interface);
    fclose($fp); 

/****************************************************************************/
//           Inserção arquivo de interface no banco de dados                //
/****************************************************************************/

    $query_not_same = "SELECT * FROM project_has_files WHERE id_project = '{$project}' AND file_name = '{$if_name}'";

    $query_search = mysql_query($query_not_same,$connect);

    #Se o retorno for maior do que zero, diz que já existe um.
  if(mysql_num_rows($query_search) == 0){

    $query = "INSERT INTO project_has_files (id_project, file_name) VALUES ('$project','$if_name')";

	$query_project = mysql_query($query,$connect);
}

 /****************************************************************************/
//                  Gera o arquivo físico do monitor                        //
/****************************************************************************/

    $mon_name = $_POST["name_monitor"];
	$monitor = $_POST["monitor"];
	
	$f = @fopen($folder.$mon_name, "r+");
		if ($f !== false) {
   			ftruncate($f, 0);
   		 	fclose($f);
	}

	$breaks = array("<br />","<br>","<br/>");  
    $monitor = str_ireplace($breaks, "\r\n", $monitor);

	$fp = fopen($mon_name, "w+");
    $escreve = fwrite($fp, $monitor);
    fclose($fp); 


/****************************************************************************/
//           Inserção arquivo do monitor no banco de dados                  //
/****************************************************************************/

 $query_not_same = "SELECT * FROM project_has_files WHERE id_project = '{$project}' AND file_name = '{$mon_name}'";

    $query_search = mysql_query($query_not_same,$connect);

    #Se o retorno for maior do que zero, diz que já existe um.
  if(mysql_num_rows($query_search) == 0){

    $query = "INSERT INTO project_has_files (id_project, file_name) VALUES ('$project','$mon_name')";

	$query_project = mysql_query($query,$connect);
}

 /****************************************************************************/
//                  Gera o arquivo físico do driver                         //
/****************************************************************************/

	$dvr_name = $_POST["name_driver"];
	$driver = $_POST["driver"];
	
	$f = @fopen($dvr_name, "r+");
		if ($f !== false) {
   			ftruncate($f, 0);
   		 	fclose($f);
	}

	$breaks = array("<br />","<br>","<br/>");  
    $driver = str_ireplace($breaks, "\r\n", $driver);

	$fp = fopen($dvr_name, "a");
    $escreve = fwrite($fp, $driver);
    fclose($fp); 

/****************************************************************************/
//           Inserção arquivo do driver no banco de dados            	    //
/****************************************************************************/
  $query_not_same = "SELECT * FROM project_has_files WHERE id_project = '{$project}' AND file_name = '{$dvr_name}'";

    $query_search = mysql_query($query_not_same,$connect);

    #Se o retorno for maior do que zero, diz que já existe um.
  if(mysql_num_rows($query_search) == 0){

    $query = "INSERT INTO project_has_files (id_project, file_name) VALUES ('$project','$dvr_name')";

	$query_project = mysql_query($query,$connect);

}
/****************************************************************************/
//                 Gera o arquivo físico do package                         //
/****************************************************************************/

	$pkg_name = $_POST["name_package"];
	$package = $_POST["package"];
	
	$f = @fopen($pkg_name, "r+");
		if ($f !== false) {
   			ftruncate($f, 0);
   		 	fclose($f);
	}

	$breaks = array("<br />","<br>","<br/>");  
    $package = str_ireplace($breaks, "\r\n", $package);

	$fp = fopen($pkg_name, "a");
    $escreve = fwrite($fp, $package);
    fclose($fp);

/****************************************************************************/
//           Inserção arquivo do package no banco de dados            	    //
/****************************************************************************/
  $query_not_same = "SELECT * FROM project_has_files WHERE id_project = '{$project}' AND file_name = '{$pkg_name}'";

    $query_search = mysql_query($query_not_same,$connect);

    #Se o retorno for maior do que zero, diz que já existe um.
  if(mysql_num_rows($query_search) == 0){


    $query = "INSERT INTO project_has_files (id_project, file_name) VALUES ('$project','$pkg_name')";

	$query_project = mysql_query($query,$connect);
}

/****************************************************************************/
//                 Gera o arquivo físico do sequencer                       //
/****************************************************************************/

	$seq_name = $_POST["name_sequencer"];
	$sequencer = $_POST["sequencer"];
	
	$f = @fopen($seq_name, "r+");
		if ($f !== false) {
   			ftruncate($f, 0);
   		 	fclose($f);
	}

	$breaks = array("<br />","<br>","<br/>");  
    $sequencer = str_ireplace($breaks, "\r\n", $sequencer);

	$fp = fopen($seq_name, "a");
    $escreve = fwrite($fp, $sequencer);
    fclose($fp); 

/****************************************************************************/
//          Inserção arquivo do sequencer no banco de dados            	    //
/****************************************************************************/

 $query_not_same = "SELECT * FROM project_has_files WHERE id_project = '{$project}' AND file_name = '{$seq_name}'";

    $query_search = mysql_query($query_not_same,$connect);

    #Se o retorno for maior do que zero, diz que já existe um.
  if(mysql_num_rows($query_search) == 0){
    $query = "INSERT INTO project_has_files (id_project, file_name) VALUES ('$project','$seq_name')";

	$query_project = mysql_query($query,$connect);
 
}
/****************************************************************************/
//                 Gera o arquivo físico da configuração                    //
/****************************************************************************/

	$config_name = $_POST["name_configuration"];
	$configuration = $_POST["configuration"];
	
	$f = @fopen($config_name, "r+");
		if ($f !== false) {
   			ftruncate($f, 0);
   		 	fclose($f);
	}

	$breaks = array("<br />","<br>","<br/>");  
    $configuration = str_ireplace($breaks, "\r\n", $configuration);

	$fp = fopen($config_name, "a");
    $escreve = fwrite($fp, $configuration);
    fclose($fp); 


/****************************************************************************/
//          Inserção arquivo da configuração no banco de dados        	    //
/****************************************************************************/
 $query_not_same = "SELECT * FROM project_has_files WHERE id_project = '{$project}' AND file_name = '{$config_name}'";

    $query_search = mysql_query($query_not_same,$connect);

    #Se o retorno for maior do que zero, diz que já existe um.
  if(mysql_num_rows($query_search) == 0){

    $query = "INSERT INTO project_has_files (id_project, file_name) VALUES ('$project','$config_name')";

	$query_project = mysql_query($query,$connect);
 
 }

/****************************************************************************/
//                 Gera o arquivo físico do scoreboard                      //
/****************************************************************************/

	$score_name = $_POST["name_scoreboard"];
	$scoreboard = $_POST["scoreboard"];
	
	$f = @fopen($score_name, "r+");
		if ($f !== false) {
   			ftruncate($f, 0);
   		 	fclose($f);
	}

	$breaks = array("<br />","<br>","<br/>");  
    $scoreboard = str_ireplace($breaks, "\r\n", $scoreboard);

	$fp = fopen($score_name, "a");
    $escreve = fwrite($fp, $scoreboard);
    fclose($fp);

/****************************************************************************/
//           Inserção arquivo do scoreboard no banco de dados          	    //
/****************************************************************************/
 $query_not_same = "SELECT * FROM project_has_files WHERE id_project = '{$project}' AND file_name = '{$pkg_name}'";

    $query_search = mysql_query($query_not_same,$connect);

    #Se o retorno for maior do que zero, diz que já existe um.
  if(mysql_num_rows($query_search) == 0){
    $query = "INSERT INTO project_has_files (id_project, file_name) VALUES ('$project','$pkg_name')";

	$query_project = mysql_query($query,$connect);
}

/****************************************************************************/
//                 Gera o arquivo físico do enviroment                      //
/****************************************************************************/

	$env_name = $_POST["name_enviroment"];
	$enviroment = $_POST["enviroment"];
	
	$f = @fopen($env_name, "r+");
		if ($f !== false) {
   			ftruncate($f, 0);
   		 	fclose($f);
	}

	$breaks = array("<br />","<br>","<br/>");  
    $enviroment = str_ireplace($breaks, "\r\n", $enviroment);

	$fp = fopen($env_name, "a");
    $escreve = fwrite($fp, $enviroment);
    fclose($fp);

/****************************************************************************/
//           Inserção arquivo do enviroment no banco de dados          	    //
/****************************************************************************/
 $query_not_same = "SELECT * FROM project_has_files WHERE id_project = '{$project}' AND file_name = '{$env_name}'";

    $query_search = mysql_query($query_not_same,$connect);

    #Se o retorno for maior do que zero, diz que já existe um.
  if(mysql_num_rows($query_search) == 0){
    $query = "INSERT INTO project_has_files (id_project, file_name) VALUES ('$project','$env_name')";

	$query_project = mysql_query($query,$connect);

}
/****************************************************************************/
//                 Gera o arquivo físico do test                            //
/****************************************************************************/

	$test_name = $_POST["name_test"];
	$test = $_POST["test"];
	
	$f = @fopen($test_name, "r+");
		if ($f !== false) {
   			ftruncate($f, 0);
   		 	fclose($f);
	}

	$breaks = array("<br />","<br>","<br/>");  
    $test = str_ireplace($breaks, "\r\n", $test);

	$fp = fopen($test_name, "a");
    $escreve = fwrite($fp, $test);
    fclose($fp);
/****************************************************************************/
//		           Inserção arquivo do test no banco de dados          	    //
/****************************************************************************/

 $query_not_same = "SELECT * FROM project_has_files WHERE id_project = '{$project}' AND file_name = '{$test_name}'";

    $query_search = mysql_query($query_not_same,$connect);

    #Se o retorno for maior do que zero, diz que já existe um.
  if(mysql_num_rows($query_search) == 0){

    $query = "INSERT INTO project_has_files (id_project, file_name) VALUES ('$project','$test_name')";

	$query_project = mysql_query($query,$connect);
}

/****************************************************************************/
//                 Gera o arquivo físico do agent                           //
/****************************************************************************/

	$agent_name = $_POST["name_agent"];
	$agent = $_POST["agent"];
	
	$f = @fopen($agent_name, "r+");
		if ($f !== false) {
   			ftruncate($f, 0);
   		 	fclose($f);
	}

	$breaks = array("<br />","<br>","<br/>");  
    $agent = str_ireplace($breaks, "\r\n", $agent);

	$fp = fopen($agent_name, "a");
    $escreve = fwrite($fp, $agent);
    fclose($fp);

/****************************************************************************/
//           Inserção arquivo do agent no banco de dados          	        //
/****************************************************************************/

 $query_not_same = "SELECT * FROM project_has_files WHERE id_project = '{$project}' AND file_name = '{$agent_name}'";

    $query_search = mysql_query($query_not_same,$connect);

    #Se o retorno for maior do que zero, diz que já existe um.
  if(mysql_num_rows($query_search) == 0){
    $query = "INSERT INTO project_has_files (id_project, file_name) VALUES ('$project','$agent_name')";

	$query_project = mysql_query($query,$connect);
}
/****************************************************************************/
//                 Gera o arquivo físico do top block                       //
/****************************************************************************/

	$top_name = $_POST["name_top"];
	$top = $_POST["top"];
	
	$f = @fopen($top_name, "r+");
		if ($f !== false) {
   			ftruncate($f, 0);
   		 	fclose($f);
	}

	$breaks = array("<br />","<br>","<br/>");  
    $top = str_ireplace($breaks, "\r\n", $top);

	$fp = fopen($top_name, "a");
    $escreve = fwrite($fp, $top);
    fclose($fp);

/****************************************************************************/
//           Inserção arquivo do top block no banco de dados          	    //
/****************************************************************************/
 $query_not_same = "SELECT * FROM project_has_files WHERE id_project = '{$project}' AND file_name = '{$top_name}'";

    $query_search = mysql_query($query_not_same,$connect);

    #Se o retorno for maior do que zero, diz que já existe um.
  if(mysql_num_rows($query_search) == 0){
    $query = "INSERT INTO project_has_files (id_project, file_name) VALUES ('$project','$top_name')";

	$query_project = mysql_query($query,$connect);
}
/****************************************************************************/
//                 Gera o arquivo físico do Makefile                       //
/****************************************************************************/

	$make_name = $_POST["name_make"];
	$make = $_POST["make"];
	
	$f = @fopen($make_name, "r+");
		if ($f !== false) {
   			ftruncate($f, 0);
   		 	fclose($f);
	}

	$breaks = array("<br />","<br>","<br/>");  
    $make = str_ireplace($breaks, "\r\n", $make);

	$fp = fopen($make_name, "a");
    $escreve = fwrite($fp, $make);
    fclose($fp);

/****************************************************************************/
//           Inserção arquivo do Makefile no banco de dados          	    //
/****************************************************************************/
 $query_not_same = "SELECT * FROM project_has_files WHERE id_project = '{$project}' AND file_name = '{$make_name}'";

    $query_search = mysql_query($query_not_same,$connect);

    #Se o retorno for maior do que zero, diz que já existe um.
  if(mysql_num_rows($query_search) == 0){
    $query = "INSERT INTO project_has_files (id_project, file_name) VALUES ('$project','$make_name')";

	$query_project = mysql_query($query,$connect);
			}
	chdir("../../..");

?>
 