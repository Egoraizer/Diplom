<?php require_once '../src/db.php'; require_once '../src/functions.php'; connect_to_db();?>

<!DOCTYPE html>
<html>
<head>
  <title>Админ панель</title>
  <link rel="stylesheet" type="text/css" href="/css/adminpanel.css">
  <link rel="stylesheet" href="/bootstrap/css/bootstrap.css">
  <script src="/bootstrap/js/bootstrap.js"></script>
</head>

<body>
  <form method="POST" enctype="multipart/form-data" class="position-absolute start-50 top-50 translate-middle mt-5">
    <input type="text" name="title" class="input-group mb-3" placeholder="Введите наименование книги"> 

    <select name="idauthor" class="input-group mb-3">
      <?$query_authors = $conn->query("SELECT * FROM author");
       while ($row = $query_authors->fetch_assoc()) :?>
        <option value="<?= $row['idauthor']?>">
          <?= $row['nameauthor']?>    
        </option>
        <?endwhile;?>
    </select>

    <textarea name="description" rows="10" cols="45"  class="input-group mb-3" placeholder="Введите описание для книги"></textarea>
    <select name="idcategory" class="input-group mb-3">
      <?$query_products = $conn->query("SELECT * FROM productcategory");
       while ($row = $query_products->fetch_assoc()) :?>
        <option value="<?= $row['idcategory']?>">
          <?= $row['namecategory']?>    
        </option>
        <?endwhile;?>
    </select>

    <input type="text" class="input-group mb-3" name="price" placeholder="Введите цену книги">

    <input type="file" class="input-group mb-5" name="file">

    <input type="submit" class="btn btn-success input-group " name="go_upload">
  </form>


<?
    if($_REQUEST['go_upload']): 

      $title = trim(HtmlSpecialChars(strip_tags($_POST['title'])));
      $idauthor = trim(HtmlSpecialChars(strip_tags($_POST['idauthor'])));
      $description = trim(HtmlSpecialChars(strip_tags($_POST['description'])));
      $idcategory = trim(HtmlSpecialChars(strip_tags($_POST['idcategory'])));
      $price = trim(HtmlSpecialChars(strip_tags($_POST['price'])));

      if (empty($title) || empty($idauthor) || empty($description) || empty($idcategory) || empty($price)): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Ошибка!</strong> Заполните все поля.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?elseif (strlen($title) > 40 || strlen($description) > 255 || strlen($price) > 5):?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <strong>Ошибка!</strong> Неккоректно введеные данные. Условие: Наименование < 40, Описание < 255, Цена < 5 символов.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

      <? else: 
          $check = can_upload_image($_FILES['file']);

          if($check === true) :
            make_upload_new_book($_FILES['file'], $conn, $title, $idauthor, $description, $idcategory, $price); ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Успешно!</strong> Файл загружен на сервер.
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

          <?endif; ?>
      <?endif; ?>
    <?endif; ?>
</body>
</html>