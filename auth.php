<?php session_start();  require_once './src/db.php'; connect_to_db();  ?>

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
	<form method="POST" class="position-absolute top-50 start-50 translate-middle">
		Введите логин
		<div class="input-group mb-3">
  			<span class="input-group-text"><img src="/img/user.png"></span>
  			<input type="text" class="form-control" placeholder="Логин" name="userlogin">
		</div>
		Введите пароль
		<div class="input-group mb-3">
  			<span class="input-group-text"><img src="/img/padlock.png"></span>
  			<input type="password" class="form-control" placeholder="Пароль" name="userpassword">
		</div>
		<input type="submit" class="input-group mb-3 btn btn-success" value="Войти" name="go_auth">
		<h6 class="text-center">Еще не зарегистрированы? <a href="/reg.php">Зарегистрируйтесь</a></h6>
	</form>
	<? if($_REQUEST['go_auth']):
		$userlogin = trim(HtmlSpecialChars(strip_tags($_POST['userlogin'])));
		$userpassword = trim(HtmlSpecialChars(strip_tags($_POST['userpassword'])));
			if (empty($userlogin) || empty($userpassword)): ?>
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Ошибка!</strong> Заполните все поля
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
			<?else: 
				$query_users = $conn->query("SELECT `login`, `password` FROM `users`");
				while($row = $query_users->fetch_assoc()):
					if ($userlogin == $row['login'] && $userpassword == $row['password']): ?>
						<div class="alert alert-success alert-dismissible fade show" role="alert">
						<strong>Верно, все корректно!</strong> 
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
					<?elseif ($row['iduser']):?>
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<strong>Данного пользователя не найдено.</strong> 
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
					<?break;?>
					<?endif;?>
				<?endwhile;?>
			<? endif;?>	
		
		<? endif;?>

</body>

</html>