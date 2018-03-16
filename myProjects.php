<!DOCTYPE html>
<?php 
session_start();
if(!isset($_SESSION['user'])){
        header('Location: createAccount.php');
  } else {
    $user = $_SESSION['user'];
  }
?>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>USAG</title>
  <script src="js/jquery-1.12.0.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/functions.js"></script>

  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
</head>
<body>

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
              <li>
                <a href="geraUVM.php"> UVM Enviromnent Generator</a>
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
                    <a class="dropdown_item">My Projects</a>
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
        </nav>
      </div>
    </div>
</div>
</div>
<br>
<br>
<br>
<div class="container-fluid">
    <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-6">
          <div class="list-group">

            <a href="#" class="list-group-item active"> My Projects: </a>
            <?php

              $connect = mysql_connect('localhost','root','');

              $db = mysql_select_db('usag_db', $connect);

              $query = "SELECT project_id FROM user_has_projects WHERE user_id = '$user[0]'";
              $query_count = "SELECT COUNT(project_id) FROM user_has_projects WHERE user_id = '$user[0]'";



              $query_project = mysql_query($query,$connect);
              $query_num_of_rows = mysql_query($query_count,$connect);

              $fetch_count = mysql_fetch_row($query_num_of_rows);

              if($fetch_count[0] == 0){ ?>

                <a href="#" class="list-group-item clearfix center-text">Nothing Found!
                <form name="newProject" id="newProj" action="createProject.php" method="POST" enctype="multipart/form-data">
                  <br><button type="submit" class="btn btn-default btn-success"> Create a new project? </button>
                </form>
                </a>
                <?php
              } else { 
                    while($fetch = mysql_fetch_row($query_project)){
                    ?>
                    <?php $query_data_project = "SELECT * FROM user_has_projects WHERE project_id = '$fetch[0]'"; 
                          $query_data = mysql_query($query_data_project,$connect);
                          $result = mysql_fetch_row($query_data);
                    ?>


                    <a href="#" class="list-group-item clearfix"> 
                      <div class="form-group">
                      <div class="col-md-7">
                      <div>Project: <span class=<?php echo $fetch[0];?>><?php if($result[2] == "" || $result[2] == null){ echo "No title"."  "; } else {echo $result[2]."  ";} ?></span><span class ="glyphicon glyphicon-pencil edit-name" ><p style="display:none"><?php echo $fetch[0];?></p></span></div>

                      <div class = <?php echo $fetch[0]."atual";?> style="display:none"></div>

                       
                      <span>Created: <?php echo $result[3]?></span>
                    </div>
                    <div class="col-md-5">
                       <div class="pull-right"> 
                        <form class="btn-group" role="form" method="POST" action="open.php">
                            <button class="btn btn-primary btn-group" type="submit"  name="abrir" value='<?php echo $fetch[0];?>' id='<?php echo $fetch[0]; ?>' > Open <span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span></button>
                          </form>
                            <button class="btn btn-danger btn-group delete" type="submit" name="excluir" value='<?php echo $fetch[0];?>' id='<?php echo $fetch[0]; ?>' > Delete <span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                       </div>
                     </div>
                   </div>

                    </a>
              <?php } 
            } ?>
          </div>
      </div>
      <div class="col-md-3"></div>
    <div class="col-md-5"></div>
    <div class="col-md-2">
      <?php if($fetch_count[0] != 0){ ?>
    <form name="newProject" id="newProj" action="createProject.php" method="POST" enctype="multipart/form-data">
                  <br><button type="submit" class="btn btn-default btn-success"> Create a new project <span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
                  <?php } ?>
    </form>
  </div>
  <div class="col-md-5"></div>
    <div>
</div>

<div class="modal fade bs-example-modal-sm modal-sequencer"  data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-md">
    <div class="modal-content big-modal">
      <div class="modal-body">
        <div class="form-group">
          <div class="row">
            <div class="col-md-7">
                  <input class="form-control" placeholder="Write the name of the new project" id="new-name"></input>
            </div>
            <div class="col-md-5">
                <div id="editable" style="display:none"></div>
                  <div class="pull-right">
                      <button type="button" data-dismiss="modal" class="btn btn-default">Cancel</button>
                      <button type="button" class="btn btn-primary" onclick="save_name()">Save name</button>
                  </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade modal-delete"  data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body">
        <div class="form-group">
          <div class="row">
            <div class="col-md-3">
            </div>
            <div class="col-md-6">
              <div id="remove" style="display:none"></div>

              <p>Do you want to delete the project?</p>
                <button type="button" data-dismiss="modal" class="btn btn-default">No</button>
                <form class="btn-group" role="form" method="POST" action="delete.php">
                <button type="submit" class="btn btn-primary" name="yes" id="yes">Yes</button>
                </form>
            </div>
            <div class="col-md-3">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
<script type="text/javascript">
  
  $(".edit-name").click(function(){
        var text = $(this).text();

        $("#editable").html(text);

        $(".bs-example-modal-sm").modal('show');

  });


//Funcão para atualizar o nome do arquivo no banco de dados

function save_name(){
  var name = $("#new-name").val();
  var id = $("#editable").text();
  var id2 = id+"atual";

  $(".bs-example-modal-sm").modal('hide');
  $("#new-name").val("");

   $.ajax({
    url: "renameProject.php",
    type : 'POST',
    data: {  'project': id,
            'name': name}
    }); 

  $('.'+id).html('');
  $('.'+id).html(name+" ");

}

$(".delete").click(function(){
  var text = $(this).val();
  $("#remove").html(text);
  $(".modal-delete").modal('show');
  $("#yes").val(text)
});

</script>