<?php 

$product = $_POST['product'];

print_r($product);

setcookie("cookie[cart]", $product);

echo $_COOKIE['cart']['0'];


?>