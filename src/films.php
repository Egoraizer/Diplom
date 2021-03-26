<?php require 'admin/function.php'; connect()?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width-device-width, initial-scale=1.0">
	<title>Фильмы</title>
	<link rel="stylesheet" href="style1.css">
	<link rel="stylesheet" href="block.css">
	<link rel="stylesheet" href="modal.css">
</head>
<body>

	<div class="main">
		
		<div class="header">
			<div class="logo">
				<div class="logo_text">
					<h1><a href="index.html">PortalCinema</a></h1>
					<h2>Кино - наше все!</h2>
				</div>
			</div>
			
			<div class="menubar">
				
				<ul class="menu">
					<li><a href="index.html">Главная</a></li>	
					<li class="selected"><a href="films.php">Фильмы</a></li>
					<li><a href="rating.html">Рейтинг</a></li>
					<li><a href="contact.html">Контакты</a></li>
					<li><a href="test.php">Контакты</a></li>
				</ul>

			</div>

		</div>
			<div class="catalog">
				<div id="catalog_content">
				
				<div class="toggle-btn" onclick="openMenu()">
					<span></span>
					<span></span>
					<span></span>
				</div>

				<ul>
					<li><a href="#" data-filter="all">Все</a><br></li>
					<li><h4>По жанрам:</h4></li>
					<li><a href="#" data-filter="Боевик">Боевик</a><br></li>
					<li><a href="#" data-filter="Детектив">Детектив</a><br></li>
					<li><a href="#" data-filter="Драма">Драма</a><br></li>
					<li><a href="#" data-filter="Комедия">Комедия</a><br></li>
					<li><a href="#" data-filter="Приключения">Приключения</a><br></li>
					<li><a href="#" data-filter="Семейный">Семейный</a><br></li>
					<li><a href="#" data-filter="Триллер">Триллер</a><br></li>
					<li><a href="#" data-filter="Ужасы">Ужасы</a><br></li>
					<li><a href="#" data-filter="Фантастика">Фантастика</a><br></li>
					<li><a href="#" data-filter="Фэнтези">Фэнтези</a><br></li>

					<li><h4>По году:</h4></li>
					<li><a href="#" data-filter-year="2021">2021</a><br></li>
					<li><a href="#" data-filter-year="2020">2020</a><br></li>
					<li><a href="#" data-filter-year="2019">2019</a><br></li>
					<li><a href="#" data-filter-year="2018">2018</a><br></li>
				</ul>

				</div>
			</div>


			

			
		<div class="site_content_films">
			
			<div class="sidebar_container">

				<div class="sidebar">
					<h2>Поиск</h2>
					<form method="post" action="#" id="search_form" >
						<input type="search" name="search_field" placeholder="Поиск" />
						<input type="submit" class="search" value="Найти" />
					</form>
				</div>

				<div class="modal" id="modal">
					<div class="login_wrap">
						<div class="login_tab">

							<input id="tab-1" type="radio" name="tab" class="sign_in" checked>
								<label for="tab-1" class="tab"><b>Регистрация</b></label>
							<input id="tab-2" type="radio" name="tab" class="sign_up">
								<label for="tab-2" class="tab"><b>Авторизация</b></label>

							<div class="login_form">
								<div class="sign-up_tab">
									<form method="post" action="doreg.php">
										<div class="group">
											<label class="label">Логин</label>
											<input type="text" id="text" name="login" class="input" placeholder="Ваш логин" required="true">
										</div>
										<div class="group">
											<label class="label">Email адрес</label>
											<input type="text" id="text" name="email" class="input" placeholder="Ваш E-mail" required="true">
										</div>
										<div class="group">
											<label class="label">Пароль</label>
											<input type="password" id="password" name="pass" class="input" required="true">
										</div>
										<div class="group">
											<label class="label">Повторите пароль</label>
											<input type="password" id="passwordp" name="passp" class="input" required="true">
										</div>
										<div class="group">
											<input type="submit" class="button" name="go_reg" value="Зарегистрироваться">
										</div>
									</form>
								</div>

								<div class="sign-in_tab">
									<form method="post" action="enter.php" id="login">
										<div class="group">
											<label class="label">Логин</label>
											<input type="text" name="login" class="input" placeholder="Логин">
										</div>
										<div class="group">
											<label class="label">Пароль</label>
											<input type="password" name="pass" class="input" placeholder="Пароль">
										</div>
										<div class="group">
											<input type="submit" class="button" name="go_enter" value="Войти">
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div> <!-- Modal window -->

				<div class="sidebar">
					<h2>Авторизация</h2>
					<form method="post" action="enter.php" id="login">
						<input type="text" name="login" placeholder="Логин" />
						<input type="password" name="pass" placeholder="Пароль" />
						<input type="submit" class="btn" name="go_enter" value="Войти" />
						<div class="lables_passreg_text">
							<span><a href="#">забыли пароль?</a></span> | 
							<span><a href="#" data-modal="#modal">регистрация</a></span>
						</div>

					</form>
				</div> 

				<div class="sidebar">
					<h2>Рейтинг фильмов</h2>
					<ul>
						<li><a href="#">Интерстеллар</a><span class="rating_sidebar">8.6</span></li>
						<li><a href="#">Матрица</a><span class="rating_sidebar">8.7</span></li>
						<li><a href="#">Безумный макс</a><span class="rating_sidebar">7.5</span></li>
						<li><a href="#">Аватар</a><span class="rating_sidebar">7.9</span></li>
						<li><a href="#">Веном</a><span class="rating_sidebar">6.7</span></li>
						<li><a href="#">Аквамен</a><span class="rating_sidebar">6.8</span></li>
					</ul>
				</div>
			</div>

			<div class="content_films">
				<!-- Вызов функции из файла main.js -->
				<div class="films_out"></div>
						

				<!-- <div class="more">
					<a href="#" id="loadMore">Показать ещё</a>
				</div> -->
			</div>
		</div>


		<div class="footer">
			<p>
				<a href="index.html">Главная</a> |
				<a href="films.php">Фильмы</a> | 
				<a href="rating.html">Рейтинг</a> |
				<a href="contact.html">Контакты</a>
			</p>
			<p>portalcinema.com 2019</p>
		</div>

	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="js/jquery.js"></script>
	<script src="js/main.js"></script>
	<script src="js/filter.js"></script>
	<script src="js/modal.js"></script>
	<script type="text/javascript" src=" https://code.jquery.com/jquery-1.11.2.js "></script>
	<script type="text/javascript">
			
		function openMenu() {
			document.getElementById("catalog_content").classList.toggle('active');
	}
	</script>
</body>
</html>