
<?php
$mysqli = new mysqli("localhost", "root", "", "bookhouse");
$query_products = $mysqli->query("SELECT * FROM `products` INNER JOIN `productcategory` ON products.category = productcategory.idcategory INNER JOIN `author` ON products.author = author.idauthor ORDER BY products.idproduct LIMIT {$_POST['range']}");
while ($row = $query_products->fetch_assoc()): 


	echo '<div class="hu">123</div>';?>
	



<?$string .= $row['title'];?> 

<?endwhile;?>
<?
	if($string)
	    $range = (explode(',',$_POST['range'])[1] .',').(explode(',',$_POST['range'])[1]+10);//формируем новый диапазон
	exit(json_encode(['rows' => $string, 'range' => $range]));//возвращаем данные
	