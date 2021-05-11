<?php 

  function can_upload_image($file) {

    if ($file['name'] == '') MessageForUser('danger', 'Вы не выбрали файл.'); 
	elseif  ($file['size'] == 0) MessageForUser('danger', 'Файл слишком большой.'); 
	else {
		$getMime = explode('.', $file['name']);
		$mime = strtolower(end($getMime));
		$types = array('jpg', 'png', 'gif', 'bmp', 'jpeg', 'webp');
		if(!in_array($mime, $types)) MessageForUser('danger','Недопустимый тип файла.'); 
		else return true;
	}	
  }
  
  function make_upload_new_book($file, $conn, $title, $idauthor, $description, $idcategory, $price) {	

	$fullpath =  '../productimg/' . mt_rand(0, 10000) . $file['name'];
    $query_upload_img = $conn->query("INSERT INTO `products` (`title`, `author`,`description`, `category`, `price`, `image`) VALUES ('$title', '$idauthor','$description', '$idcategory', '$price', '$fullpath')");
	copy($file['tmp_name'], $fullpath);
	MessageForUser('success', 'Файл загружен на сервер. Путь картинки: '.$fullpath); 	
	
  }

  function MessageForUser ($status, $text) { ?>
  	<? if ($status == 'success') :?>
		<div class="alert alert-success alert-dismissible fade show" role="alert">
			<strong>Успешно!</strong> 
	<? elseif ($status == 'warning') :?>
		<div class="alert alert-warning alert-dismissible fade show" role="alert">
			<strong>Внимание!</strong> 
	<?else :?>
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
			<strong>Ошибка!</strong> 
	<?endif;?>
			<?=$text?>
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	</div>
<? }

function TicketStatus () { ?>
	<select name="status" class="input-group mb-3">
		<option value="Не подтвержден">Не подтвержден</option>
		<option value="В работе">В работе</option>
		<option value="Выполнен">Выполнен</option>
	</select>
<? }