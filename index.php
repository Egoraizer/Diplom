<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Книжный дом</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <script src="bootstrap/js/bootstrap.js"></script>
</head>

<body>
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

    <div class="news__carousel">
        <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="/img/collapse/1.jpg" class="d-block " alt="..." height="100%" width="100%">
            </div>
            <div class="carousel-item">
              <img src="/img/collapse/1.jpg" class="d-block " alt="..." height="100%" width="100%">
            </div>
            <div class="carousel-item">
              <img src="/img/collapse/1.jpg" class="d-block " alt="..." height="100%" width="100%">
            </div>
          </div>
        </div>
    </div>

  <main>
    <div class="main__content d-flex justify-content-between">
      <div class="main__category">
        <div class="category__content">
          <h1 class="text-center">Категории</h1>
          <?php 
            $conn = mysqli_connect('localhost', 'root', '', 'bookhousebase');
            $q = $conn->query("SELECT * FROM productcategory");
            while($row = $q->fetch_assoc()) { ?>
              <div class="category__filter-item">
                <label class="filter__checkbox">

                  <input type="checkbox" name="" data-idprod="<? echo $row['idproductcategory']?>">

                </label>
                <?echo $row['name'];?>
              </div>
            <?}?>
        </div>
      </div>
      <div class="main__products">
        \фыфыв
      </div>
    </div>
  </main>
<!--
    <p>
      <a class="btn btn-primary" data-bs-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Категории</a>
    </p>

    <div class="row">
      <div class="col">
        <div class="collapse multi-collapse" id="multiCollapseExample1">
          <div class="">
          </div>
        </div>
      </div>
    </div>
-->
</body>
</html>
