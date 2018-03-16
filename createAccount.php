<!DOCTYPE html>
  <head>
  	<?php 
		session_start();
			if(isset($_SESSION['user'])){ 
				header('Location: geraUVM.php');} 

		$is_error = $_SESSION['error_log'];

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
							<li>
								<a href="index.php"> What is it? </a>
							</li>
							<li>
								<a href="download.php"> Download </a>
							</li>
							<li>
								<a href="geraUVM.php"> UVM Enviromnent Generator </a>
							</li>
						</ul>
			
						<ul class="nav navbar-nav navbar-right nav-pos">
							<li class="active">
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
					</div>
				</nav>
			</div>
		</div>
	</div>	


    <div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="row"></div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6 info-acc">
			<dl>
				<dt>
				Why I need to create an account?
				</dt>
				<dd>
					With the account you can have access to your generated data in any place, and any time! Also, you can have access to our tool in any device (smartphone, tablet and computer). If you don't want to keep your data online, you don't need! 
				</dd>
				<dt><br><br>
				How much it costs? 
				</dt>
				<dd>
					The USAG (Our UMV Enviromnent Generator), is free and always will be.
				</dd>
				<dt><br><br>
					How I create an account?
				</dt>
				<dd>
					Just fill the data in the side! ;)
				</dd>
				<dt><br><br>
					How can I improve the tool?
				</dt>
				<dd>
					We are starting our project, you can go to "Download" in our web site, download the Source Code, and improve it!
				</dd>
				<dt><br><br>
					Another question?
				</dt>
				<dd>
					Keep in touch:
				</dd>
				<dd>
					suporte@pampium.16mb.com
				</dd>
			</dl>
		</div>
		<div class="col-md-6 cad-acc">

		<div id="user-cad">
			<form name="cad" action="newUser.php" method="POST" enctype="multipart/form-data">
			<input id="perfil-img-upload" class="hidden" type="file" name="imagem" id="imagem">
			<img id="perfil-img" alt="add photo" class="img-circular input-user" src="../img/user-default.jpg">
		</div>
		<div>
			<br>
			<div class="row">
				<div class="form-group col-xs-2">
				</div>
				<div class="form-group col-xs-8">
					 <label for="name">
						What's your name?
					</label>
					<input class="form-control" name="nome" id="nome" type="text" placeholder="Ex.: Jhon Doe">
				</div>
				<div class="form-group col-xs-2">
				</div>
			</div>
			<div class="row">
				<div class="form-group col-xs-2">
				</div>
				<div class="form-group col-xs-5">
					<label for="email">
						What's your e-mail?
					</label>
					<input class="form-control" name="email" id="email" type="email" placeholder="your_email@yourdomain.com">
					<div id='resposta'></div>
				</div>
	
				<div class="form-group col-xs-3">
					<label for="password">
						Which pass?
					</label>
					<input class="form-control" name="senha" id="senha" type="password" placeholder="******">
				</div>
				<div class="form-group col-xs-2">
				</div>	
			</div>
			<div class="row">
				<div class="col-md-12">
				<button type="submit" class="btn btn-success" id="begin-button" >
					Let's begin!
				</button>
				</div>

			</form>
			</div>
			<br>	
			<div class="row">
				<div class="col-md-3">
				</div>
				<div class="col-md-6">
					<div id ="error_div" style="display:none"><?php echo $is_error; ?></div>
					<div id = "alert-module" class="alert alert-danger" style="display:none" role="alert">The login or pass are not correct!</div>
				</div>
				<div class="col-md-3">
				</div>
			</div>
			<div class="row">
				<div class="col-md-3">
				</div>
				<div class="col-md-6">
				<div id = "alert-button" class="alert alert-danger" style="display:none" role="alert">Please, verify the white spaces!</div>
				</div>
				<div class="col-md-3">
				</div>
			</div>

			</div>

		</div>

		</div>

	</div>

</div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript">


//------------------------------------------//
//         Função de envio de imagem        //
//------------------------------------------//


$('#perfil-img').on('click', function() {
    $('#perfil-img-upload').click();
});

error_console = $("#error_div").text();
if(error_console == 2){
      $('#alert-module').css('visibility','visible').hide().fadeIn().removeClass('hidden');
      $('#alert-module').delay(1000).hide(0);  
 } 

function readURL(input) {
	
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('.input-user').attr('src', e.target.result);
            $('#user-login').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#perfil-img-upload").change(function(){
    readURL(this);
});

//------------------------------------------//
//         Verificação de cadastro          //
//------------------------------------------//

//Função que habilita/desabilita o botão de cadastro caso haja dados inválidos
function entrada(input) {
	if(input=='0'){
		document.getElementById("begin-button").disabled = true; 
	} else {
		document.getElementById("begin-button").disabled = false; 
	}
}

//Função que verifica se o e-mail já está cadastrado no banco de dados

var email = $("#email"); 
    email.blur(function() { 
        $.ajax({ 
            url: 'verificaEmail.php', 
            type: 'POST', 
            data:{"email" : email.val()}, 
            success: function(data) { 
            console.log(data); 
            data = $.parseJSON(data); 
            $("#resposta").text(data.email);
            entrada(data.validador);
           } 
      }); 
    }); 

//Função que verifica se os campos estão preenchidos

$('#begin-button').on('click', function(event) {
    if (null_or_empty("nome") || null_or_empty("email") || null_or_empty("senha")){
    	$('#alert-button').css('visibility','visible').hide().fadeIn().removeClass('hidden');
    	$('#alert-button').delay(1000).hide(0); 
    	event.preventDefault();
    }
});

function null_or_empty(str) {
    var v = document.getElementById(str).value;
    return v == null || v == "";
}
   
 </script>
  </body>
</html>