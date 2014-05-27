<?php
session_start();
//unset($_FILES);
include_once("dbcon.php");
//echo $_SESSION['uID'];
if (isset($_SESSION['uID']))
	{
		$sql_select_users = mysql_query ("SELECT * FROM users WHERE uID = '{$_SESSION['uID']}'", $db);
		$arr = mysql_fetch_array ($sql_select_users);
				//echo $strSQL;
		
	}
?>
<html>
<head>
		<meta http-equiv="Content-Tipe" content="text/html; charset=utf-8">
		<link rel="shortcut icon" href="img/main_ico.png" type="image/x-icon"><!--Иконка для странички-->
		<title>Профиль пользователя</title><!--заголовок страницы-->
		<link rel="stylesheet" type="text/css" href="guestbook_style.css" ><!--Подключаем css-->
	</head>
	<body>
		<div class="container">
			<div class="title">
			<div class="title_links"><a href="index.php">На главную</a>&nbsp;|&nbsp;<a href="logout.php">Выход</a></div>
			</div>
		<div class="message_form_center">
		<!--Форма редактирования данных зарегистрированных пользователей
		через GET получаем текст, ввденный в поля, если заполнены не все обязательные /Имя, mail, пароль, подтверждение пароля/
		*_error - текст предупреждений, если не все поля заполнены-->
		<form  method="post" action="prof_upd.php" enctype="multipart/form-data">
		<h3>Редактировать профиль</h3>
		<p>Имя: * <input class="text_color" type="text" name="name" value="<? echo $arr['uname'];?>">&nbsp;
		Фамилия:<input class="text_color" type="text" name="sname" size="24" value="<? echo $arr['usname'];?>"></p>
		<h4><? echo $_GET['name_error'];?></h4>
		<p>E-mail:*<input class="text_color" type="text" name="email" size="63" value="<? echo $arr['uemail'];?>"></p>
		<h4><?echo $_GET['email_error'];?></h4>
		<p>Пароль:*<input class="text_color" type="password" name="password" size="61" value="<? echo $arr['upassword']; ?>"></p>
		<h4><?echo $_GET['password_error'];?></h4>
		<h4><?echo $_GET['re_error'];?></h4>
		<p>Подтвердите пароль:*<input class="text_color" type="password" name="re_password" size="44" value="<? echo $arr['upassword'];?>"></p>
		<h4><?echo $_GET['re_password_error'];?></h4>
		<h4><?echo $_GET['re_error'];?></h4>
		<p>Аватар:<input type="file" name="avatar"></p>
		<h4><?echo $_GET['av_error'];?></h4>
		<input class="message_form_button" name="message_form_button" type="submit" value="Сохранить">
		<p>*: Звездочкой помечены поля, обязательные для заполнения.</p>
		</form>
		</div>
		</div>
	</body>
	</html>
<?php
	
?>