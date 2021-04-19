<?php
$mysqli = new mysqli("localhost", "root", "", "bookhouse");
$result = $mysqli->query("SELECT * FROM `products` INNER JOIN `productcategory` ON products.category = productcategory.idcategory INNER JOIN `author` ON products.author = author.idauthor ORDER BY products.idproduct LIMIT 0,10");
while ($row = $result->fetch_assoc())
    echo $row['title'].'<br>';
?>
<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $(".button").click(function(){
    // получаем диапазон, допустим будем хранить его в id кнопки
    let range = this.id;
    $.ajax({
        type: "POST",
        url: "handler.php",//обработчик
        data: { range: range }//передаем диапазон
        }).done(function(result) {//обрабатываем результат
            result = JSON.parse(result);//распаковываем json в объект
            if(result.rows)//проверяем результат на пустоту
            {
                document.getElementById('content').innerHTML += result.rows;//выводим данные нового диапазона
                document.getElementById(range).id = result.range;//назначаем новый диапазон
            }
        });
  });
});
</script>
</head>
<body>
<div id="content">
</div>
    <button id="10,20" class="button">More</button>
</body>
</html>