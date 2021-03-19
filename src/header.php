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
                   <div class="cart__info">В корзине товаров: 0 </div>
                   <a href="/cart.php"><img src="/img/books.png" alt="" class="cart__logo"></a>

                </div>
                <div class="header__lk text-center">
                    <? if (!isset($_SESSION['userlogin'])): ?>
                        <div class="lk__info">Личный кабинет</div>
                        <a href="/lk.php"><img src="/img/door.png" alt="" class="lk__logo"></a>
                    <? else: ?>
                        <div class="lk__info"><?= $_SESSION['userlogin'];?></div>
                        <a href="/lk.php"><img src="/img/doorway.png" alt="" class="lk__logo"></a>
                        <a class="btn btn-danger" href="/src/logout.php">Выход</a>  
                    <?endif;?>
                </div>
            </div>

           </div>
        </div>
        <div class="line"></div>
    </header>

</body>
</html>