<!DOCTYPE html>
  <head>
  <?php 
    session_start();
    $_SESSION['error_log'] = 0;
  ?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>USAG</title>

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
						</button> <a class="navbar-brand" href="index.php">USAG</a>
					</div>

					
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav">
							<li class="active">
								<a href="index.php"> What is it? </a>
							</li>
							<li>
								<a href="download.php"> Download </a>
							</li>
							<li>
								<a href="geraUVM.php">UVM Environment Generator</a>
							</li>
						</ul>
			<?php if(isset($_SESSION['user'])){ ?>
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
                    <a class="dropdown_item" href="myData.php">Meus dados cadastrais</a>
                    <a class="dropdown_item" href="myProjects.php">Meus Projetos</a>
                  </li>
                  <li> 
                    <form name="logout" action="logout.php" method="POST" enctype="multipart/form-data">
                      <button type="submit" class="btn btn-default" id="logout_button">
                        Sair
                      </button>
                      </form>
                  </li>
                </ul>
                <?php } else {?>
                <ul class="nav navbar-nav navbar-right nav-pos">
              <li class>
                <a href="createAccount.php">Sign Up |</a>
              </li>
              <li> 
                <img src="img/user.png" alt="user-login" class = "img-circle" id = "user-login">
              </li>
              <li class="login dropdown-large">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"> Login <strong class="caret"></strong></a>
                <ul class="dropdown-menu dropdown-menu-large">
                  <li>
                    <form role="form" action="login.php" method="POST" >
                      <div class="form-group">
                        <input class="form-control" id="email_login" name="email_login" type="email" placeholder="Write your e-mail">
                      </div>  
                  </li>
                  <li>
                    <div class="form-group">
                      <input class="form-control" id="senha_login" name="senha_login" type="password" placeholder="Write your password">
                    </div>
                  </li>
                  
                  <li> 
                    <button type="submit" id="login_button" class="btn btn-default">Start!</button>
                  </li>
                  </form>
                </ul>
              </ul>
                <?php } ?>
					</div>
				</nav>
			</div>
		</div>
	
	<div class="row">
		<div class="col-md-12">
			<div class="homepage-hero-module"  style="margin:0 ! important;  padding-left:0; padding-right:0; margin-left:0;margin-right:0; width:100%;max-width:none;padding:0;">
          <div class="video-container embed-responsive embed-responsive-4by3">
              <div class="filter"></div>
                <video autoplay loop>
                    <source src="video/movie.mp4" type="video/mp4" />Your browser does not support the video tag. I suggest you upgrade your browser.
                    <source src="video/movie_low.webm" type="video/webm" />Your browser does not support the video tag. I suggest you upgrade your browser.
                </video>
                <div class="poster hidden">
                  <img src="video/img.jpg" alt="">
                </div>
          </div>
      </div>
		</div>
</div>
<div class="row">
    <div class="col-md-12">

    </div>
</div>
</body>
</html>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/scripts.js"></script>