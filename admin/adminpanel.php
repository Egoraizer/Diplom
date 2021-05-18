<?php session_start(); require_once '../src/db.php'; require_once '../src/functions.php'; connect_to_db();?>

<?
  if ($_POST['adminlog']) {
    $login = trim(HtmlSpecialChars(strip_tags($_POST['login'])));
    $password = trim(HtmlSpecialChars(strip_tags($_POST['password'])));

    $query_users = $conn->query("SELECT * FROM `users` WHERE `login`= '$login' AND (`role` = 'moderator' or `role` = 'admin')");

    if ($query_users->num_rows === 0) MessageForUser('warning', 'Такого пользователя не сущесвует или у вас недостаточно прав.');
    else {
      while ($row = $query_users->fetch_assoc()) {
        if ($password == $row['password']) { $_SESSION['admin']['login'] = $login; $_SESSION['admin']['role'] = $row['role']; break; }
        elseif ($password != $row['password']) { MessageForUser('danger', 'Пароль введен не верно.'); break; } 
      }
    }	
  } 
?>

<?  
  if ($_POST['addbook']){ 
    $title = trim(HtmlSpecialChars(strip_tags($_POST['title'])));
    $idauthor = trim(HtmlSpecialChars(strip_tags($_POST['idauthor'])));
    $description = trim(HtmlSpecialChars(strip_tags($_POST['description'])));
    $idcategory = trim(HtmlSpecialChars(strip_tags($_POST['idcategory'])));
    $price = trim(HtmlSpecialChars(strip_tags($_POST['price'])));

    if (empty($title) || empty($idauthor) || empty($description) || empty($idcategory) || empty($price)) MessageForUser('danger', 'Заполните все поля.');
    elseif (strlen($title) > 40 || strlen($price) > 5) MessageForUser('warning', 'Неккоректно введеные данные. Условие: Наименование < 40,  Цена < 5 символов.');
    else {
      $check = can_upload_image($_FILES['file']);
      if($check === true) {
        make_upload_new_book($_FILES['file'], $conn, $title, $idauthor, $description, $idcategory, $price); 
      }
    }
  }
?>

<? 
  if ($_POST['delbook']) {
    $idbook = trim(HtmlSpecialChars(strip_tags($_POST['idbook'])));

    $query_book = $conn->query("SELECT * FROM `products` WHERE `idproduct` = '$idbook'");

    if ($query_book->num_rows == 0) MessageForUser('danger','Такой книги не существует или неправильно введен номер.');
    else { 
      $query_del_book = $conn->query("DELETE FROM `products` WHERE `products`.`idproduct` = '$idbook'"); 
      
      MessageForUser('success', 'Книга с номером <strong>'.$idbook.'</strong> успешно удалена!'); 
    }
  }
?>

<? 
  if ($_POST['changebook']) {
    $idbook = trim(HtmlSpecialChars(strip_tags($_POST['idbook'])));
    $title = trim(HtmlSpecialChars(strip_tags($_POST['title'])));
    $idauthor = trim(HtmlSpecialChars(strip_tags($_POST['idauthor'])));
    $description = trim(HtmlSpecialChars(strip_tags($_POST['description'])));
    $idcategory = trim(HtmlSpecialChars(strip_tags($_POST['idcategory'])));
    $price = trim(HtmlSpecialChars(strip_tags($_POST['price']))); 

    $query_change_book = $conn->query("UPDATE `products` SET `title` = '$title', `author` = '$idauthor', `description` = '$description', `category` = '$idcategory', `price` = '$price' WHERE `idproduct` = '$idbook'");
    
    MessageForUser('success', 'Книга с номером <strong>'.$idbook.'</strong> успешно изменена!');
  }
?>

<? 
  if ($_POST['addcategory']) {
    $namecategory = trim(HtmlSpecialChars(strip_tags($_POST['namecategory']))); 
    
    $query_add_category = $conn->query("INSERT INTO `productcategory` (`namecategory`) VALUES ('$namecategory')");
    
    MessageForUser('success', 'Новая категория <strong>'.$namecategory.'</strong> была успешно добавлена!');
  }
?>

<? 
  if ($_POST['delcategory']) {
    $idcategory = trim(HtmlSpecialChars(strip_tags($_POST['idcategory'])));
    
    $query_del_category = $conn->query("SELECT * FROM `productcategory` WHERE `idcategory` = '$idcategory'");

      if ($query_del_category->num_rows == 0) MessageForUser('danger', 'Такой категории не существует или неправильно введен номер.');
      else {
          $query_del_category = $conn->query("DELETE FROM `productcategory` WHERE `idcategory` = '$idcategory'");
          MessageForUser('success', 'Категория с номером <strong>'.$idcategory.'</strong> успешно удалена!'); 
      }
  }
?>

<? 
  if ($_POST['changecategory']) {
    $idcategory = trim(HtmlSpecialChars(strip_tags($_POST['idcategory'])));
    $namecategory = trim(HtmlSpecialChars(strip_tags($_POST['namecategory']))); 

    $query_change_category = $conn->query("UPDATE `productcategory` SET `namecategory` = '$namecategory' WHERE `idcategory` = '$idcategory'");

    MessageForUser('success', 'Категория с номером <strong>'.$idcategory.'</strong> успешно изменена!');
  }
?>

<? 
  if ($_POST['addauthor']) {
    $nameauthor = trim(HtmlSpecialChars(strip_tags($_POST['nameauthor']))); 
    
    $query_add_author = $conn->query("INSERT INTO `author` (`nameauthor`) VALUES ('$nameauthor')");
    
    MessageForUser('success', 'Новый автор <strong>'.$nameauthor.'</strong> был успешно добавлен!');
  }
?>

<? 
  if ($_POST['delauthor']) {
    $idauthor = trim(HtmlSpecialChars(strip_tags($_POST['idauthor'])));
    
    $query_del_author = $conn->query("SELECT * FROM `author` WHERE `idauthor` = '$idauthor'");

      if ($query_del_author->num_rows == 0) MessageForUser('danger', 'Такого автора не существует или неправильно введен номер.');
      else {
          $query_del_author= $conn->query("DELETE FROM `author` WHERE `idauthor` = '$idauthor'");
          MessageForUser('success', 'Автор с номером <strong>'.$idauthor.'</strong> успешно удален!'); 
      }
  }
?>

<? 
  if ($_POST['changeauthor']) {
    $idauthor = trim(HtmlSpecialChars(strip_tags($_POST['idauthor'])));
    $nameauthor = trim(HtmlSpecialChars(strip_tags($_POST['nameauthor']))); 

    $query_change_author = $conn->query("UPDATE `author` SET `nameauthor` = '$nameauthor' WHERE `idauthor` = '$idauthor'");

    MessageForUser('success', 'Автор с номером <strong>'.$idauthor.'</strong> успешно изменен!');
  }
?>

<? 
  if ($_POST['addticket']) {
    $iduser = trim(HtmlSpecialChars(strip_tags($_POST['iduser']))); 
    $status = trim(HtmlSpecialChars(strip_tags($_POST['status']))); 
    
    $query_add_ticket = $conn->query("INSERT INTO `tickets` (`iduser`, `status`) VALUES ('$iduser', '$status')");
    
    MessageForUser('success', 'Новый заказ был успешно добавлен!');
  }
?>

<? 
  if ($_POST['changeticket']) {
    $idticket = trim(HtmlSpecialChars(strip_tags($_POST['idticket']))); 
    $iduser = trim(HtmlSpecialChars(strip_tags($_POST['iduser']))); 
    $status = trim(HtmlSpecialChars(strip_tags($_POST['status'])));  

    $query_change_author = $conn->query("UPDATE `tickets` SET `iduser` = '$iduser', `status` = '$status' WHERE `idticket` = '$idticket'");

    MessageForUser('success', 'Заказ с номером <strong>'.$idticket.'</strong> успешно изменен!');
  }
?>

<? 
  if ($_POST['delticket']) {
    $idticket = trim(HtmlSpecialChars(strip_tags($_POST['idticket'])));
    
    $query_del_ticket = $conn->query("SELECT * FROM `tickets` WHERE `idticket` = '$idticket'");

      if ($query_del_ticket->num_rows == 0) MessageForUser('danger', 'Такого заказа не существует или неправильно введен номер.');
      else {
          $query_del_ticket = $conn->query("DELETE FROM `tickets` WHERE `idticket` = '$idticket'");
          MessageForUser('success', 'Заказ с номером <strong>'.$idticket.'</strong> успешно удален!'); 
      }
  }
?>



<?
  if ($_POST['addticketlist']) {
    $idticket = trim(HtmlSpecialChars(strip_tags($_POST['idticket']))); 
    $idproduct = trim(HtmlSpecialChars(strip_tags($_POST['idproduct']))); 
    $status = trim(HtmlSpecialChars(strip_tags($_POST['status']))); 
    
    $query_add_ticketlist = $conn->query("INSERT INTO `ticketslist` (`idticket`, `idproduct`, `status`) VALUES ('$idticket', '$idproduct', '$status')");
    
    MessageForUser('success', 'Новый список заказов был успешно добавлен!');
  }
?>

<? 
  if ($_POST['changeticketlist']) {
    $idticketlist = trim(HtmlSpecialChars(strip_tags($_POST['idticketlist']))); 
    $idticket = trim(HtmlSpecialChars(strip_tags($_POST['idticket']))); 
    $idproduct = trim(HtmlSpecialChars(strip_tags($_POST['idproduct']))); 
    $status = trim(HtmlSpecialChars(strip_tags($_POST['status'])));  

    $query_change_ticketlist = $conn->query("UPDATE `ticketslist` SET `idticket` = '$idticket', `idproduct` = '$idproduct', `status` = '$status' WHERE `idticketlist` = '$idticketlist'");

    MessageForUser('success', 'Лист заказа с номером <strong>'.$idticketlist.'</strong> успешно изменен!');
  }
?>

<? 
  if ($_POST['delticketlist']) {
    $idticketlist = trim(HtmlSpecialChars(strip_tags($_POST['idticketlist'])));
    
    $query_del_ticketlist = $conn->query("SELECT * FROM `ticketslist` WHERE `idticketlist` = '$idticketlist'");

      if ($query_del_ticketlist->num_rows == 0) MessageForUser('danger', 'Такого листа заказа не существует или неправильно введен номер.');
      else {
          $query_del_ticketlist = $conn->query("DELETE FROM `ticketslist` WHERE `idticketlist` = '$idticketlist'");
          MessageForUser('success', 'Лист заказа с номером <strong>'.$idticketlist.'</strong> успешно удален!'); 
      }
  }
?>



<!DOCTYPE html>
<html>
<head>
  <title>Админ панель</title>
  <link rel="stylesheet" type="text/css" href="/css/adminpanel.css">
  <link rel="stylesheet" href="/bootstrap/css/bootstrap.css">
  <script src="/bootstrap/js/bootstrap.js"></script>
</head>

<body>
  <main> 

    <? if (!isset($_SESSION['admin']['login'])):?>
    <form action="" method="POST" class="position-absolute start-50 top-50 translate-middle">
      <h5 class="text-center">Войдите</h5>
      <input type="text" name="login" placeholder="Введите логин" required="true">
      <input type="password" name="password" placeholder="Введите пароль" required="true"> 
      <input type="submit" class="btn btn-success"  name="adminlog" required="true" >
    </form>

    <? else: ?>
      <div class="main row">
        <div class="main__info col">
          <? $query_tables = $conn->query("SHOW TABLES FROM `heroku_93c2aefea11c45b`"); ?>
            <div class="info__tables">В базе данных heroku_93c2aefea11c45b - <?= mysqli_num_rows($query_tables);?> таблиц</div>
          <? while ($row = $query_tables->fetch_array()) : ?>
            Таблица: <a href='?id_table=<?=$row[0]?>'><?=$row[0]?></a><br>
          <? endwhile; ?>
          <? if (isset($_GET['id_table'])) : $query_info_table = $conn->query("SELECT * FROM ".$_GET['id_table'].""); ?>
            <table border="1" class="table-info">
              <thead>
                <?if ($_GET['id_table'] == 'author'):?>
                  <th>idauthor</th>
                  <th>nameauthor</th>
                <?elseif ($_GET['id_table'] == 'productcategory') :?>
                  <th>idcategory</th>
                  <th>namecategory</th>
                <?elseif ($_GET['id_table'] == 'products') :?>
                  <th>idproduct</th>
                  <th>title</th>
                  <th>author</th>
                  <th>description</th>
                  <th>category</th>
                  <th>price</th>
                  <th>image</th>
                  <th>rating</th>
                <?elseif ($_GET['id_table'] == 'users') :?>
                  <th>iduser</th>
                  <th>login</th>
                  <th>email</th>
                  <th>password</th>
                  <th>role</th>
                  <th>createdate</th>
                <?elseif ($_GET['id_table'] == 'tickets') :?>
                  <th>idticket</th>
                  <th>iduser</th>
                  <th>status</th>
                  <th>createdate</th>
                <?elseif ($_GET['id_table'] == 'ticketslist') :?>
                  <th>idticketlist</th>
                  <th>idticket</th>
                  <th>idproduct</th>
                  <th>status</th>
                <?endif;?>
              </thead>
              <tbody>
                <? while($row = $query_info_table->fetch_assoc()) :?>
                    <tr>
                  <? foreach($row as $val) :?>
                      <td> <?=$val?> </td> 
                  <? endforeach;?>
                    </tr>

                <?endwhile;?>
              </tbody>
            </table>
          <?endif;?>
        </div>
        <div class="main__buttons col"> 
          <div class="buttons">
            <div class="buttons__book">
              <p>
                <a class="btn btn-success" data-bs-toggle="collapse" href="#multiCollapseExample11" role="button" aria-expanded="false" aria-controls="multiCollapseExample11">Добавить новую книгу</a>
                <a class="btn btn-success" type="button" data-bs-toggle="collapse" data-bs-target="#multiCollapseExample12" aria-expanded="false" aria-controls="multiCollapseExample12">Удалить книгу</a>
                <a class="btn btn-success" type="button" data-bs-toggle="collapse" data-bs-target="#multiCollapseExample13" aria-expanded="false" aria-controls="multiCollapseExample13">Изменить книгу</a>
              </p>
            </div>
            <div class="buttons__category">
              <p>
                <a class="btn btn-success" data-bs-toggle="collapse" href="#multiCollapseExample21" role="button" aria-expanded="false" aria-controls="multiCollapseExample21">Добавить новую категорию</a>
                <a class="btn btn-success" type="button" data-bs-toggle="collapse" data-bs-target="#multiCollapseExample22" aria-expanded="false" aria-controls="multiCollapseExample22">Удалить категорию</a> 
                <a class="btn btn-success" type="button" data-bs-toggle="collapse" data-bs-target="#multiCollapseExample23" aria-expanded="false" aria-controls="multiCollapseExample23">Изменить категорию</a>
              </p>
            </div>
            <div class="buttons__author">
              <p>
                <a class="btn btn-success" data-bs-toggle="collapse" href="#multiCollapseExample31" role="button" aria-expanded="false" aria-controls="multiCollapseExample31">Добавить нового автора</a>
                <a class="btn btn-success" type="button" data-bs-toggle="collapse" data-bs-target="#multiCollapseExample32" aria-expanded="false" aria-controls="multiCollapseExample32">Удалить автора</a> 
                <a class="btn btn-success" type="button" data-bs-toggle="collapse" data-bs-target="#multiCollapseExample33" aria-expanded="false" aria-controls="multiCollapseExample33">Изменить автора</a>
              </p>
            </div>
            <div class="buttons__tickets">
              <p>
                <a class="btn btn-success" data-bs-toggle="collapse" href="#multiCollapseExample41" role="button" aria-expanded="false" aria-controls="multiCollapseExample41">Создать заказ</a>
                <a class="btn btn-success" type="button" data-bs-toggle="collapse" data-bs-target="#multiCollapseExample42" aria-expanded="false" aria-controls="multiCollapseExample42">Изменить статус заказа</a>
                <?if ($_SESSION['admin']['role'] == 'admin'):?>
                  <a class="btn btn-success" type="button" data-bs-toggle="collapse" data-bs-target="#multiCollapseExample43" aria-expanded="false" aria-controls="multiCollapseExample43">Удалить заказ</a>
                <?else :?>
                  <a class="btn btn-danger disabled" type="button" data-bs-toggle="collapse" data-bs-target="#multiCollapseExample43" aria-expanded="false" aria-controls="multiCollapseExample43" >Удалить заказ</a>
                <?endif;?>
              </p>
            </div>
            <div class="buttons__ticketlist">
              <p>
                <a class="btn btn-success" data-bs-toggle="collapse" href="#multiCollapseExample51" role="button" aria-expanded="false" aria-controls="multiCollapseExample51">Создать список заказа</a>
                <a class="btn btn-success" type="button" data-bs-toggle="collapse" data-bs-target="#multiCollapseExample52" aria-expanded="false" aria-controls="multiCollapseExample52">Изменить список заказа</a> 
                <?if ($_SESSION['admin']['role'] == 'admin'):?>
                  <a class="btn btn-success" type="button" data-bs-toggle="collapse" data-bs-target="#multiCollapseExample53" aria-expanded="false" aria-controls="multiCollapseExample53">Удалить список заказа</a>
                <?else :?>
                  <a class="btn btn-danger disabled" type="button" data-bs-toggle="collapse" data-bs-target="#multiCollapseExample53" aria-expanded="false" aria-controls="multiCollapseExample53">Удалить список заказа</a>
                <?endif;?>
              </p>
            </div>
            <div class="buttons__statistics">
              <p>
                <a class="btn btn-primary" data-bs-toggle="collapse" href="#multiCollapseExample61" role="button" aria-expanded="false" aria-controls="multiCollapseExample61">Статистика</a>
              </p>
            </div>
          </div>
            <div class="row-book row">
            <div class="col">
              <div class="collapse multi-collapse" id="multiCollapseExample11">
                <div class="card card-body">
                  <form method="POST" enctype="multipart/form-data">

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
                    <input type="number" class="input-group mb-3" name="price" placeholder="Введите цену книги">
                    <input type="file" class="input-group mb-5" name="file">
                    <input type="submit" class="btn btn-success input-group " name="addbook">

                  </form>
                </div>
              </div>
            </div>

            <div class="col">
              <div class="collapse multi-collapse" id="multiCollapseExample12">
                <div class="card card-body">
                  <form action="" method="POST">
                      <input class="input-group mb-3" type="number" placeholder="Введите номер книги" name="idbook" required="true">
                      <input class="btn btn-success" type="submit" name="delbook">
                  </form>
                </div>
              </div>
            </div>

            <div class="col">
              <div class="collapse multi-collapse" id="multiCollapseExample13">
                <div class="card card-body">
                  <form action="" method="POST">

                    <input type="number" name="idbook" class="input-group mb-3" placeholder="Введите номер книги"> 
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
                    <input type="number" class="input-group mb-3" name="price" placeholder="Введите цену книги">
                    <input type="submit" class="btn btn-success input-group" name="changebook">

                </form>
                </div>
              </div>
            </div>

            <div class="row-category row">
                <div class="col">
                  <div class="collapse multi-collapse" id="multiCollapseExample21">
                    <div class="card card-body">
                      <form action="" method="POST">
                        <input type="text" class="input-group mb-3" name="namecategory" placeholder="Введите наименование категории">
                        <input type="submit" class="btn btn-success input-group" name="addcategory">
                      </form>
                    </div>
                  </div>
                </div>
                <div class="col">
                  <div class="collapse multi-collapse" id="multiCollapseExample22">
                    <div class="card card-body">
                      <form action="" method="POST">
                        <input type="number" class="input-group mb-3" name="idcategory" placeholder="Введите номер категории">
                        <input type="submit" class="btn btn-success input-group" name="delcategory">
                      </form>
                    </div>
                  </div>
                </div>
                <div class="col">
                  <div class="collapse multi-collapse" id="multiCollapseExample23">
                    <div class="card card-body">
                      <form action="" method="POST">
                        <input type="number" class="input-group mb-3" name="idcategory" placeholder="Введите номер категории">
                        <input type="text"  class="input-group mb-3" name="namecategory" placeholder="Введите наименование категории">
                        <input type="submit" class="btn btn-success input-group" name="changecategory">
                      </form>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row-author row">
                <div class="col">
                  <div class="collapse multi-collapse" id="multiCollapseExample31">
                    <div class="card card-body">
                      <form action="" method="POST">
                        <input type="text" class="input-group mb-3" name="nameauthor" placeholder="Введите имя автора">
                        <input type="submit" class="btn btn-success input-group" name="addauthor">
                      </form>
                    </div>
                  </div>
                </div>
                <div class="col">
                  <div class="collapse multi-collapse" id="multiCollapseExample32">
                    <div class="card card-body">
                      <form action="" method="POST">
                        <input type="number" class="input-group mb-3" name="idauthor" placeholder="Введите номер автора">
                        <input type="submit" class="btn btn-success input-group" name="delauthor">
                      </form>
                    </div>
                  </div>
                </div>
                <div class="col">
                  <div class="collapse multi-collapse" id="multiCollapseExample33">
                    <div class="card card-body">
                      <form action="" method="POST">
                        <input type="number" class="input-group mb-3" name="idauthor" placeholder="Введите номер автора">
                        <input type="text"  class="input-group mb-3" name="nameauthor" placeholder="Введите имя автора">
                        <input type="submit" class="btn btn-success input-group" name="changeauthor">
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row-tickets row">
                <div class="col">
                  <div class="collapse multi-collapse" id="multiCollapseExample41">
                    <div class="card card-body">
                        <form action="" method="POST">
                          <select name="iduser" class="input-group mb-3">
                            <?$query_users = $conn->query("SELECT * FROM `users`");
                            while ($row = $query_users->fetch_assoc()) :?>
                              <option value="<?= $row['iduser']?>">
                                <?= $row['login']?>    
                              </option>
                            <?endwhile;?>
                          </select>
                          <?TicketStatus();?>
                          <input type="submit" class="btn btn-success input-group" name="addticket">
                      </form>
                    </div>
                  </div>
                </div>
                <div class="col">
                  <div class="collapse multi-collapse" id="multiCollapseExample42">
                    <div class="card card-body">
                      <form action="" method="POST">
                        <input type="number" class="input-group mb-3" name="idticket" placeholder="Введите номер заказа">
                        <select name="iduser" class="input-group mb-3">
                          <?$query_users = $conn->query("SELECT * FROM users");
                          while ($row = $query_users->fetch_assoc()) :?>
                            <option value="<?= $row['iduser']?>">
                              <?= $row['login']?>    
                            </option>
                          <?endwhile;?>
                        </select>
                        <?TicketStatus();?>
                        <input type="submit" class="btn btn-success input-group" name="changeticket">
                      </form>
                    </div>
                  </div>
                </div>
                <?if ($_SESSION['admin']['role'] == 'admin'):?>
                  <div class="col">
                    <div class="collapse multi-collapse" id="multiCollapseExample43">
                      <div class="card card-body">
                        <form action="" method="POST">
                          <input type="number" class="input-group mb-3" name="idticket" placeholder="Введите номер заказа">
                          <input type="submit" class="btn btn-success input-group" name="delticket">
                        </form>
                      </div>
                    </div>
                  </div>
                <?endif;?>
              </div>
              <div class="row-ticketslist row">
                <div class="col">
                  <div class="collapse multi-collapse" id="multiCollapseExample51">
                    <div class="card card-body">
                      <form action="" method="POST">
                          <select name="idticket" class="input-group mb-3">
                            <?$query_tickets = $conn->query("SELECT * FROM `tickets`");
                            while ($row = $query_tickets->fetch_assoc()) :?>
                              <option value="<?= $row['idticket']?>">
                                <?= $row['idticket']?>    
                              </option>
                            <?endwhile;?>
                          </select>
                          <select name="idproduct" class="input-group mb-3">
                            <?$query_products = $conn->query("SELECT * FROM `products`");
                            while ($row = $query_products->fetch_assoc()) :?>
                              <option value="<?= $row['idproduct']?>">
                                <?= $row['title']?>    
                              </option>
                            <?endwhile;?>
                          </select>
                          <?TicketStatus();?>
                          <input type="submit" class="btn btn-success input-group" name="addticketlist">
                      </form>
                    </div>
                  </div>
                </div>
                <div class="col">
                  <div class="collapse multi-collapse" id="multiCollapseExample52">
                    <div class="card card-body">
                      <form action="" method="POST">
                          <input type="number" class="input-group mb-3" name="idticketlist" placeholder="Введите номер листа заказа">
                          <select name="idticket" class="input-group mb-3">
                            <?$query_tickets = $conn->query("SELECT * FROM `tickets`");
                            while ($row = $query_tickets->fetch_assoc()) :?>
                              <option value="<?= $row['idticket']?>">
                                <?= $row['idticket']?>    
                              </option>
                            <?endwhile;?>
                          </select>
                          <select name="idproduct" class="input-group mb-3">
                            <?$query_products = $conn->query("SELECT * FROM `products`");
                            while ($row = $query_products->fetch_assoc()) :?>
                              <option value="<?= $row['idproduct']?>">
                                <?= $row['title']?>    
                              </option>
                            <?endwhile;?>
                          </select>
                          <?TicketStatus();?>
                          <input type="submit" class="btn btn-success input-group" name="changeticketlist">
                      </form>
                    </div>
                  </div>
                </div>
                <?if ($_SESSION['admin']['role'] == 'admin'):?>
                  <div class="col">
                    <div class="collapse multi-collapse" id="multiCollapseExample53">
                      <div class="card card-body">
                        <form action="" method="POST">
                          <input type="number" class="input-group mb-3" name="idticketlist" placeholder="Введите номер листа заказа">
                          <input type="submit" class="btn btn-success input-group" name="delticketlist">
                        </form>
                      </div>
                    </div>
                  </div>
                <?endif;?>
              </div>
              <div class="row-statistics row">
                <div class="col">
                  <div class="collapse multi-collapse" id="multiCollapseExample61">
                  <?echo date( "Сегодня d.m.y. Время: H:i" );?>
                    <div class="card card-body">
                      <?
                        $query_today_tickets = $conn->query("SELECT * FROM tickets WHERE DAY(createdate) = DAY(NOW())");
                        $ticketSuccess = 0; $ticketWork = 0; $ticketProcessing = 0;
                        
                        if ($query_today_tickets->num_rows == 0): ?> 
                          <div class="info-tickets">
                            Заказов на сегодня нет.
                          </div>
                        <? else : ?>
                          <div class="info-tickets">
                            <div class="tickets-count">Заказов произведено на сегодня - <strong><?= $query_today_tickets->num_rows?></strong>, из которых:</div>
                              <div class="tickets-status">
                                <?while($counter = $query_today_tickets->fetch_array()) {
                                  if ($counter['status'] == 'Выполнен') $ticketSuccess++;
                                  elseif ($counter['status'] == 'В работе') $ticketWork++;
                                  elseif ($counter['status'] == 'Не подтвержден') $ticketProcessing++;
                                } ?>
                                <strong><?= $ticketSuccess?></strong> выполнено; <br>
                                <strong><?= $ticketWork?></strong> в работе; <br>
                                <strong><?= $ticketProcessing?></strong> не подтверждены; <br>
                              </div>
                          </div>
                        <?endif;?>
                        <?$query_new_users = $conn->query("SELECT * FROM users WHERE TO_DAYS(NOW()) - TO_DAYS(createdate) <= 30;");
                        $roleUser = 0; $roleAdmin = 0; $roleModerator = 0;
                        if ($query_new_users->num_rows == 0): ?>
                          <div class="info-users">
                            Новых пользователей за прошедшей месяц нет.
                          </div>
                        <?else :?>
                          <div class="info-users">
                            <div class="users-count"> Новых пользователей за прошедший месяц - <strong><?= $query_new_users->num_rows?></strong>, из которых:</div>
                              <div class="tickets-role">
                                <?while($counter = $query_new_users->fetch_array()) {
                                  if ($counter['role'] == 'user') $roleUser++;
                                  elseif ($counter['role'] == 'admin') $roleAdmin++;
                                  elseif ($counter['role'] == 'moderator') $roleModerator++;
                                } ?>
                                <strong><?= $roleUser?></strong> пользователей; <br>
                                <strong><?= $roleAdmin?></strong> администраторов; <br>
                                <strong><?= $roleModerator?></strong> модераторов; <br>
                              </div>
                          </div>
                        <?endif;?>
                    </div>
                  </div>
                </div>
              </div>
          </div>
      </div>            
  <?endif;?>
</main> 
</body>
</html>