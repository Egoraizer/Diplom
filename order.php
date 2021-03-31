<?php session_start();?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form method="POST" action="https://yoomoney.ru/quickpay/confirm.xml">    
		<input type="hidden" name="receiver" value="4100116637537324">    
		<input type="hidden" name="formcomment" value="Проект «Железный человек»: реактор холодного ядерного синтеза">    
		<input type="hidden" name="short-dest" value="Проект «Железный человек»: реактор холодного ядерного синтеза">    
		<input type="hidden" name="label" value="1">    
		<input type="hidden" name="quickpay-form" value="donate">    
		<input type="hidden" name="targets" value="транзакция 1">    
		<input type="hidden" name="sum" value="1" data-type="number">    
		<input type="hidden" name="comment" value="Хотелось бы получить дистанционное управление.">    
		<input type="hidden" name="need-fio" value="true">    
		<input type="hidden" name="need-email" value="true">    
		<input type="hidden" name="need-phone" value="true">    
		<input type="hidden" name="need-address" value="false"> 
		<input type="hidden" name="successURL" value="http://diplom/orderaccess.php">     
		<input type="submit" value="Перевести">
	</form>
	<??>
</body>
</html>