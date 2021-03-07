<?php session_start(); 
ob_start();?>

<!DOCTYPE html>
<html>

<head>
	<title>Регистрация</title>
	<meta charset="UTF-8">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="/css/regauth.css">
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.css">
    <script src="/bootstrap/js/bootstrap.js"></script>
</head>

<body>
	<form method="POST" class="position-absolute top-50 start-50 translate-middle">
		Введите логин
		<div class="input-group mb-3">
  			<span class="input-group-text" id="basic-addon1"><img src="/img/user.png"></span>
  			<input type="text" class="form-control" placeholder="Логин" name="userlogin">
		</div>
		Введите email
		<div class="input-group mb-3">
  			<span class="input-group-text" id="basic-addon1"><img src="/img/email.png"></span>
  			<input type="email" class="form-control" placeholder="Почта" name="useremail">
		</div>
		Введите пароль
		<div class="input-group mb-3">
  			<span class="input-group-text" id="basic-addon1"><img src="/img/padlock.png"></span>
  			<input type="password" class="form-control" placeholder="Пароль" name="userpassword">
		</div>
		Повторите пароль
		<div class="input-group mb-3">
  			<span class="input-group-text" id="basic-addon1"><img src="/img/padlock.png"></span>
  			<input type="password" class="form-control" placeholder="Повторите пароль" name="userrpassword">
		</div>
		<input type="submit" class="input-group mb-3 btn btn-success" value="Зарегистрироваться" name="go_reg">
		<h6 class="text-center">Вы уже зарегистрированы? <a href="/auth.php">Войдите</a></h6>
	</form>
	
<?
	require_once './src/db.php'; connect_to_db(); 

	if($_REQUEST['go_reg']):
		$userlogin = trim(HtmlSpecialChars(strip_tags($_POST['userlogin'])));
		$useremail = trim(HtmlSpecialChars(strip_tags($_POST['useremail'])));
		$userpassword = trim(HtmlSpecialChars(strip_tags($_POST['userpassword'])));
		$userrpassword = trim(HtmlSpecialChars(strip_tags($_POST['userrpassword'])));

		if (empty($userlogin) || empty($useremail) || empty($userpassword) || empty($userrpassword)): ?>
			<div class="alert alert-danger alert-dismissible fade show" role="alert">
		  		<strong>Ошибка!</strong> Заполните все поля
		  		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
		<? else: 
			$query_users = $conn->query("SELECT `login`, `email` FROM `users`");
			while($row = $query_users->fetch_assoc()):

				if ($row['login'] == $userlogin || $row['email'] == $useremail):?>
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
				  		<strong>Ошибка!</strong> Логин или почта уже заняты.
				  		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
				<? break;?>	

				<? elseif(strlen($userlogin) > 50 || strlen($useremail) > 50): ?>
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
				  		<strong>Ошибка!</strong> Логин или почта слишком длинные. Напишите логин и почту менее 50 символов.
				  		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
				<? break;?>	

				<? elseif($userrpassword !== $userpassword): ?>
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
				  		<strong>Ошибка!</strong> Пароли не совпадают
				  		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
				<? break;?>	

				<? else:
					$query_new_user = $conn->query("INSERT INTO `users` (`email`, `login`, `password`) VALUES ('$useremail', '$userlogin', '$userpassword')");
					$_SESSION['userlogin'] = $userlogin;
					$_SESSION['useremail'] = $useremail;
					header('Location:lk.php');
					ob_end_flush();
					exit();?>	

			<? endif; 	endwhile;?>

		<? endif; ?>

	<? endif;?>

</body>

</html>