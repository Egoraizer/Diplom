<?php 

  function can_upload($file) {

    if($file['name'] == '')
		return 'Вы не выбрали файл.';
	
	elseif ($file['size'] == 0)
		return 'Файл слишком большой.';

	$getMime = explode('.', $file['name']);
	$mime = strtolower(end($getMime));
	$types = array('jpg', 'png', 'gif', 'bmp', 'jpeg');
	
	if(!in_array($mime, $types))
		return 'Недопустимый тип файла.';

	return true;
  }
  
  function make_upload($file, $conn) {	

	$name = mt_rand(0, 10000) . $file['name'];
    $fullpath = 'productimg/' . $name;
    echo $fullpath;
    $query_upload_img = $conn->query("INSERT INTO `products` (`title`, `description`, `category`, `price`, `image`) VALUES ('2', '3', '4', '5', '$fullpath')");
	copy($file['tmp_name'], '../productimg/' . $name); 
  }