<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Pampium</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
  <script src="js/jquery-1.12.0.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/functions.js"></script>


</head>
<body>

	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<nav class="navbar navbar-default navbar-inverse navbar-fixed-top" role="navigation" style="border-radius:0px;">
					<div class="navbar-header">
						
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
							<span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
						</button> <a class="navbar-brand" href="#">Pampium</a>
					</div>
					
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav">
							<li class="active">
								<a href="#"> O que é? </a>
							</li>
							<li>
								<a href="download.php"> Download </a>
							</li>
							<li>
								<a href="geraUVM.php"> Gerador de testes UVM </a>
							</li>
						</ul>
						
						<ul class="nav navbar-nav navbar-right">
							<li>
								<a href="createAccount.php">Cadastre-se |</a>
							</li>
							<li> 
								<img src="img/user.png" alt="user-login" class = "img-circle" id = "user-login">
							</li>
							<li class="login">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"> Login <strong class="caret"></strong></a>
								<ul class="dropdown-menu">
									<li>
										<form role="form">
											<div class="form-group">
												<label for="exampleInputEmail1">
													Email: 
												</label>
												<input class="form-control" id="exampleInputEmail1" type="email">
											</div>
										</li>
										<li>
											<div class="form-group">
												<label for="exampleInputPassword1">
													Password:
												</label>
												<input class="form-control" id="exampleInputPassword1" type="password">
											</div>
										</li>
										<li>
											<div class="checkbox">
												<label>
													<input type="checkbox"> Lembrar-me
												</label>
											</div>
										</li>
										<li> 
											<button type="submit" class="btn btn-default">
												Entrar
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

		<div class="row">
			<div class="col-md-12">
				<?php
					$if_name = $_POST["name_if"];
					$interface = $_POST["save_interface"];
					
    				$fp = fopen($if_name, "a");
     			    $escreve = fwrite($fp, $interface);
    				fclose($fp); 
			?>
			</div>	
		</body>
	</html>