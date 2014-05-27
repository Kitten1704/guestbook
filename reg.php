<html>
	<head>
		<meta http-equiv="Content-Tipe" content="text/html; charset=utf-8">
		<link rel="shortcut icon" href="img/main_ico.png" type="image/x-icon"><!--Иконка для странички-->
		<title>Регистрация</title><!--заголовок страницы-->
		<link rel="stylesheet" type="text/css" href="guestbook_style.css" ><!--Подключаем css-->
	</head>
	<body>
		<div class="container">
			<div class="title">
			<div class="title_links"><a href="login.php">Вход</a>&nbsp;|&nbsp;<a href="index.php">На главную</a></div>
			</div>
		<div class="message_form_center">
		<!--Форма регистрации пользователей
		через GET получаем текст, ввденный в поля, если заполнены не все обязательные /Имя, mail, пароль, подтверждение пароля/
		*_error - текст предупреждений, если не все поля заполнены-->
		<form  method="post" action="reg_add.php">
		<h3>Регистрация</h3>
		<p>Имя: * <input class="text_color" type="text" name="name" value="<? echo $_GET['name'];?>">&nbsp;
		Фамилия:<input class="text_color" type="text" name="sname" size="24" value="<? echo $_GET['sname'];?>"></p>
		<h4><? echo $_GET['name_error'];?></h4>
		<p>E-mail:*<input class="text_color" type="text" name="email" size="63" value="<? echo $_GET['email'];?>"></p>
		<h4><?echo $_GET['email_error'];?></h4>
		<p>Пароль:*<input class="text_color" type="password" name="password" size="61" value="<? echo $_GET['password'];?>"></p>
		<h4><?echo $_GET['password_error'];?></h4>
		<h4><?echo $_GET['re_error'];?></h4>
		<p>Подтвердите пароль:*<input class="text_color" type="password" name="re_password" size="44" value="<? echo $_GET['re_password'];?>"></p>
		<h4><?echo $_GET['re_password_error'];?></h4>
		<h4><?echo $_GET['re_error'];?></h4>
		<input class="message_form_button" name="message_form_button" type="submit" value="Зарегистрироваться">
		<p>*: Звездочкой помечены поля, обязательные для заполнения.</p>
		</form>
		</div>
		</div>
	</body>
	</html>