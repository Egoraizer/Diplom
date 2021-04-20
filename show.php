<?php session_start(); ob_start(); require_once './src/db.php'; require_once './src/functions.php'; connect_to_db(); ?>


<? require_once './src/header.php'?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <title>Страница книги</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/show.css">


    <link rel="stylesheet" href="/bootstrap/css/bootstrap.css">
    <script src="/bootstrap/js/bootstrap.js"></script>
</head>
<body>
	<main>
		<div class="main__page">
			<div class="page__info row">
			<?
			$idproduct = $_GET['productid'];
			$query_book = $conn->query("SELECT * FROM products INNER JOIN productcategory ON products.category = productcategory.idcategory where products.idproduct = $idproduct");
			while($row = $query_book->fetch_assoc()) :?>
				<div class="info-img col-3">
					<img src="<?= $row['image']?>" height="500px" width="330px"> <br>
				</div>
				<div class="info-content col-8">
					<div class="content-title">Наименование:<?= $row['title']?></div>
					<div class="content-category">Жанр: <?= $row['namecategory']?></div>
					<div class="content-price">Цена: <?= $row['price']?> рублей за 1 шт.</div>
					<div class="content-desription"><?= $row['description']?></div>
					<div class="content-order">
	                  <form action="/index.php" method="get">
	                    <? if (isset($_SESSION['user']['cart'][$idproduct])): ?>
	                      <button type="submit" name="productincart" class="btn btn-danger" style="width:100%;" value="<?= $row['idproduct']?>">В корзине</button>
	                    <? else : ?>
	                      <button type="submit" name="addproduct" class="btn btn-success" style="width:100%;" value="<?= $row['idproduct']?>">В корзину</button>
	                    <? endif;?>
	                  </form>
	              	</div>
				</div>
			<?endwhile;?>
			</div>
		</div>
	</main>
</body>
</html>