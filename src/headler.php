<?php
$mysqli = new mysqli("localhost", "root", "", "bookhouse");
$result = $mysqli->query("SELECT * FROM `products` INNER JOIN `productcategory` ON products.category = productcategory.idcategory INNER JOIN `author` ON products.author = author.idauthor ORDER BY products.idproduct LIMIT {$_POST['range']}");
var_dump($result);
echo "1";
while ($row = $result->fetch_assoc())
    $string .= $row['some_value'].'<br>';//формируем строку для вывода, лучше делать на стороне клиента
if($string)
    $range = (explode(',',$_POST['range'])[1] .',').(explode(',',$_POST['range'])[1]+10);//формируем новый диапазон
exit(json_encode(['rows' => $string, 'range' => $range]));//возвращаем данные