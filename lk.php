<?php session_start();
	  if (!isset($_SESSION['user']['login'])) header('Location: index.php'); ?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <title>Личный кабинет</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/index.css">
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.css">
    <script src="/bootstrap/js/bootstrap.js"></script>
</head>
<body>
	<?php require_once './src/header.php'?>
	<div class="123"><?echo $_SESSION['user']['login'];?></div>
</body>
</html>