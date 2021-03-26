  <?php session_start(); require_once './src/db.php'; connect_to_db(); ?>

  <?
  
  if($_REQUEST['reg']):
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
					$query_new_user = $conn->query("INSERT INTO `users` (`login`, `email`, `password`) VALUES ('$userlogin', '$useremail', '$userpassword')");
					$_SESSION['user']['login'] = $userlogin;
					$_SESSION['user']['email'] = $useremail;
					header('Location:index.php');
					ob_end_flush();
					exit();?>	

			<? endif; 	endwhile;?>

		<? endif; ?>

	<? endif;?>

  <? if($_REQUEST['enter']):
		$userlogin = trim(HtmlSpecialChars(strip_tags($_POST['userlogin'])));
		$userpassword = trim(HtmlSpecialChars(strip_tags($_POST['userpassword'])));
			if (empty($userlogin) || empty($userpassword)): ?>
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Ошибка!</strong> Заполните все поля
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
			<?else: $query_users = $conn->query("SELECT * FROM `users` WHERE `login`= '$userlogin'");
				if($query_users->num_rows === 0): ?>
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
					<strong> Ошибка! </strong> Такого пользователя не сущесвует
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>

				<?else:
					while($row = $query_users->fetch_assoc()):
						if ($userpassword == $row['password']): ?>
							<div class="alert alert-success alert-dismissible fade show" role="alert">
							<strong>Успешно!</strong> Вход выполнен.
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>
						<? 					
						$_SESSION['user']['login'] = $userlogin;
						$_SESSION['user']['email']  = $row['email'];
						header('Location: index.php')
						?>
						<?break;?>
						<?elseif ($userpassword != $row['password']):?>
							<div class="alert alert-danger alert-dismissible fade show" role="alert">
							<strong>Ошибка! </strong> Пароль введен не верно.
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>
						<?break;?>
						<?endif;?>
					<?endwhile;?>
					<? endif;?>	
			<? endif;?>	
		
		<? endif;?>
<!DOCTYPE html>
<html>

<head>
	  <meta charset="UTF-8">
    <title>Книжный дом</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/header.css">
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.css">
    <script src="/bootstrap/js/bootstrap.js"></script>
    <link rel="stylesheet" type="text/css" href="/css/modal.css">
    

</head>
<body>
	<header>
        <div class="header__container">
           <div class="header__content d-flex justify-content-between">

            <div class="header__logo">
               <div class="logo__icon">
                   <img src="/img/logo.jpg" alt="" href="index.php" onclick="location.href='/index.php';"> 
               </div>
            </div>

            <div class="header__search">
              <div class="search__content">
                <form action="/index.php" method="GET">
                     <div class="input-group" style="width:500px">
                          <input type="text input-group" class="form-control" placeholder="Поиск книги..." name="q">
                          <button class="btn btn-danger" type="submit"><img src="/img/1.png" alt="" width="35px" height="35px"></button>
                      </div>
                </form>
              </div>
            </div>

            <div class="header__personal">
                <div class="header__cart">
                    <?if (isset($_SESSION['user']['cart'])) :
                    $productamount = count($_SESSION['user']['cart']); ?>
                    <div class="cart__info">В корзине товаров: <?= $productamount;?> </div>
                    <a href="/cart.php"><img src="/img/books.png" alt="" class="cart__logo"></a>

                    <?else:?>
                    <div class="cart__info">Корзина</div>
                    <a href="/cart.php"><img src="/img/books.png" alt="" class="cart__logo"></a>
                    <?endif;?>
                </div>
                    
                <div class="header__lk text-center">
                    <? if (!isset($_SESSION['user']['login'] )): ?>
                        <div class="lk__info">Личный кабинет</div>
                        <img src="/img/door.png" alt="" class="lk__logo" data-modal="#modal">
                    <? else: ?>
                        <div class="lk__info"><?= $_SESSION['user']['login'] ;?></div>
                        <a href="/lk.php"><img src="/img/doorway.png" alt="" class="lk__logo"></a>
                        <a class="btn btn-danger" href="/src/logout.php">Выход</a>  
                    <?endif;?>
                </div>
            </div>

           </div>
        </div>
        <div class="line"></div>

        <div class="modal" id="modal">
          <div class="login_wrap">
            <div class="login_tab">

              <input id="tab-1" type="radio" name="tab" class="sign_in" checked>
                <label for="tab-1" class="tab"><b>Регистрация</b></label>
              <input id="tab-2" type="radio" name="tab" class="sign_up">
                <label for="tab-2" class="tab"><b>Авторизация</b></label>

              <div class="login_form">
                
                <div class="sign-up_tab">

                  <form method="post">
                    <div class="group">
                      <label class="label">Логин</label>
                      <input type="text" name="userlogin" class="input" placeholder="Ваш Логин" required="true">
                    </div>
                    <div class="group">
                      <label class="label">Email адрес</label>
                      <input type="text" name="useremail" class="input" placeholder="Ваш E-mail" required="true">
                    </div>
                    <div class="group">
                      <label class="label">Пароль</label>
                      <input type="password" name="userpassword" name="pass" class="input" required="true">
                    </div>
                    <div class="group">
                      <label class="label">Повторите пароль</label>
                      <input type="password"  name="userrpassword" class="input" required="true">
                    </div>
                    <div class="group">
                      <input type="submit" class="button" name="reg" value="Зарегистрироваться">
                    </div>
                  </form>

                </div>

                <div class="sign-in_tab">
                  <form method="post">
                    <div class="group">
                      <label class="label">Логин</label>
                      <input type="text" name="userlogin" class="input" placeholder="Логин" required="true">
                    </div>
                    <div class="group">
                      <label class="label">Пароль</label>
                      <input type="password" name="userpassword" class="input" placeholder="Пароль" required="true">
                    </div>
                    <div class="group">
                      <input type="submit" class="button" name="enter" value="Войти">
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div> 
    </header>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="/src/modal.js" type="text/javascript"></script>
</body>
</html>