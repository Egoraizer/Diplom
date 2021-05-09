<?php session_start(); ob_start(); require_once './src/db.php'; require_once './src/functions.php'; connect_to_db(); 
	if (!isset($_SESSION['user']['login'])) header('Location: index.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <title>Личный кабинет</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="/css/lk.css">
  
</head> 
<body>
    <? require_once './src/header.php';?>
        <div class="main">
            <div class="ticket-status">
                <ul class="nav justify-content-center mt-3 mb-5">
                    <li class="nav-item">
                        <a class="nav-link link-success" href="lk.php?status=successticket">Выполненные заказы</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link-warning" href="lk.php?status=waitingticket">Ожидающиеся заказы</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link-danger" href="lk.php?status=cancelticket">Отмененные заказы</a>
                    </li>
                </ul>
            </div>
            <div class="info-ticket">
                <?if ($_GET['ticket']) :
                    $ticket = $_GET['ticket'];
                    $query_check_ticket = $conn->query("SELECT * FROM tickets INNER JOIN users ON tickets.iduser = users.iduser WHERE users.login = '{$_SESSION['user']['login']}' AND tickets.idticket = '$ticket'");
                    if ($query_check_ticket->num_rows == 0):
                        MessageForUser('warning', 'Неверный номер заказа. Пожалуйста, вернитесь на главную.');
                    else : 
                        $query_checked_ticket = $conn->query("SELECT * FROM `ticketslist` INNER JOIN products ON products.idproduct = ticketslist.idproduct WHERE ticketslist.idticket = '$ticket'");
                        if ($query_checked_ticket->num_rows == 0) :
                            MessageForUser('warning', 'Заказ формируется. Пожалуйста, зайдите позднее.');
                        else : ?>
                            <div class="h4 text-center"> Заказ №  <?=$ticket?></div>
                            <div class="table-ticket">
                                <table class="table table-ticket">
                                    <thead>
                                        <tr>
                                            <th>Обложка</th>
                                            <th>Наименование</th>
                                            <th>Статус</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <? while($row = $query_checked_ticket->fetch_array()) : ?>
                                        <tr>
                                            <td><img src="<?=$row['image']?>" alt="" height="200px"></td>
                                            <td><?=$row['title']?> </td>
                                            <td><?=$row['status']?></td>
                                        </tr>
                                        
                                    <?endwhile;?>
                                    </tbody>
                                </table>
                            </div>
                        <?endif;?>
        
                    <?endif;?>
                <?endif;?>
                <?if ($_GET['status'] == 'successticket') $textquery = 'Выполнен';
                elseif ($_GET['status'] == 'waitingticket') $textquery = 'Не подтвержден';
                elseif ($_GET['status'] == 'cancelticket') $textquery = 'Отклонен'; ?>

                <?$query_status_ticket = $conn->query("SELECT * FROM tickets INNER JOIN users ON tickets.iduser = users.iduser WHERE users.login = '{$_SESSION['user']['login']}' AND tickets.status = '$textquery'");
                if ($query_status_ticket->num_rows == 0 && $_GET['status']) :
                    MessageForUser('warning', 'В данной категории нет заказов.');
                else :?>
                    <div class="text-center justify-content-center mt-3 mb-2"> 
                    <?while($row = $query_status_ticket->fetch_array()) :?>
                        
                            <form action="" method="GET">
                            <?if ($row['status'] == 'Отклонен') :?>
                                <button class="ticket-check text-center text-center btn btn-danger" type="submit" name="ticket" value="<?= $row['idticket']?>" disabled>Заказ №<?=$row['idticket']?> находится в статусе: <?=$row['status']?></button>
                            <?elseif ($row['status'] == 'Не подтвержден') :?>
                                <button class="ticket-check text-center btn btn-warning" type="submit" name="ticket" value="<?= $row['idticket']?>">Заказ №<?=$row['idticket']?></button> <br>
                            <?elseif ($row['status'] == 'Выполнен') :?>
                                <button class="ticket-check text-center btn btn-success" type="submit" name="ticket" value="<?= $row['idticket']?>">Заказ №<?=$row['idticket']?></button> <br>
                            <?endif;?>
                            </form> 
                        
                    <?endwhile;?>
                    </div>
                <?endif;?>
            </div>
        </div>
        
</body>
<script>

</script>
</html>

<? ##$query_waiting_tickets = $conn->query("SELECT tickets.idticket, users.iduser, tickets.status, users.email FROM `tickets` INNER JOIN `users` ON users.iduser = tickets.iduser WHERE users.login = '{$_SESSION['user']['login']}' AND tickets.status = 'Не подтвержден'");?>
            <? ##$query_waiting_tickets_items = $conn->query("SELECT tickets.idticket, users.login, users.email, ticketslist.idproduct, ticketslist.status AS ticketsliststatus, products.title, products.image FROM `tickets` INNER JOIN `users` ON users.iduser = tickets.iduser INNER JOIN `ticketslist` ON ticketslist.idticket = tickets.idticket INNER JOIN `products` ON products.idproduct = ticketslist.idproduct WHERE users.login = '{$_SESSION['user']['login']}' AND ticketslist.status = 'Не подтвержден'");?>
            <? ##while ($row = $query_waiting_tickets_items->fetch_array()): $currentidticket = $row['idticket']?>
            <?##endwhile;?>