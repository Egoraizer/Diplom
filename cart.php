<?php session_start(); ob_start(); require_once './src/db.php'; require_once './src/functions.php'; connect_to_db(); ?>

<!DOCTYPE html>
<html>
<head>
	<title>Корзина</title>
	<link rel="stylesheet" href="/css/cart.css" class="">
</head>
<body>
<? if ($_REQUEST['delprod']) {
	$idproduct = $_GET['delprod'];
	unset($_SESSION['user']['cart'][$idproduct]);
}?>

<?  if ($_REQUEST['minusproduct']) :
		$idproduct = $_GET['minusproduct'];
		$_SESSION['user']['cart'][$idproduct]['amount']--; ?>
<script>document.location.replace('./cart.php'); </script>

<?endif;?>

<?  if ($_REQUEST['addproduct']) :
		$idproduct = $_GET['addproduct'];
		$_SESSION['user']['cart'][$idproduct]['amount']++; ?>
<script>document.location.replace('./cart.php'); </script>

<?endif;?>

<? require_once './src/header.php'; ?>



<? if (empty($_SESSION['user']['cart'])) : ?>
	<div class="alert alert-warning alert-dismissible fade show" role="alert">
		<strong>Корзина пуста.</strong>  Сперва добавьте товар в корзину и возвращайтесь!
	</div>
<? else :  ?>
	<div class="cart__page">
		<div class="cart__product">
			<? $ids = array_keys($_SESSION['user']['cart']);
	        $query_products = $conn->query("SELECT * FROM products INNER JOIN `author` ON products.author = author.idauthor WHERE idproduct IN (" . implode(',', $ids) . ") ORDER BY idproduct"); 
	        while($row = $query_products->fetch_assoc()) : ?>
	        	<?
	        	$totalamount += $_SESSION['user']['cart'][$row['idproduct']]['amount']; 
	        	$price = $row['price'] * $_SESSION['user']['cart'][$row['idproduct']]['amount'];
	        	$totalprice += $price;?>
				<div class="product__content row">
					<div class="product__image col text-center">
						<img src="<?= $row['image'] ?>" height="200px" width="130px">
					</div>
					<div class="product__body col">
						<div class="product-title"><?= $row['title']?></div>
						<div class="product-author"><?= $row['nameauthor']?></div>
						
					</div>
					<div class="product-info col">
						<div class="info-amount">
							<? if ($_SESSION['user']['cart'][$row['idproduct']]['amount'] == 1 ) : ?>
								<div class="amount-change">
									<form method="GET">
										<button type="submit" class="btn btn-danger" disabled>-</button>
										<? echo $_SESSION['user']['cart'][$row['idproduct']]['amount'];?>
										<button type="submit" name="addproduct" class="btn btn-success" value="<?= $row['idproduct']?>">+</button>	
									</form>
								</div>
								<?else : ?>
									<form method="GET">
										<button type="submit" name="minusproduct" class="btn btn-danger" value="<?= $row['idproduct']?>">-</button>
										<?= $_SESSION['user']['cart'][$row['idproduct']]['amount']?>
										<button type="submit" name="addproduct" class="btn btn-success" value="<?= $row['idproduct']?>">+</button>	
									</form>
								
						<? endif;?>
						</div>
						<div class="info-price"><?= $price ?> руб.</div>
					</div>	
					<div class="product-update col">
						<form>
							<button class="btn btn-danger" type="submit" name="delprod" value="<?= $row['idproduct']?>">Удалить</button> 
						</form>
					</div>
				</div>
			<?endwhile;?>
			<div class="cart__order text-center">
				<div class="order-content">
					<div class="order-product">Товаров: <?= $totalamount; ?> шт.</div>
					<div class="order-price">Заказ на сумму: <?= $totalprice;?> руб.</div>
					<div class="order-submit">

						<form method="POST" action="https://yoomoney.ru/quickpay/confirm.xml">    
							<input type="hidden" name="receiver" value="4100116637537324">    
							<input type="hidden" name="formcomment" value="Проект «Железный человек»: реактор холодного ядерного синтеза">    
							<input type="hidden" name="short-dest" value="Проект «Железный человек»: реактор холодного ядерного синтеза">    
							<input type="hidden" name="label" value="1">    
							<input type="hidden" name="quickpay-form" value="donate">    
							<input type="hidden" name="targets" value="транзакция 1">    
							<input type="hidden" name="sum" value="2" data-type="number">    
							<input type="hidden" name="comment" value="Хотелось бы получить дистанционное управление.">    
							<input type="hidden" name="need-fio" value="true">    
							<input type="hidden" name="need-email" value="true">    
							<input type="hidden" name="need-phone" value="true">    
							<input type="hidden" name="need-address" value="false"> 
							<input type="hidden" name="successURL" value="http://diplom/index.php">     
							<input type="submit" class="btn btn-success" value="Оформить заказ">
						</form>
					</div>
				</div>
				
			</div>
		</div>
	</div>
	

<? endif;?>


</body>
</html>