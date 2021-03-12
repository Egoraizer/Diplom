<?php 

  function can_upload_image($file) {

    if($file['name'] == '')
		return 'Ошибка! Вы не выбрали файл.';
	
	elseif ($file['size'] == 0)
		return 'Ошибка! Файл слишком большой.';

	$getMime = explode('.', $file['name']);
	$mime = strtolower(end($getMime));
	$types = array('jpg', 'png', 'gif', 'bmp', 'jpeg', 'webp');
	
	if(!in_array($mime, $types))
		return 'Ошибка! Недопустимый тип файла.';
	return true;
  }
  
  function make_upload_new_book($file, $conn, $title, $idauthor, $description, $idcategory, $price) {	

	$fullpath =  '../productimg/' . mt_rand(0, 10000) . $file['name'];
    echo $fullpath;
    $query_upload_img = $conn->query("INSERT INTO `products` (`title`, `author`,`description`, `category`, `price`, `image`) VALUES ('$title', '$idauthor','$description', '$idcategory', '$price', '$fullpath')");
	copy($file['tmp_name'], $fullpath); 	
	
  }