  <?php session_start(); require_once './src/db.php'; connect_to_db(); ?>

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
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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

                  <form method="post" action="doreg.php">
                    <div class="group">
                      <label class="label">Логин</label>
                      <input type="text" name="login" class="input" placeholder="Ваш логин" required="true">
                    </div>
                    <div class="group">
                      <label class="label">Email адрес</label>
                      <input type="text" name="email" class="input" placeholder="Ваш E-mail" required="true">
                    </div>
                    <div class="group">
                      <label class="label">Пароль</label>
                      <input type="password" id="password" name="pass" class="input" required="true">
                    </div>
                    <div class="group">
                      <label class="label">Повторите пароль</label>
                      <input type="password" id="passwordp" name="passp" class="input" required="true">
                    </div>
                    <div class="group">
                      <input type="submit" class="button" name="go_reg" value="Зарегистрироваться">
                    </div>
                  </form>

                </div>

                <div class="sign-in_tab">
                  <form method="post" action="enter.php" id="login">
                    <div class="group">
                      <label class="label">Логин</label>
                      <input type="text" name="login" class="input" placeholder="Логин">
                    </div>
                    <div class="group">
                      <label class="label">Пароль</label>
                      <input type="password" name="pass" class="input" placeholder="Пароль">
                    </div>
                    <div class="group">
                      <input type="submit" class="button" name="go_enter" value="Войти">
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div> <!-- Modal window -->


    </header>
    <script src="/src/modal.js" type="text/javascript"></script>
</body>
</html>