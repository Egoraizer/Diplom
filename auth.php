<?php session_start(); ?>

<!DOCTYPE html>
<html>

<head>
	<title>Авторизация</title>
	<meta charset="UTF-8">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="/css/auth.css">
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.css">
    <script src="/bootstrap/js/bootstrap.js"></script>
</head>

<body>
	<form action="" method="POST" class="position-absolute top-50 start-50 translate-middle">
		Введите логин
		<div class="input-group mb-3">
  			<span class="input-group-text"><img src="/img/user.png"></span>
  			<input type="text" class="form-control" placeholder="Логин" name="login">
		</div>
		Введите пароль
		<div class="input-group mb-3">
  			<span class="input-group-text"><img src="/img/padlock.png"></span>
  			<input type="password" class="form-control" placeholder="Пароль" name="password">
		</div>
		<input type="submit" class="input-group mb-3 btn btn-success" value="Войти">
		<h6 class="text-center">Еще не зарегистрированы? <a href="/reg.php">Зарегистрируйтесь</a></h6>
	</form>

</body>

</html>