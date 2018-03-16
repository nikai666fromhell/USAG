<?php 
chmod ('C:/xampp/htdocs/iluminacao/imagens', 0777);
chmod ('C:/xampp/htdocs/imagens', 0777);
header('Content-Type: text/html; charset=utf-8');
$nome_u = $_POST['nome'];
$email = $_POST['email'];
$senha = MD5($_POST['senha']);
$imagem = $_FILES[ 'imagem' ];

$connect = mysql_connect('localhost','root','');

if ( isset( $_FILES[ 'imagem' ][ 'name' ] ) && $_FILES[ 'imagem' ][ 'error' ] == 0 ) {
    echo 'Você enviou o arquivo: <strong>' . $_FILES[ 'imagem' ][ 'name' ] . '</strong><br />';
    echo 'Este arquivo é do tipo: <strong > ' . $_FILES[ 'imagem' ][ 'type' ] . ' </strong ><br />';
    echo 'Temporáriamente foi salvo em: <strong>' . $_FILES[ 'imagem' ][ 'tmp_name' ] . '</strong><br />';
    echo 'Seu tamanho é: <strong>' . $_FILES[ 'imagem' ][ 'size' ] . '</strong> Bytes<br /><br />';
 
    $arquivo_tmp = $_FILES[ 'imagem' ][ 'tmp_name' ];
    $nome = $_FILES[ 'imagem' ][ 'name' ];
 
    // Pega a extensão
    $extensao = pathinfo ( $nome, PATHINFO_EXTENSION );
 
    // Converte a extensão para minúsculo
    $extensao = strtolower ( $extensao );
 
    // Somente imagens, .jpg;.jpeg;.gif;.png
    // Aqui eu enfileiro as extensões permitidas e separo por ';'
    // Isso serve apenas para eu poder pesquisar dentro desta String
  if ( strstr ( '.jpg;.jpeg;.gif;.png', $extensao ) ) {
        // Cria um nome único para esta imagem
        // Evita que duplique as imagens no servidor.
        // Evita nomes com acentos, espaços e caracteres não alfanuméricos
       $novoNome = ltrim(uniqid ( time () ) .$nome_u.".".$extensao);


        // Concatena a pasta com o nome
        $destino = 'imagens/' . $novoNome;
        echo $destino;
        
        // tenta mover o arquivo para o destino
        if ( @move_uploaded_file ( $arquivo_tmp, $destino ) ) {
            echo 'Arquivo salvo com sucesso em : <strong>' . $destino . '</strong><br />';
            echo ' < img src = "' . $destino . '" />';
       }
        else
            echo 'Erro ao salvar o arquivo. Aparentemente você não tem permissão de escrita.<br />';
    } 
    else
        echo 'Você poderá enviar apenas arquivos "*.jpg;*.jpeg;*.gif;*.png"<br />';
}
else
    echo 'Você não enviou nenhum arquivo!';


//Conexão com o BD
if (!$connect)
die ("Erro de conexão com localhost, o seguinte erro ocorreu -> ".mysql_error());
$db = mysql_select_db('usag_db', $connect);
mysql_query("SET NAMES 'utf8'");
mysql_query('SET character_set_connection=utf8');
mysql_query('SET character_set_client=utf8');
mysql_query('SET character_set_results=utf8');
$query = "INSERT INTO usag_user (name,email,pass,image) VALUES ('$nome_u', '$email', '$senha','$novoNome')";
$query_insert = mysql_query($query,$connect);
header("location:geraUVM.php");
?>
