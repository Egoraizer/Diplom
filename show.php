<?php session_start(); ob_start(); require_once './src/db.php'; require_once './src/functions.php'; connect_to_db(); ?>


<? require_once './src/header.php'?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <title>Страница книги</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/index.css">
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.css">
    <script src="/bootstrap/js/bootstrap.js"></script>
</head>
<body>
	<main>
		<div class="main__page">
			<div class="page__info row">
			<?
			$idproduct = $_GET['productid'];
			$query_book = $conn->query("SELECT * FROM products WHERE `idproduct` = $idproduct");
			while($row = $query_book->fetch_assoc()) :?>
				<div class="info-img col">
					<img src="<?= $row['image']?>"> <br>
				</div>
				<div class="info-content col"><?= $row['title']?></div>
				<?endwhile;?>
			</div>
		</div>
	</main>
</body>
</html>