  <?php session_start(); require_once './src/db.php'; connect_to_db(); ?>

<?
  if ($_REQUEST['reg']) {
      $userlogin = trim(HtmlSpecialChars(strip_tags($_POST['userlogin'])));
      $useremail = trim(HtmlSpecialChars(strip_tags($_POST['useremail'])));
      $userpassword = trim(HtmlSpecialChars(strip_tags($_POST['userpassword'])));
      $userrpassword = trim(HtmlSpecialChars(strip_tags($_POST['userrpassword'])));
      $userpassword = md5($userpassword);
      $userrpassword = md5($userrpassword);

		  $query_users = $conn->query("SELECT `login`, `email` FROM `users` WHERE `login` = '$userlogin' OR `email` = '$useremail'");
      
      if ($query_users->num_rows === 0) {
        if (strlen($userlogin) > 50 || strlen($useremail) > 50) MessageForUser('warning', 'Логин или почта слишком длинные. Напишите логин и почту менее 50 символов.');
        elseif ($userrpassword !== $userpassword) MessageForUser('warning', 'Пароли не совпадают.');
        else {
            $currentdate = date('Y-m-d');
            $query_new_user = $conn->query("INSERT INTO `users` (`login`, `email`, `password`, `createdate`) VALUES ('$userlogin', '$useremail', '$userpassword','$currentdate')");
            
            $_SESSION['user']['iduser'] = $row['id'];
            $_SESSION['user']['login'] = $userlogin;
            $_SESSION['user']['email'] = $useremail;
            header('Location:lk.php');
            ob_end_flush();
            exit();
        }
      }	
    else MessageForUser('warning','Логин или почта уже заняты.');
  }
?>


<? 
  if ($_REQUEST['enter']) {
    $userlogin = trim(HtmlSpecialChars(strip_tags($_POST['userlogin'])));
    $userpassword = trim(HtmlSpecialChars(strip_tags($_POST['userpassword'])));
    $userpassword = md5($userpassword);

    $query_users = $conn->query("SELECT * FROM `users` WHERE `login`= '$userlogin'");

    if ($query_users->num_rows === 0) MessageForUser('warning', 'Такого пользователя не существует.');
    else {
      while($row = $query_users->fetch_assoc()) {

        if ($userpassword != $row['password']) {
          MessageForUser('danger','Пароль введен не верно.');
          break;
        } 
        elseif ($row['ban'] == 1) {
          MessageForUser('danger', 'Вы были заблокированы. За подробностями обратитесь на почту <strong>kkep2201@gmail.com</strong>');
          break;
        }
        elseif ($userpassword == $row['password']) {
          MessageForUser('success', 'Вход выполен.');
          $_SESSION['user']['iduser'] = $row['id'];
          $_SESSION['user']['login'] = $userlogin;
          $_SESSION['user']['email'] = $row['email'];
          header('Location: index.php');
          break;
        }

      }	
    }
  }
?>

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
                     <div class="search__input input-group">
                          <input type="input-group" class="form-control" placeholder="Поиск книги..." name="q">
                          <button class="btn btn-danger" type="submit"><img src="/img/1.png" alt="" width="35px" height="35px"></button>
                      </div>
                </form>
              </div>
            </div>

            <div class="header__personal">
                <div class="header__cart">
                    <?if (!empty($_SESSION['user']['cart'])) :
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
                        <a class="btn btn-danger" href="/src/logout.php">Выход</a> <br> 
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
                      <input type="email" name="useremail" class="input" placeholder="Ваш E-mail" required="true">
                    </div>
                    <div class="group">
                      <label class="label">Пароль</label>
                      <input type="password" name="userpassword" name="pass" class="input" placeholder="Ваш пароль" required="true">
                    </div>
                    <div class="group">
                      <label class="label">Повторите пароль</label>
                      <input type="password"  name="userrpassword" class="input" placeholder="Повторите пароль" required="true">
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