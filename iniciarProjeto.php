<!DOCTYPE html>

<?php 
/****************************************************************************/
//                        Verificação de usuário ativo                      //
/****************************************************************************/
session_start();
if(!isset($_SESSION['user'])){
        header('Location: createAccount.php');
  }
  $_SESSION['error_log'] = 0;
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
  <script src="js/bootstrap.min.js"></script>
  <script src="js/functions.js"></script>

  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
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
                <a href="geraUVM.php"> UVM Enviromnent Generator </a>
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
                        Sair
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
<br>
<br>
<br>
<br>
<br>
<br>

<div class="row">
      <div class="col-lg-12">
        <div class="row">
        <div id="beginform">
          <div class="col-lg-12">
          <p id="welcomeMessage">Welcome To USAG!</p>
          </div>
          <div class="row">
          <div class="col-lg-6">
           <form name="logout" action="createProject.php" method="POST" enctype="multipart/form-data">
              <button type="submit" class="btn btn-default newProject">
                  Create New</br> Project
            </button>
          </form>
          </div>
          <div class="col-lg-6">
            <form name="logout" action="myProjects.php" method="POST" enctype="multipart/form-data">
              <button type="submit" class="btn btn-default newProject">
                  Open an Old</br> Project
             </button>
          </form>
          </div>
        </div>
        </div>
        </div>
      </div>
</div>