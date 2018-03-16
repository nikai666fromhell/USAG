<?php
session_start();
$_SESSION['error_log'] = 0;
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>Pampium</title>


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
						</button> <a class="navbar-brand" href="#">Pampium</a>
					</div>
					
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav">
							<li>
								<a href="index.php"> O que é? </a>
							</li>
							<li class="active">
								<a href="download.php"> Download </a>
							</li>
							<li>
								<a href="geraUVM.php"> Gerador de ambientes UVM </a>
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
	</br>
	</br>
	</br>
	<div class="row">
		<div class="col-md-4">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">
						Pampium (Núcleo)
					</h3>
				</div>
				<div class="panel-body">
					Versão desenvolvida pelo Alian.
				</div>
				<div class="panel-footer">
					<div class="row">
						<div class="col-md-4">
					<a href="/pampium/pampium alian.rar"><i class="glyphicon glyphicon-circle-arrow-down"></i>Download</a>
				</div>
				<div class="col-md-4">
					<a href="/docs/pampium_alian.pdf"><i class="glyphicon glyphicon-book"></i>Documentação</a>					
				</div>
				<div class="col-md-4">
				</div>
				</div>
			</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">
						Pampium (IC2 e RS232)
					</h3>
				</div>
				<div class="panel-body">
					Versão desenvolvida pelo Dionatas.
				</div>
				<div class="panel-footer">
					<a href="/pampium/pampium dionatas.rar"><i class="glyphicon glyphicon-circle-arrow-down"></i>Download</a>
					<a href="/docs/pampium_dionatas.pdf"><i class="glyphicon glyphicon-book"></i>Documentação</a>					
				</div>
			</div>
		</div>
			<div class="col-md-4">
				<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">
						Pampium (Pipeline)
					</h3>
				</div>
				<div class="panel-body">
					Versão desenvolvida pelo Leonardo.
				</div>
				<div class="panel-footer">
					<a href="/pampium/pampium leonardo.rar"><i class="glyphicon glyphicon-circle-arrow-down"></i>Download</a>
					<a href="/docs/pampium_leonardo.pdf"><i class="glyphicon glyphicon-book"></i>Documentação</a>									</div>
			</div>
		</div>
		</div>
	</div>
</div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
  </body>
</html>