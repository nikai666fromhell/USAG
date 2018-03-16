<?php
session_start();
#Verifica se tem um email para pesquisa
if(isset($_POST['email_login'])){ 

    #Recebe o Email Postado
    $emailPostado = $_POST['email_login'];
    $senhaPostado = $_POST['senha_login'];
    $senhaPostado = MD5($senhaPostado);

    #Conecta banco de dados 
    $connect = mysql_connect('localhost','root','');

    $db = mysql_select_db('usag_db', $connect);

    $query = "SELECT * FROM usag_user WHERE email = '{$emailPostado}' AND pass = '{$senhaPostado}'";

    $query_search = mysql_query($query,$connect);

    #Se o retorno for maior do que zero, diz que já existe um.
  if(mysql_num_rows($query_search) == 1){
      $_SESSION['user'] = mysql_fetch_array($query_search);
      header('Location: iniciarProjeto.php');
      $_SESSION['error_log'] = 5;
    } else {    
        header('Location: createAccount.php');
        $_SESSION['error_log'] = 2;
    }
    
} else {
      header('Location: createAccount.php');
      $_SESSION['error_log'] = 2;
}
?>