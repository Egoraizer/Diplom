<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <title>Книжный дом</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <script src="bootstrap/js/bootstrap.js"></script>
</head>
<body>ы
	<header>
        <div class="header__container">
           <div class="header__content d-flex justify-content-between">

            <div class="header__logo">
               <div class="logo__icon">
                   <img src="/img/logo.jpg" alt="">
               </div>
            </div>

            <div class="header__search">
              <div class="search__content">
                <form action="/index.php" method="GET">
                     <div class="input-group" style="width:500px">
                          <input type="text" class="form-control" placeholder="Поиск книги..." name="q">
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
                <div class="header__lk">
                                    <!-- НЕ ЗАБУДЬ ПРО ОТКРЫТУЮ ДВЕРЬ-->
                    <div class="lk__info">Личный кабинет</div>
                    <a href="/lk.php"><img src="/img/door.png" alt="" class="lk__logo"></a>
                </div>
            </div>

           </div>
        </div>
        <div class="line"></div>
    </header>

</body>
</html>