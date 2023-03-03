<?php

//Utilizadores com poderes de admin:
$username1 = "miguel";
$password1 = "pass";

$username2 = "gui";
$password2 = "pass";

$username4 = "servidor";
$password4 = "passservidor";

//Outros utilizadores:
$username3 = "pleb";
$password3 = "pleb";


session_start(); //Informar o browser que vou utilizar variaveis de sessao (comum entre "separadores")
$_SESSION['admin'] = 0;

if (isset($_POST['username']) && isset($_POST['password'])) { //se colocaram username e pass nos respetivos campos

	if (($_POST['username'] == $username1 && $_POST['password'] == $password1) || ($_POST['username'] == $username2 && $_POST['password'] == $password2) || ($_POST['username'] == $username3 && $_POST['password'] == $password3) || ($_POST['username'] == $username4 && $_POST['password'] == $password4)) { //se o utilizador fizer um dos possiveis logins
		header('Location: dashboard.php'); //reencaminhar para o dashboard
		echo "Autenticado com sucesso";
		$_SESSION['username'] = $_POST['username']; //Para validar sessão para restantes sítios
		if($_POST['username'] == $username1 || $_POST['username'] == $username2 || $_POST['username'] == $username4){ //Dar privilégios a respetivos utilizadores
			$_SESSION['admin'] = 1;
		}
	} 
	else {
		echo "Password ou Username inválidos";
		http_response_code(403); //Código 403 - Forbidden (usado para username ou password errados)
	}
}
?>

<!DOCTYPE HTML>
<html lang="pt">

<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Smart Home</title>
	<!-- Utilizando o Bundle da Bootstrap e o CSS:-->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"><!--CSS do Bootstrap-->
	<link rel="stylesheet" href="style.css"><!--para "linkar" com nosso ficheiro CSS-->

</head>

	<!-- "Form" de login:-->
<body class="fundologin">
	<div class="container">
			<!-- Parte com imagem e subtítulo:-->
		<div class="form-group row">
			<div style="text-align: center">
				<a href="./index.php"> <img src="./images/icon_casa.png" width="200" alt="Logotipo da SmartHome"></a>
				<h1 class="mt-4">Smart Home</h1>
				<h5><b>One Device To Rule Them All</b></h5>
			</div>
			<!-- Parte para os inputs:-->
			<div class="col-4"></div><!--Foi escolhido criar 3 divisões "col" de 4, com o form no meio-->
			<form class="classeUm col-4" method="post">
				<p class="mt-3">Faça o Login para a sua Smart Home:</p>
				<div class="mb-3 mt-3">
					<label for="usr">Nome:</label>
					<input type="text" class="form-control" id="usr" placeholder="Insira o seu nome" name="username" maxlength="80" required>
				</div>

				<div class="mb-3">
					<label for="pwd">Password:</label>
					<input type="password" class="form-control" id="pwd" placeholder="Insira a sua password" name="password" maxlength="80" required>
				</div>
				<button type="submit" class="btn btn-info">Submeter</button>
			</form>
			<div class="col-4"></div>
		</div>

	</div>
</body>
</html>