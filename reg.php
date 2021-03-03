<?php session_start(); ?>

<!DOCTYPE html>
<html>

<head>
	<title>Регистрация</title>
	<meta charset="UTF-8">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="/css/reg.css">
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.css">
    <script src="/bootstrap/js/bootstrap.js"></script>
</head>

<body>
	<form action="" method="POST" class="position-absolute top-50 start-50 translate-middle">
		Введите логин
		<div class="input-group mb-3">
  			<span class="input-group-text" id="basic-addon1"><img src="/img/user.png"></span>
  			<input type="text" class="form-control" placeholder="Логин" aria-label="Username" aria-describedby="basic-addon1" name="login">
		</div>
		Введите email
		<div class="input-group mb-3">
  			<span class="input-group-text" id="basic-addon1"><img src="/img/email.png"></span>
  			<input type="email" class="form-control" placeholder="Почта" aria-label="Email" aria-describedby="basic-addon1" name="email">
		</div>
		Введите пароль
		<div class="input-group mb-3">
  			<span class="input-group-text" id="basic-addon1"><img src="/img/padlock.png"></span>
  			<input type="password" class="form-control" placeholder="Пароль" aria-label="Password" aria-describedby="basic-addon1" name="password">
		</div>
		Повторите пароль
		<div class="input-group mb-3">
  			<span class="input-group-text" id="basic-addon1"><img src="/img/padlock.png"></span>
  			<input type="password" class="form-control" placeholder="Повторите пароль" aria-label="Password" aria-describedby="basic-addon1" name="repeatpassword">
		</div>
		<input type="submit" class="input-group mb-3 btn btn-success" value="Зарегистрироваться">
		<h6 class="text-center">Вы уже зарегистрированы? <a href="/auth.php">Войдите</a></h6>
	</form>
	
</body>

</html>