<?php
#Verifica se tem um email para pesquisa
if(isset($_POST['email'])){ 

    #Recebe o Email Postado
    $emailPostado = $_POST['email'];

    #Conecta banco de dados 
    $connect = mysql_connect('localhost','root','');

    $db = mysql_select_db('usag_db', $connect);

    $query = "SELECT * FROM usag_user WHERE email = '{$emailPostado}'";

    $query_search = mysql_query($query,$connect);

    #Se o retorno for maior do que zero, diz que já existe um.
    if(mysql_num_rows($query_search)>0) 
        echo json_encode(array('email' => 'Já existe um usuário cadastrado com este e-mail.','validador' => '0')); 
    else 
        echo json_encode(array('email' => '', 'validador' => '1')); 
}
?>