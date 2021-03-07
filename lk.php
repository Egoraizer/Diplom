<?php session_start();
	  if (!isset($_SESSION['userlogin'])) header('Location: reg.php'); ?>


<!DOCTYPE html>
<html>
<head>
	<title>Личный кабинет</title>
</head>
<body>
	<div class="123"><?echo $_SESSION['userlogin'];?></div>
</body>
</html>