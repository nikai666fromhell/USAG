<!DOCTYPE html>

<?php 
/****************************************************************************/
//                        Verificação de usuário ativo                      //
/****************************************************************************/
session_start();
if(!isset($_SESSION['user'])){
        header('Location: createAccount.php');
  } else {
    if(!isset($_SESSION['active_project'])){
      header('Location: iniciarProjeto.php');
    }
  }
 $_SESSION['error_log'] = 0;
 if($_SESSION['new_project'] == 1){
  $isReload = 0;
 } else {
  $isReload = 1;
 }
?>

<?php 
/****************************************************************************/
//                        Importação de bibliotecas                         //
/****************************************************************************/
?>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>USAG</title>
  <script src="js/jquery-1.12.0.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/functions.js"></script>

  <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/jquery-ui.css" rel="stylesheet" type="text/css">
  <link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<body>

<?php 
/****************************************************************************/
//                        Criação da NavBar                                 //
/****************************************************************************/
?>

  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <nav class="navbar navbar-default navbar-inverse navbar-fixed-top" role="navigation" style="border-radius:0px;">
          
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
              <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
            </button> <a class="navbar-brand" href="#">USAG</a>
          </div>
          
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
              <li>
                <a href="index.php"> What is it? </a>
              </li>
              <li>
                <a href="download.php"> Download </a>
              </li>
              <li class="active">
                <a href="geraUVM.php"> UVM Environment Generator</a>
              </li>
            </ul>
            
            <ul class="nav navbar-nav navbar-right nav-pos">
              <li> 
                <?php if(isset($_SESSION['user'])){
                        if((!empty(trim($_SESSION['user']['image'])))){

                          echo "<img src='imagens/".$_SESSION['user']['image']."' alt='user-login' class = 'img-circle' id = 'user-login'>";}
                          else {
                            echo "<img src='img/user.png' alt='user-login' class = 'img-circle' id = 'user-login'>";
                          } 
                      }?>
              
              </li>
              <li class="login dropdown-large">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"> 
                 <?php if(isset($_SESSION['user'])){
                        if((!empty(trim($_SESSION['user']['name'])))){
                          echo $_SESSION['user']['name']; }
                          else {
                            echo "Login";
                          } 
                      }?> <strong class="caret"></strong></a>

                <ul class="dropdown-menu dropdown-menu-large">
                  <li>
                  
                    <a class="dropdown_item" href="myProjects.php">My Projects</a>
                  </li>
                  <li> 
                    <form name="logout" action="logout.php" method="POST" enctype="multipart/form-data">
                      <button type="submit" class="btn btn-default" id="logout_button">
                        Logout
                      </button>
                      </form>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav> 
    </div>  
</div>
<br>
<br>
<br>
<br>
<?php 
/****************************************************************************/
//                   Campo de entrada de dados do usuário                   //
/****************************************************************************/
?>
  <div class="form-group">
      <div class="col-md-6">  
        <?php echo "O projeto ativo é o: ".$_SESSION['active_project']; ?>
        
        <div id = "project_id" style="display:none"><?php echo $_SESSION['active_project'];?></div>
        <div id = "user_id" style="display:none"><?php echo $_SESSION['user']['id_user'];?></div>
        <p id="code-input">Insert the DUT in SystemVerilog code: </p>
          <div id = "alert-module" class="alert alert-danger" style="display:none" role="alert">The main code must start with 'module'</div>
          <div id = "alert-null" class="alert alert-danger" style="display:none" role="alert">No code was detected</div>
          <pre><code><textarea style="resize:none" class="form-control" id="design" name="design" rows="20"></textarea></code></pre>  
          <button type="button" class="btn btn-success" onclick="catcher()"> Create UVM Environment
            <span class="glyphicon glyphicon-play"></span>
        </button>
        <ul>

      </div>
  </div>
<?php 
/****************************************************************************/
//                   Abas/Divs para a exibição dos dados gerados            //
/****************************************************************************/
?>
  <div class="form-group">
    <div class="col-md-6"> 
      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#newFile"><span class="glyphicon glyphicon-file" aria-hidden="true"></span> Create a New File</button>
      <?php if($isReload == 1){?>
      <button type="submit" class="btn btn-primary" id = "save_data" onclick="save_data()" value ="salvar" style="display:none"><span class="glyphicon glyphicon-floppy-save"></span><span>  Save Project </span></button>
       <?php} else {?>
      <button type="submit" class="btn btn-primary" id = "save_data" onclick="save_data()" value ="salvar"><span class="glyphicon glyphicon-floppy-save"></span><span>  Save Project </span></button>
      <?php } ?>
              <?php 

                  $connect = mysql_connect('localhost','root','');
                  $project = $_SESSION['active_project'];
                  $db = mysql_select_db('usag_db', $connect);

                  $query = "SELECT * FROM project_has_files WHERE id_project = $project";

                  $query_project = mysql_query($query,$connect);

                $i = 0;
                if (mysql_num_rows($query_project) > 0 ) {
                  echo "<div id='tabs'><ul>";
                 while($i < mysql_num_rows($query_project)){
                  $value = $i;
                    $result = mysql_fetch_array($query_project);
                    echo "<li class = '".$result[1]."'><a href='#".$value."' data-toggle='tab'><span id= 'tab_".$value."'>".$result[1]."</span><span class='ui-icon ui-icon-closethick' onclick='deleteFile(".'"'.$result[1].'"'.");'></span></a></li></a></li>";
                  $i++;
                 }
                 echo "</ul></div>";
               }
          else{ ?>
            <div id='tabs' class="showTabs">
                <ul>
                <li><a href="#1" class= "active" data-toggle="tab"><span id="tab_int">interface.sv </span><span class="ui-icon ui-icon-closethick" onclick="deleteFile();"></span></a></li>
                <li><a href="#2" data-toggle="tab"><span id="tab_mon">monitor.sv</span><span class="ui-icon ui-icon-closethick" onclick="deleteFile();"></span></a></li>
                <li><a href="#3" data-toggle="tab"><span id="tab_dvr">driver.sv</span><span class="ui-icon ui-icon-closethick" onclick="deleteFile();"></span></a></li>
                <li><a href="#4" data-toggle="tab"><span id="tab_pkg">pkg.sv</span><span class="ui-icon ui-icon-closethick" onclick="deleteFile();"></span></a></li>
                <li><a href="#5" data-toggle="tab"><span id="tab_seq">sequencer.sv</span><span class="ui-icon ui-icon-closethick" onclick="deleteFile();"></span></a></li>
                <li><a href="#6" data-toggle="tab"><span id="tab_cfg">config.sv</span><span class="ui-icon ui-icon-closethick" onclick="deleteFile();"></span></a></li>
                <li><a href="#7" data-toggle="tab"><span id="tab_score">scoreboard.sv</span><span class="ui-icon ui-icon-closethick" onclick="deleteFile();"></span></a></li>
                <li><a href="#8" data-toggle="tab"><span id="tab_test">test.sv</span><span class="ui-icon ui-icon-closethick" onclick="deleteFile();"></span></a></li>
                <li><a href="#9" data-toggle="tab"><span id="tab_agent">agent.sv</span><span class="ui-icon ui-icon-closethick" onclick="deleteFile();"></span></a></li>
                <li><a href="#10" data-toggle="tab"><span id="tab_env">env.sv</span><span class="ui-icon ui-icon-closethick" onclick="deleteFile();"></span></a></li>
                <li><a href="#11" data-toggle="tab"><span id="tab_top">top_block.sv</span><span class="ui-icon ui-icon-closethick" onclick="deleteFile();"></span></a></li>
                <li><a href="#12" data-toggle="tab"><span id="tab_make">Makefile.vcs</span><span class="ui-icon ui-icon-closethick" onclick="deleteFile();"></span></a></li>
                </ul>
            </div>
  
              <?php }
              ?>
                
 
      
      <?php

                  $connect = mysql_connect('localhost','root','');
                  $project = $_SESSION['active_project'];
                  $db = mysql_select_db('usag_db', $connect);
                  $user = $_SESSION['user'][0];
                  $id = $_SESSION['active_project'];

                  $folder = "projetos/".$user."/".$id."/";

                  chdir($folder);

                  $query = "SELECT * FROM project_has_files WHERE id_project = $project";


                  $query_project = mysql_query($query,$connect);
                 $i = 0;
              if (mysql_num_rows($query_project) > 0 ) {
                  echo '<div id="tab-content" class="tab-content">';
                while($i < mysql_num_rows($query_project)){
                    $value = $i;
                    $result = mysql_fetch_array($query_project);
                    $content = file_get_contents($result[1]);
                    echo "<div contentEditable='true' spellcheck='false' class='tab-pane' id='".$value."'><pre><span id= 'file_".$value."'>".$content."</pre></span></div>";
                  $i++;
                  }
              } else {?>

    <div id="tab-content" class="tab-content showTabs">
      <div contentEditable="true" spellcheck="false" class="tab-pane" id="1"><span id="interface"></span></div>
      <div contentEditable="true" spellcheck="false" class="tab-pane" id="2"><span id="monitor_before"></span></div>
      <div contentEditable="true" spellcheck="false" class="tab-pane" id="3"><span id="driver"></span></div>
      <div contentEditable="true" spellcheck="false" class="tab-pane" id="4"><span id="pack"></span></div>
      <div contentEditable="true" spellcheck="false" class="tab-pane" id="5"><span id="sequencer"></span></div>
      <div contentEditable="true" spellcheck="false" class="tab-pane" id="6"><span id="config"></span></div>  
      <div contentEditable="true" spellcheck="false" class="tab-pane" id="7"><span id="scoreboard"></span></div>
      <div contentEditable="true" spellcheck="false" class="tab-pane" id="8"><span id="test"></span></div>
      <div contentEditable="true" spellcheck="false" class="tab-pane" id="9"><span id="agent"></span></div>
      <div contentEditable="true" spellcheck="false" class="tab-pane" id="10"><span id="env"></span></div>
      <div contentEditable="true" spellcheck="false" class="tab-pane" id="11"><span id="tpblk"></span></div>
      <div contentEditable="true" spellcheck="false" class="tab-pane" id="12"><span id="makefile"></span></div>
    </div>
      <?php } ?>


    </div class="tab-content"> 
    <div spellcheck="false" contentEditable="true" class="form-group" id="user_op"></div>
    
    </div>
  </div>
  </form>

<?php 
/****************************************************************************/
//            Modal para as configurações do Sequencer pelo usuário         //
/****************************************************************************/
?>

<div class="modal fade bs-example-modal-sm modal-sequencer"  data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Sequencer configuration</h4>
      </div>
       <p id='sq_f'>Pleases, select the ports to be used in the sequencer:</p>
       
      <div class="modal-body">
        <fieldset id="target">
          
        </fieldset>
      </div>
   <!--   Selecione o arquivo de entrada com os dados a serem usados no sequencer:
      <input type="file" id="inputCSV" onchange="pegaCSV(this)"> -->
      <div class="modal-footer">
        <p style="display:none" id="name_var"></p>
        <button type="button" class="btn btn-primary" onclick="save_cfg()">Save changes</button>

      </div>
    </div>
  </div>
</div>



<!-- Modal para criar novos arquivos personalizados pelo usuário -->

<div id="newFile" class="modal fade newFile" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"></button>
        <h4 class="modal-title text-center">Novo Arquivo</h4>
      </div>

        <div class="form-group" id="dataEntry">
            <div class="row">
                <div class="col-md-12">

                    <form name="newFile">
                      <br>
                      <div class="row">
                         <input class="form-control " name="fileName" id="fileName" placeholder="Entre com o nome do arquivo e formato (Ex.: arquivo.sv)">
                      </div>
                      <br>
                      <div class="row">
                         <textarea rows="10" style="resize:none" class="form-control" name="fileContent" id="fileContent" placeholder="Insira o conteúdo do seu arquivo"></textarea>
                      </div>
                    </form>
                  </div>
                </div>
        </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-basic" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-success" onclick="saveNewFile()">Salvar</button>
      </div>
    </div>

  </div>
</div>

<script type="text/javascript">
$( document ).ready(function() {
    $(".showTabs").css('display', 'none');
    $("div#tabs").tabs();
});
/****************************************************************************/
//    Função que retorna os indices dos colchetes da interface              //
/****************************************************************************/
function getIndicesOf(searchStr, str, caseSensitive) {
    var startIndex = 0, searchStrLen = searchStr.length;
    var index, indices = [];
    if (!caseSensitive) {
        str = str.toLowerCase();
        searchStr = searchStr.toLowerCase();
    }
    while ((index = str.indexOf(searchStr, startIndex)) > -1) {
        indices.push(index);
        startIndex = index + searchStrLen;
    }
    return indices;
}

var connInter = [];


/****************************************************************************/
//                    Função que captura a entrada de dados                 //
/****************************************************************************/
function catcher(){

/****************************************************************************/
//                        Funções da interface                              //
/****************************************************************************/
var file_interface = [];

 $("#interface").empty();

var str = $( "#design" ).val();

if (str.length !== 0){
    var n = str.search("input");

 for(var i=n; i<str.length; i++){
      length = str.search(";");
    }
    length = length - n;
    input = str.substr(n,length);
    
    var nameFileBegin = str.search("module");
    if(nameFileBegin != 0){
      $('#alert-module').css('visibility','visible').hide().fadeIn().removeClass('hidden');
      $('#alert-module').delay(1000).hide(0);  
    } else {
    var nameFileEnd = str.search("\\(");

    nameFile = nameFileEnd - nameFileBegin;
    name = str.substr(nameFileBegin,nameFile);

    var newname = name.replace('module', '');
    var driverName = newname;
  /*
    //Encontra quando possui valores em colchetes
    var indicesOfColch = getIndicesOf("[", input, false);
    var indicesOfCloseColch = getIndicesOf("]", input, false);
    var indicesOfInput = getIndicesOf("input",input,false);
    var indicesOfOutput = getIndicesOf("output",input,false);
    var indicesOfdotComa = getIndicesOf(";",input,false);
    var indices = [];
    indices = indices.concat(indicesOfInput,indicesOfOutput,indicesOfdotComa[0]);
   // console.log(indices);
    var auxColch = [];
    var auxColch2 = [];
    var temp2 = []; 
    var k = 0;
               
  */
    //Remove os input
  var re = new RegExp('(?:^|\\s)(input)(?=\\s|$)', 'g');
    var newstr = input.replace(re, '');

    //Remove os output
    var re = new RegExp('(?:^|\\s)(output)(?=\\s|$)', 'g');
    var newstr = newstr.replace(re, ''); 

    //Remove os wire
    var re = new RegExp('(?:^|\\s)(wire)(?=\\s|$)', 'g');
    var newstr = newstr.replace(re, '');

    //Remove os wire
    var re = new RegExp('wire', 'g');
    var newstr = newstr.replace(re, '');

    //Remove os logic
    var re = new RegExp('(?:^|\\s)(logic)(?=\\s|$)', 'g');
    var newstr = newstr.replace(re, '');

    //Remove os bit
    var re = new RegExp('(?:^|\\s)(bit)(?=\\s|$)', 'g');
    var newstr = newstr.replace(re, '');

    //Remove os byte
    var re = new RegExp('(?:^|\\s)(byte)(?=\\s|$)', 'g');
    var newstr = newstr.replace(re, '');
 
    //Remove os int
    var re = new RegExp('(?:^|\\s)(int)(?=\\s|$)', 'g');
    var newstr = newstr.replace(re, '');

    //Remove os reg
    var re = new RegExp('(?:^|\\s)(reg)(?=\\s|$)', 'g');
    var newstr = newstr.replace(re, '');

    //Remove os espaços
    var newstr = newstr.replace(/ /g,'');


    var parts = newstr.split(',');


    var sequencer_parts = parts; 

    var varArr = [];
    console.log(parts.length);
    for (i=0; i < parts.length; i++){

      parts[i] = parts[i].replace(/\s/g, "");

      connInter.push("vif."+"sig_"+parts[i]);
      if(parts[i].indexOf("[") != -1){
          var divideCol = /\s*]\s*/;
          var halfCol = parts[i].split(divideCol);
          console.log(halfCol);
          var union = "] sig_";
        varArr.push("logic " +halfCol[0]+union+halfCol[1] + ";</br>");
      }else{
      varArr.push("logic " + "sig_"+parts[i] + ";</br>");
    }
      varArr[i] = varArr[i].replace(/[()]/g, '');   
    }

    if($("#design").val()<1){
        $("#interface").empty();
        $("#driver").empty();
    }
    else{
    interfaceItens = varArr.join('');
    interface_final =  "<pre id='teste-tab'><code id='interface-file'>interface " + newname +"_if"+";</br>" + interfaceItens +"endinterface: " + newname+"_if</code></pre>";
    document.getElementById('interface').innerHTML += interface_final;
    }

    trans_ini_content(sequencer_parts);

    $('#name_var').val(newname);
 }
}else{
      $('#alert-null').css('visibility','visible').hide().fadeIn().removeClass('hidden');
      $('#alert-null').delay(1000).hide(0);  
    
  }
}
/****************************************************************************/
//        Função para gerar a transaction inicial                          x//
/****************************************************************************/

//Seleciona conteúdo do menu do sequencer

function trans_ini_content(sequencer_parts){
$("#target").empty();

console.log(sequencer_parts);

for (i = 0; i < sequencer_parts.length; i++) {
  var re = new RegExp('\\[.*?\\]', 'g');
    sequencer_parts[i] = sequencer_parts[i].replace(re, '');
    sequencer_parts[i] = sequencer_parts[i].replace(/[()]/g, '');   

    var checkbox = $('<input type="checkbox" checked="checked" name="seq_item" value='+sequencer_parts[i]+' id='+i+'/>'+'</input><input id="type_'+i+'" placeholder="Data Type"></input>'+sequencer_parts[i]+'<br>');

    checkbox.appendTo('#target');
    $(".bs-example-modal-sm").modal('show');
  }
}

/****************************************************************************/
//      Função para realizar o update do conteúdo do driver                 //
/****************************************************************************/

usr_dvr = "";
var seq_val_selected = [];
var id_val_selected = [];
var id_text_selected = [];


//
$('#user_driver').focusout(function(){
  usr_dvr = $('#user_driver').val();
  extraiInputOutput(seq_val_selected);
});

var id_text_selected = [];

function save_cfg(){

/****************************************************************************/
//               Limpa os títulos das tabs                                  //
/****************************************************************************/

$('#tab_int').empty();
$('#tab_mon').empty();
$('#tab_dvr').empty();
$('#tab_pkg').empty();
$('#tab_seq').empty();
$('#tab_cfg').empty();
$('#tab_score').empty();
$('#tab_test').empty();
$('#tab_agent').empty();
$('#tab_env').empty();
$('#tab_top').empty();

  var type_val_selected = [];
  seq_val_selected.length = 0;
  id_val_selected.length = 0;

  $(':checkbox:checked').each(function(i){
          seq_val_selected[i] = $(this).val();
          id_val_selected[i] = $(this).attr('id');
      });
      console.log("O ID selecionado foi:" + id_val_selected);
      console.log("O valor do Seq selecionado foi: " + seq_val_selected); 

    for (i=0; i < seq_val_selected.length; i++){
        id_val_selected[i] = id_val_selected[i].replace(/[^\w\s]/gi, '');
        var str_c = 'type_';
        id_val_selected[i] = str_c.concat(id_val_selected[i]);
      };
      for (i=0; i < id_val_selected.length; i++){
          if (id_val_selected[i].length != null) {
          id_text_selected.push(document.getElementById(id_val_selected[i]).value);
          }
      }
      for (i=0; i < id_val_selected.length; i++){
        var space_ar = " ";
        id_text_selected[i] = id_text_selected[i].concat(space_ar,seq_val_selected[i]);
        id_text_selected[i] = id_text_selected[i]+";<br>";
      }

   
 $(".modal-sequencer").modal('hide');
  $('#save_data').css('visibility','visible').hide().fadeIn().removeClass('hidden');

  extraiInputOutput(seq_val_selected);
}

function nl2br (str, is_xhtml) {
    var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';
    return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
}


function extraiInputOutput(seq_val_selected) {


/****************************************************************************/
//                    Mostra as para inserção do conteúdo                   //
/****************************************************************************/

$('.showTabs').css('display','block');
 $("div#tabs").tabs();

/****************************************************************************/
//                          Funções de inicialização                        //
/****************************************************************************/
  $("#driver").empty();
  $("#sequencer").empty();
  $("#config").empty();
  $("#monitor_before").empty();
  $("#test").empty();
  $("#agent").empty();
  $("#env").empty();
  $("#scoreboard").empty();
  $("#tpblk").empty();
  $("#makefile").empty();

/****************************************************************************/
//                          Funções do driver                               //
/****************************************************************************/
var conf_d = "";
driverName = $("#name_var").val();
driverName = driverName.replace(/ /g,'');
var vif = "</br></br>virtual "+ driverName +"_if vif;</br>";
var funcN = "function new(string name, uvm_component parent);<br>super.new(name, parent);</br>endfunction: new</br><br>"; 
var build = "function void build_phase(uvm_phase phase);<br>super.build_phase(phase);<br>void'(uvm_resource_db#(virtual "+ driverName +"_if)::read_by_name(.scope(\"ifs\"), .name(\""+ driverName+"_if\"), .val(vif)));<br>endfunction: build_phase";
var run = "<br>task run_phase(uvm_phase phase);</br>drive();</br>endtask: run_phase</br>";
var task = "virtual task drive();</br>//Defina aqui a lógica do driver</br>";


var endClass = "</br>endtask: drive </br>endclass:" + driverName+"_driver";


document.getElementById('driver').innerHTML += "<pre><code id='driver-file'>class " + driverName + "_driver extends uvm_driver#("+driverName+"_transaction);<br>`uvm_component_utils("+driverName+"_driver)" + vif + funcN + build + run + task+ endClass+"</code></pre>";


/****************************************************************************/
//              Funções do sequencer              //
/****************************************************************************/

//######## TRANSACTION ######

var cabecalho = "<pre><code id ='sequencer-file'>class " + driverName+"_transaction extends uvm_sequence_item;</br>";

var corpo = id_text_selected.join('')+'</br>function new(string name = "");</br>super.new(name);<br>endfunction: new</br>`uvm_object_utils_begin('+driverName+"_transaction)";
id_text_selected = [];
var varArr2 = [];

    for (i=0; i < seq_val_selected.length; i++){
      varArr2.push("</br>`uvm_field_int(" + seq_val_selected[i] + ", UVM_ALL_ON)");
    }
finalizaCorpo = '<br>`uvm_object_utils_end<br> endclass:'+driverName+'_transaction<br><br>';

//######## SEQUENCE #######

var cabecalho_seq = "class "+driverName +"_sequence extends uvm_sequence#("+driverName+"_transaction);</br>";
var obj = "<br>`uvm_object_utils("+driverName+"_sequence)<br>";
var funcS ='function new(string name = "");<br>super.new(name);<br>endfunction: new<br><br>';
var body_s = 'task body();<br>'+driverName+'_transaction '+ driverName+'_tx;';
var body_m = '<br><br>##########<br><br>';
  //  repeat(15) begin
var body_m2 = driverName+'_tx = '+driverName+'_transaction::type_id::create(.name("'+driverName+'_tx"), .contxt(get_full_name()));</br>';
var body_m3 ='start_item('+driverName+'_tx)<br><br>##########<br><br>finish_item('+driverName+'_tx);'
console.log(seq_val_selected);

    //assert(sa_tx.randomize());
    //`uvm_info("sa_sequence", sa_tx.sprint(), UVM_LOW);
var end_sq = "end<br>endtask: body<br>endclass:"+driverName+"_sequence<br>";
var typedef = 'typedef uvm_sequencer#('+driverName+'_transaction)'+driverName+'_sequencer;'

document.getElementById('sequencer').innerHTML += cabecalho + corpo + varArr2.join('')+finalizaCorpo+cabecalho_seq+obj +funcS+ body_s+body_m+body_m2+body_m3+end_sq+typedef;

/****************************************************************************/
//                         Funções do monitor (DUT)                         //
/****************************************************************************/

var init = "class"+" "+driverName+"_monitor_before extends uvm_monitor;<br>";
var component = "`uvm_component_utils("+driverName+"_monitor_before)<br>";
var analysis = "uvm_analysis_port#("+driverName+"_transaction) mon_ap_before;<br>";
var virt = "virtual "+driverName+"_if vif;<br>";
var func = "function new(string name, uvm_component parent);<br>super.new(name, parent);<br>endfunction: new <br>";
var build_ini = "function void build_phase(uvm_phase phase);<br>super.build_phase(phase);<br>";
var build_md = "void'(uvm_resource_db#(virtual "+driverName+"_if)::read_by_name (.scope(\"ifs\"), .name(\""+driverName+"_if\"), .val(vif)));<br>";
var end_build = "mon_ap_before = new(.name(\"mon_ap_before\"), .parent(this));<br>endfunction: build_phase<br>";
var run_p = "task run_phase(uvm_phase phase);<br>//Código de a ser executado<br> endtask: run_phase<br> endclass:"+driverName+"_monitor_before";
document.getElementById('monitor_before').innerHTML += "<pre><code id='monitor-file'>"+ init + component + analysis + virt + func + build_ini + build_md + end_build + run_p;


/****************************************************************************/
//                         Funções do monitor (Sequencer)                   //
/****************************************************************************/

var init2 = "class "+" "+driverName+"_monitor_after extends uvm_monitor;<br>";
var component2 = "`uvm_component_utils("+driverName+"_monitor_after)<br>";
var analysis2 = "uvm_analysis_port#("+driverName+"_transaction) mon_ap_after;<br>";
var virt2 = "virtual "+driverName+"_if vif;<br>";
var trans = driverName+"_transaction sa_tx;<br>"+driverName+"_transaction sa_tx_cg;<br>";
var covergroup = "covergroup "+driverName+"_cg;<br>";

var varTemp2 = [];

for (i=0; i < seq_val_selected.length; i++){
    varTemp2.push(seq_val_selected[i]+"_cp: coverpoint sa_tx_cg."+seq_val_selected[i]+";<br>");
}
varTemp2.push("cross ");
for (i=0; i < seq_val_selected.length-1; i++){
  varTemp2.push(seq_val_selected[i]+"_cp,<br>");
}
varTemp2.push(seq_val_selected[seq_val_selected.length-1]);
varTemp2.push(";");
console.log(varTemp2);

var endCover = "<br>endgroup: "+driverName+"_cg<br>";
var inst_cv = "function new(string name, uvm_component parent);<br>super.new(name, parent);<br>"+driverName+"_cg = new; "+"endfunction: new ";
var build_ini2 = "function void build_phase(uvm_phase phase);<br>super.build_phase(phase);";
var build_md2 = "void'(uvm_resource_db#(virtual "+driverName+"_if)::read_by_name(.scope(\"ifs\"), .name(\""+driverName+"_if\"), .val(vif)));<br>mon_ap_after= new(.name(\"mon_ap_after\"), .parent(this));";
var end_build2 = "endfunction: build_phase <br>";
var run_p2 = "task run_phase(uvm_phase phase);<br>//Código aqui <br>endtask: run_phase <br>endclass:"+driverName+"_monitor_after";

document.getElementById('monitor_before').innerHTML += "<pre><code id='monitor-after'>"+ init2 + component2 + analysis2 + virt2 + trans + covergroup + varTemp2.join('') + endCover + inst_cv + build_ini2 + build_md2 + end_build2 + run_p2;



/****************************************************************************/
//                         Funções do Scoreboard                            //
/****************************************************************************/

var initScore = "`uvm_analysis_imp_decl(_before)<br>`uvm_analysis_imp_decl(_after)<br>class "+driverName+"_scoreboard extends uvm_scoreboard;<br>";
var init3  = "`uvm_component_utils("+driverName+"_scoreboard)<br>";
var export1 = "uvm_analysis_export #("+driverName+"_transaction) sb_export_before;<br>";
var export2 = "uvm_analysis_export #("+driverName+"_transaction) sb_export_after;<br>";
var tlm =  "uvm_tlm_analysis_fifo #("+driverName+"_transaction) before_fifo;<br>";
var tlm2 = "uvm_tlm_analysis_fifo #("+driverName+"_transaction) after_fifo;<br>";
 
var trans1 = driverName+"_transaction transaction_before;<br>";
var trans2 = driverName+"_transaction transaction_after;<br>";
 
var func3 = "function new(string name, uvm_component parent);<br>super.new(name, parent);<br>transaction_before = new(\"transaction_before\");<br>";
var func4 = "transaction_after = new(\"transaction_after\");<br>";
var func5 = "endfunction: new<br>";

var build3 = "function void build_phase(uvm_phase phase);<br>super.build_phase(phase);<br>sb_export_before = new(\"sb_export_before\", this);<br>sb_export_after = new(\"sb_export_after\", this);<br>";
var build4 = "before_fifo = new(\"before_fifo\", this);<br>after_fifo = new(\"after_fifo\", this);<br>endfunction: build_phase<br>";

var conn = "function void connect_phase(uvm_phase phase);<br>sb_export_before.connect(before_fifo.analysis_export);<br>sb_export_after.connect(after_fifo.analysis_export);<br>endfunction: connect_phase<br>";
var run3 = "task run();<br> forever begin <br> before_fifo.get(transaction_before);<br>after_fifo.get(transaction_after);<br>compare();<br>end<br>endtask: run<br>";

var compare3 = "virtual function void compare();<br>if(transaction_before.out == transaction_after.out) begin<br>`uvm_info(\"compare\", {\"Test: OK!\"}, UVM_LOW);<br>end<br> else begin<br> `uvm_info(\"compare\", {\"Test: Fail!\"}, UVM_LOW);<br>end<br>endfunction: compare";
var endClass3 = "<br>endclass: "+driverName+"_scoreboard";

document.getElementById('scoreboard').innerHTML += "<pre><code id='scoreboard-file'>"+ initScore + init3 + export1 + export2 + tlm + tlm2 +trans1 +trans2 + func3 + func4 + func5 + build3 + build4 + conn + run3 + compare3 + endClass3;


/****************************************************************************/
//                         Funções do Enviroment                            //
/****************************************************************************/

var ini_env = "class "+driverName+"_env extends uvm_env;<br>";
var util_env = "`uvm_component_utils("+driverName+"_env)<br>";
var agent_env = driverName+"_agent sa_agent;<br>"+driverName+"_scoreboard sa_sb;<br>";
var begin_env = "function new(string name, uvm_component parent);<br>super.new(name, parent);<br>endfunction: new<br>";
var build_env = "function void build_phase(uvm_phase phase);<br>super.build_phase(phase);<br>sa_agent = "+driverName+"_agent::type_id::create(.name(\"sa_agent\"), .parent(this));<br>";
var build_score = "sa_sb = "+driverName+"_scoreboard::type_id::create(.name(\"sa_sb\"), .parent(this));<br>";
var build_end = "endfunction: build_phase<br>";
var env_conn =  "function void connect_phase(uvm_phase phase);<br>super.connect_phase(phase);<br>sa_agent.agent_ap_before.connect(sa_sb.sb_export_before);<br>";
var env_conn2 = "sa_agent.agent_ap_after.connect(sa_sb.sb_export_after);<br>";
var env_end_con = "endfunction: connect_phase<br>endclass: "+driverName+"_env<br>";

document.getElementById('env').innerHTML += "<pre><code id='enviroment-file'>"+ ini_env + util_env + agent_env + begin_env + build_env + build_score + build_end + env_conn + env_conn2 + env_end_con;

/****************************************************************************/
//                         Funções do  Agent                           //
/****************************************************************************/

var agent_class = "class "+driverName+"_agent extends uvm_agent;<br>`uvm_component_utils("+driverName+"_agent)<br>";
var analysis3 = "uvm_analysis_port#("+driverName+"_transaction) agent_ap_before;<br>uvm_analysis_port#("+driverName+"_transaction) agent_ap_after;<br><br>";
var agent_ini = driverName+"_sequencer sa_seqr;<br>"+driverName+"_driver sa_drvr;<br>"+driverName+"_monitor_before sa_mon_before;<br>"+driverName+"_monitor_after sa_mon_after;<br>";
var function_agent = "function new(string name, uvm_component parent);<br>super.new(name, parent);<br>endfunction: new<br>";
var function_agent_build = "function void build_phase(uvm_phase phase);<br>super.build_phase(phase);<br> agent_ap_before = new(.name(\"agent_ap_before\"), .parent(this));<br>agent_ap_after  = new(.name(\"agent_ap_after\"), .parent(this));<br>";
var agent_seqr = "<br>sa_seqr = "+driverName+"_sequencer::type_id::create(.name(\"sa_seqr\"), .parent(this));<br>";
var agent_dvr = "sa_drvr = "+driverName+"_driver::type_id::create(.name(\"sa_drvr\"), .parent(this));<br>";
var agent_mon = "sa_mon_before = "+driverName+"_monitor_before::type_id::create(.name(\"sa_mon_before\"), .parent(this));<br>";
var agent_mon_aft = "sa_mon_after  = "+driverName+"_monitor_after::type_id::create(.name(\"sa_mon_after\"), .parent(this));<br>";
var end_build3 = "endfunction: build_phase<br>";

var agent_con = "function void connect_phase(uvm_phase phase);<br>super.connect_phase(phase);<br>";
var con_dvr = "sa_drvr.seq_item_port.connect(sa_seqr.seq_item_export);<br>";
var con_mon = "sa_mon_before.mon_ap_before.connect(agent_ap_before);<br>";
var con_mon_bf = "sa_mon_after.mon_ap_after.connect(agent_ap_after);<br>";
var con_end = "endfunction: connect_phase<br>endclass: "+driverName+"_agent<br>";

document.getElementById('agent').innerHTML += "<pre><code id='agent-file'>"+ agent_class + analysis3 + agent_ini + function_agent + function_agent_build + agent_seqr + agent_dvr + agent_mon + agent_mon_aft + end_build3 + agent_con + con_dvr +con_mon + con_mon_bf + con_end;

/****************************************************************************/
//                         Funções do  Test                           //
/****************************************************************************/

var test_ini = "class "+driverName+"_test extends uvm_test;<br>";
var test_util = "`uvm_component_utils("+driverName+"_test)<br>";
var test_env = driverName+"_env sa_env;<br>";
var test_func = "function new(string name, uvm_component parent);<br>super.new(name, parent);<br>endfunction: new<br>";
var test_build = "function void build_phase(uvm_phase phase);<br>super.build_phase(phase);<br>sa_env = "+driverName+"_env::type_id::create(.name(\"sa_env\"), .parent(this));<br>endfunction: build_phase<br>";
var test_run = "task run_phase(uvm_phase phase);<br> "+driverName+"_sequence sa_seq;<br>";
var test_raise = "phase.raise_objection(.obj(this));<br>";
var test_seq = "sa_seq = "+driverName+"_sequence::type_id::create(.name(\"sa_seq\"), .contxt(get_full_name()));<br>";
var test_assert = "assert(sa_seq.randomize());<br>sa_seq.start(sa_env.sa_agent.sa_seqr);<br>phase.drop_objection(.obj(this));<br>endtask: run_phase<br>";
var test_end = "endclass: "+driverName+"_test";
document.getElementById('test').innerHTML += "<pre><code id='test-file'>"+ test_ini + test_util + test_env + test_func + test_build + test_run + test_raise + test_seq + test_assert + test_end;

/****************************************************************************/
//                         Funções do top_block                             //
/****************************************************************************/

var include_top = "`include \""+driverName+"_pkg.sv\"<br>";
var include_top2= "`include \""+driverName+".sv\"<br>";
var include_top3 = "`include \""+driverName+"_if.sv\"<br>";
var module_top = "module "+driverName+"_tb_top;<br>";
var module_import = "import uvm_pkg::*;<br>";
var interface_top= "//Declaração da interface<br>"+driverName+"_if vif();<br>//Conectar a interface no DUT<br>"+driverName+" dut(";

var begin_top ="initial begin<br>//Registra a interface no bloco de configurações<br>//Assim outros blocos podem usa-la<br>uvm_resource_db#(virtual "+driverName+"_if)::set(.scope(\"ifs\"), .name(\""+driverName+"_if\"), .val(vif)); //Executa o teste<br>run_test();<br>end";
var init_top = "//inicialização de variaveis<br>initial begin<br><br>end<br>endmodule";

document.getElementById('tpblk').innerHTML +="<pre><code id='top-file'>"+ include_top + include_top2 + include_top3 + module_top + module_import + interface_top + connInter.join(',<br>')+";" + begin_top + init_top;
/****************************************************************************/
//                         Funções de Configuração                          //
/****************************************************************************/

var config_class = "class "+driverName+"_configuration extends uvm_object;<br>";
var config_utils = "`uvm_object_utils("+driverName+"_configuration)";
var config_new = "function new(string name = \"\");<br>super.new(name);<br>endfunction: new<br>endclass: "+driverName+"_configuration";

document.getElementById('config').innerHTML += "<pre><code id='config-file'>"+config_class + config_utils + config_new;


/****************************************************************************/
//                         Cria package                           //
/****************************************************************************/
var pack = "package "+driverName+"_pkg;<br>import uvm_pkg::*;";
var pack_include = "<br>`include \""+driverName+"_sequencer.sv\"<br>`include \""+driverName+"_monitor.sv\"<br>`include \""+driverName+"_driver.sv\"<br>`include \""+driverName+"_agent.sv\"<br>`include \""+driverName+"_scoreboard.sv\"<br>`include \""+driverName+"_config.sv\"<br>`include \""+driverName+"_env.sv\"<br>`include \""+driverName+"_test.sv\"";
var end_pack = "<br>endpackage: "+driverName+"_pkg";

document.getElementById('pack').innerHTML += "<pre><code id='pkg-file'>"+pack+pack_include+end_pack;

/****************************************************************************/
//                                Gera Makefile                             // 
/****************************************************************************/
var uvm_home = "UVM_HOME = ../uvm-src/uvm-1.1d<br>UVM_VERBOSITY = UVM_MEDIUM<br>TEST = simpleadder_test<br><br>";
var vcs_begin = "VCS = vcs -sverilog -timescale=1ns/1ns \\ <br> +acc +vpi -PP \\ <br>  +define+UVM_OBJECT_MUST_HAVE_CONSTRUCTOR \\ +incdir+$(UVM_HOME)/src $(UVM_HOME)/src/uvm.sv \\ <br> -cm line+cond+fsm+branch+tgl -cm_dir ./coverage.vdb \\ <br>  $(UVM_HOME)/src/dpi/uvm_dpi.cc -CFLAGS -DVCS<br>";
var simv = "SIMV = ./simv +UVM_VERBOSITY=$(UVM_VERBOSITY) \\ <br>  +UVM_TESTNAME=$(TEST) +UVM_TR_RECORD +UVM_LOG_RECORD \\ <br>  +verbose=1 +ntb_random_seed=244 -l vcs.log <br>";
var compMake = "x:  comp run <br>comp:  $(VCS) +incdir+. "+driverName+"_tb_top.sv";
var runClean = " run: $(SIMV) <br> clean: rm -rf coverage.vdb csrc DVEfiles inter.vpd simv simv.daidir ucli.key vc_hdrs.h vcs.log .inter.vpd.uvm";

document.getElementById('makefile').innerHTML += "<pre><code id='make-file'>" + uvm_home + vcs_begin + simv + compMake + runClean;


/****************************************************************************/
//                            Atualiza nome de tabs                         //
/****************************************************************************/

if_name = driverName+"_if.sv";
mon_name = driverName+"_monitor.sv";
dvr_name = driverName+"_driver.sv";
pkg_name = driverName+"_pkg.sv";
seq_name = driverName+"_sequencer.sv";
cfg_name = driverName+"_config.sv";
score_name = driverName+"_scoreboard.sv";
test_name = driverName+"_test.sv";
agent_name = driverName+"_agent.sv";
env_name = driverName+"_env.sv";
top_name = driverName+"_top.sv";
make_name = "Makefile.vcs";

document.getElementById('tab_int').innerHTML = document.getElementById('tab_int').innerHTML.replace('', if_name);
document.getElementById('tab_mon').innerHTML = document.getElementById('tab_mon').innerHTML.replace('', mon_name);
document.getElementById('tab_dvr').innerHTML = document.getElementById('tab_dvr').innerHTML.replace('', dvr_name);
document.getElementById('tab_pkg').innerHTML = document.getElementById('tab_pkg').innerHTML.replace('', pkg_name);
document.getElementById('tab_seq').innerHTML = document.getElementById('tab_seq').innerHTML.replace('', seq_name);
document.getElementById('tab_cfg').innerHTML = document.getElementById('tab_cfg').innerHTML.replace('', cfg_name);
document.getElementById('tab_score').innerHTML = document.getElementById('tab_score').innerHTML.replace('', score_name);
document.getElementById('tab_test').innerHTML = document.getElementById('tab_test').innerHTML.replace('', test_name);
document.getElementById('tab_agent').innerHTML = document.getElementById('tab_agent').innerHTML.replace('', agent_name);
document.getElementById('tab_env').innerHTML = document.getElementById('tab_env').innerHTML.replace('', env_name);
document.getElementById('tab_top').innerHTML = document.getElementById('tab_top').innerHTML.replace('', top_name);

}



/****************************************************************************/
//                 Envia dados dos arquivos para salvar com php             //
/****************************************************************************/

function save_data(){
console.log('Entrou na funçao de gravação no servidor');

user = $('#user_id').html();
project = $('#project_id').html();

file_interface = $("#interface-file").html();
file_monitor = $("#monitor-file").html() + "<br><br>" + $("#monitor-after").html();
file_driver = $("#driver-file").html();
file_pkg = $("#pkg-file").html();
file_sequencer = $("#sequencer-file").html();
file_configuration= $("#config-file").html();
file_scoreboard = $("#scoreboard-file").html();
file_enviroment = $("#enviroment-file").html();
file_test = $("#test-file").html();
file_agent = $("#agent-file").html();
file_top = $("#top-file").html();
file_make = $("#make-file").html();

  $.ajax({
    url: "page.php",
    type : 'POST',
    data: { 'user': user, 'project': project,

            'interface': file_interface, 'name_interface': if_name, 
            'monitor': file_monitor, 'name_monitor': mon_name,
            'driver': file_driver, 'name_driver':dvr_name,
            'package': file_pkg, 'name_package': pkg_name,
            'sequencer': file_sequencer, 'name_sequencer': seq_name,
            'configuration': file_configuration, 'name_configuration': cfg_name,
            'scoreboard': file_scoreboard, 'name_scoreboard': score_name,
            'enviroment': file_enviroment, 'name_enviroment': env_name,
            'test': file_test, 'name_test': test_name,
            'agent': file_agent, 'name_agent': agent_name,
            'top': file_top, 'name_top': top_name,
            'make': file_make, 'name_make': make_name}
  }); 
}

function saveNewFile(){
  console.log("acessou o saveNewFile");
    name = $('#fileName').val();
    content = $('#fileContent').val();
console.log("Nome: "+name);
console.log("Conteudo: "+content);  

 $.ajax({
    url: "generatePersonalFile.php",
    type : 'POST',
    data: { 'name': name, 'content': content }
  }); 

  $("div#tabs").tabs();
        var num_tabs = $("div#tabs ul li").length + 1;
        $("div#tabs ul").append('<li><a class="'+num_tabs+'live'+'"href="#' + num_tabs+'live' + '" data-toggle="tab"><span id="tab_score">' + name +'</span><span class="ui-icon ui-icon-closethick" onclick="deleteFile(name);"></span></a></li>');
        $("div#tab-content").append('<div contentEditable="true" spellcheck="false" class="tab-pane"' +  'id="' + num_tabs+'live' + '"><span><pre>'+ content + '</pre></span></div>');
        $("body #tabs").tabs("refresh");
 $("#newFile").modal('hide');
}

function deleteFile(filename){
  project = $('#project_id').html();
  var hide = "."+filename;
  console.log(hide); 
  $("hide").hide();

  console.log('Deletando arquivo: '+project+"/"+filename);
  $.ajax({
    url: "deletePersonalFile.php",
    type : 'POST',  
    data: { 'project': project, 'file': filename}
  }); 
  $("div#tabs").tabs();
  $("body #tabs").tabs("refresh");
}
</script>