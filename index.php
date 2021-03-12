<?php session_start(); require_once './src/db.php'; require_once './src/functions.php'; connect_to_db(); ?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Книжный дом</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/index.css">
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.css">
    <script src="/bootstrap/js/bootstrap.js"></script>
</head>

<body>
  <?php require_once './src/header.php'?>

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

              <div class="category__filter-item"> 
                <label class="filter__checkbox">
                  <input type="checkbox" name="" data-idprod="">
                </label>
              </div>
        </div>
      </div>


      <div class="main__products">
        <div class="container__products">
          <div class="products__cards overflow-hidden row row-cols-4">
          <?$query_products = $conn->query("SELECT * FROM `products` INNER JOIN `productcategory` ON products.category = productcategory.idcategory INNER JOIN `author` ON products.author = author.idauthor ORDER BY products.idproduct LIMIT 9");
             while ($row = $query_products->fetch_assoc()) :?>
              <div class="card-shop">
                <div class="card__img col text-center">
                  <img src="<?= $row['image'];?>" height="300px" width="200px">
                </div>
                <div class="card__content">
                  <div class="content__title"><p><?= $row['price'];?> руб. <br>
                  <?= $row['title']?></p></div>

                  <div class="content__author"><?= $row['nameauthor']?></div>
                </div>
                <a href="./cart.php" class="btn btn-success" name="<?= $row['idproduct']?>">В корзину</a>
              </div>

             <? endwhile; ?>
            </div>    
        </div>
        </div>
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
