<?php session_start(); ob_start(); require_once './src/db.php'; require_once './src/functions.php'; connect_to_db(); ?>



<? 
  if ($_REQUEST['addproduct']) :

    $id = intval($_GET['addproduct']);

    if (isset($_SESSION['user']['cart'][$id])) :
        $_SESSION['user']['cart'][$id]['amount']++; ?>
        <script>document.location.replace('./index.php'); </script>

    <? else :
        $query_products = $conn->query("SELECT * FROM products  WHERE `idproduct`={$id}");

        if (mysqli_num_rows($query_products) != 0) :
            $row_s = mysqli_fetch_array($query_products);

            $_SESSION['user']['cart'][$row_s['idproduct']] = array(
                "amount" => 1
            ); ?>
            <script>document.location.replace('./index.php');</script>

        <? else : ?> 

          <script>document.location.replace('./index.php');</script>
        <?endif;
      endif;
    elseif ($_REQUEST['productincart']) : ?>  
      <script>document.location.replace('./cart.php');</script> <?
    endif; 
    ?> 

<? require_once './src/header.php'?>
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
          <h4>Категории</h4>
              <div class="category__filter-item"> 
                <label class="filter__checkbox">
                  <form>
                    <? ?>
                    <input type="submit" name="f" data-idprod="" value="триллер">
                  </form>
                  
                </label>
              </div>
        </div>
      </div>


      <div class="main__products">

        <? if ($_GET['q']) :
            $search = $_GET['q'];
            $query_search = $conn->query("SELECT * FROM `products` INNER JOIN `productcategory` ON products.category = productcategory.idcategory INNER JOIN `author` ON products.author = author.idauthor  WHERE `title` LIKE '%$search%' ORDER BY products.idproduct"); ?>

              <div class="search__result text-center">
                <h5>
                  <?if ($query_search->num_rows === 0 ) :?>
                    Извините, но по вашему запросу <b>"<?= $search ?>"</b> ничего не найдено.</h5>
                  <?else :?>
                    По запросу <b>"<?= $search ?>"</b> найдено:
                  <?endif;?>
                </h5>
           

        <div class="container__products">
          <div class="products__cards row">
          <?
             while ($row = $query_search->fetch_assoc()) : $currentproduct = $row['idproduct']?>
              <div class="card col-2">

                <div class="card-img-top mb-2 text-center "><img src="<?= $row['image']?>" style="width: 250px; width: 150px;"></div>

                <div class="card-body">

                  <div class="card-title">
                    <?= $row['price']?> руб.<br> <?= $row['title'] ?> 
                  </div>

                </div>


                <div class="card-text"> 
                  <?= $row['nameauthor']?>  
                </div>

                <div class="card-btn text-center"> 
                  <form action="" method="get">
                    <? if (isset($_SESSION['user']['cart'][$currentproduct])): ?>
                      <button type="submit" name="productincart" class="btn btn-danger" style="width:100%;" value="<?= $row['idproduct']?>">В корзине</button>
                    <? else : ?>
                      <button type="submit" name="addproduct" class="btn btn-success" style="width:100%;" value="<?= $row['idproduct']?>">В корзину</button>
                    <? endif;?>

                  </form>

                </div>      
              </div>
             <? endwhile; ?>
            </div> 
          </div>

        <?else :?>
        <div class="container__products">
          <div class="products__cards row">
            <?
            if ($_GET['page']) { 
              $predlimit = $predlimit + 8; 
              $test = 8 * $_GET['page']; echo $predlimit ."+". $test;
            }
              else $predlimit = 0; $test = 8; ?>
          <? $query_products = $conn->query("SELECT * FROM `products` INNER JOIN `productcategory` ON products.category = productcategory.idcategory INNER JOIN `author` ON products.author = author.idauthor ORDER BY products.idproduct LIMIT $predlimit,$test");
             while ($row = $query_products->fetch_assoc()) : $currentproduct = $row['idproduct']?>
              <div class="card col-2">

                <div class="card-img-top mb-2 text-center ">
                  <a href="show.php?productid=<?= $row['idproduct']?>"><img src="<?= $row['image']?>" style="width: 250px; width: 150px;">
                  </a>
                </div>

                <div class="card-body ">

                  <div class="card-title">
                    <?= $row['price']?> руб.<br> <?= $row['title'] ?> 
                  </div>

                </div>


                <div class="card-text"> 
                  <?= $row['nameauthor']?>  
                </div>

                <div class="card-btn text-center"> 

                  <form action="" method="get">
                    <? if (isset($_SESSION['user']['cart'][$currentproduct])): ?>
                      <button type="submit" name="productincart" class="btn btn-danger" style="width:100%;" value="<?= $row['idproduct']?>">В корзине</button>
                    <? else : ?>
                      <button type="submit" name="addproduct" class="btn btn-success" style="width:100%;" value="<?= $row['idproduct']?>">В корзину</button>
                    <? endif;?>
                  </form>
                </div>      
              </div>
             <? endwhile; ?>
             <?endif;?>
            </div>
          </div> 
        </div>
      </div>
    </div>                         
  </main> 
</body>
</html>

<? ob_end_flush();?>

