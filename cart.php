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
<? else : 
        $query_products = $conn->query("SELECT * FROM products  WHERE `idproduct`={$id}"); ?>
<? var_dump($_SESSION['user']);?>

	<div class="cart__page">
		<div class="cart__content container">
			<table class="table table-dark">
	  <thead>
	    <tr>
	      <th scope="col"></th>
	      <th scope="col">First</th>
	      <th scope="col">Last</th>
	      <th scope="col">Handle</th>
	    </tr>
	  </thead>
	  <tbody>
	    <tr>
	      <th scope="row"><img src="../img/door.png"></th>
	      <td>Mark</td>
	      <td>Otto</td>
	      <td>@mdo</td>
	    </tr>
	    <tr>
	      <th scope="row">2</th>
	      <td>Jacob</td>
	      <td>Thornton</td>
	      <td>@fat</td>
	    </tr>
	    <tr>
	      <th scope="row">3</th>
	      <td>Larry</td>
	      <td>the Bird</td>
	      <td>@twitter</td>
	    </tr>
	  </tbody>
	</table>
		</div>
	</div>
	

<? endif;?>



