<?php session_start(); ob_start(); require_once './src/db.php'; require_once './src/functions.php'; connect_to_db(); require_once './src/header.php';?>



<!DOCTYPE html>
<html>
<head>
	<title>Корзина</title>
</head>
<body>
	
</body>
</html>

<? if (empty($_SESSION['user']['cart'])) : ?>

	<div class="alert alert-warning alert-dismissible fade show" role="alert">
		<strong>Корзина пуста.</strong>  Сперва добавьте товар в корзину и возвращайтесь!
	</div>
<? else : ?>
	<div class="cart__page">
		<div class="cart__product">
			<? $ids = array_keys($_SESSION['user']['cart']);
	        $query_products = $conn->query("SELECT * FROM products WHERE idproduct IN (" . implode(',', $ids) . ") ORDER BY idproduct"); 
	        while($row = $query_products->fetch_assoc()) :?>
				<div class="product__content row">
					<div class="product__image col">
						<img src="<?= $row['image'] ?>" height="200px" width="130px">
					</div>
					<div class="product__body col"><?= $row['price'] ?></div>
					<div class="product__info col">123</div>
				</div>
			<?endwhile;?>
		</div>
	</div>
	

<? endif;?>



