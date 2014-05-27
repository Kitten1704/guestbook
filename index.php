<?php
session_start();
include_once("dbcon.php");
print '
<html>
	<head>
		<meta http-equiv="Content-Tipe" content="text/html; charset=utf-8">
		<link rel="shortcut icon" href="img/main_ico.png" type="image/x-icon"><!--Иконка для странички-->
		<title>Гостевая книга</title><!--заголовок страницы-->
		<link rel="stylesheet" type="text/css" href="guestbook_style.css" ><!--Подключаем css-->
	</head>
	<body>
		<div class="container">
			<div class="title">';
			if (isset($_SESSION['uID']))
			{
			print'
			<div class="title_links"><a href="profile.php">Редактировать профиль</a>&nbsp;|&nbsp;<a href="logout.php">Выход</a>';
			}
			else
			{
			print'
			<div class="title_links"><a href="login.php">Войти</a>&nbsp;|&nbsp;<a href="reg.php">Регистрация</a>';
			}
			print'</div>
			</div>
			<div class="messages">';

	
	// Извлекаем данные из БД, сортируем по увыванию
	//$sql_select_messages = mysql_query ("SELECT userID, ptext, pdate FROM posts", $db);
	$sql_select_messages = mysql_query ("SELECT  posts.ptext, posts.pdate, users.uname, users.usname, users.uemail, users.uavatar FROM posts LEFT JOIN users ON users.uID = posts.userID ORDER BY posts.pdate DESC", $db);
	$arr = mysql_fetch_array ($sql_select_messages);
	// Проверяем, есть ли что-нибудь в БД, если нет - пишем, что книга пустая
	if ($arr==0)
	{echo "<h3>В книге пока нет записей.</h3>";}
	// Если в массиве есть данные из БД - выводим на экран 
	else 
	{
        echo "<table>";
	echo "<tr><td colspan='2' height=10px><hr></td></tr>";
	$i=0;
	do
	{
		/*echo $arr['userID']."<br>";
		echo $arr['ptext']."<br>";
		echo $arr['pdate']."<br>";*/
		echo "<tr><td width=25%><h1>".htmlspecialchars($arr['uname'])." ";	
		echo htmlspecialchars($arr['usname'])."</h1>";
		echo "<div class='avatar'><img src=".$arr['uavatar']."></div>";		
        echo "<h1>".htmlspecialchars($arr['uemail'])."</h1><br>";
		echo "<h2>".htmlspecialchars($arr['pdate'])."</h2><br></td>";	
		echo "<td><p>".htmlspecialchars($arr['ptext'])."</p></td></tr>";
		echo "<tr><td colspan='2'><hr></td></tr>";
	}
	while ($arr = mysql_fetch_array ($sql_select_messages));
	echo "</table>";
       	}
print'
		</div>
		<div class="clear"></div>
		</div>';



	if (isset($_SESSION['uID']))
	{
	$sql_select_users = mysql_query ("SELECT * FROM users WHERE uID = '{$_SESSION['uID']}'", $db);
	$arr = mysql_fetch_array ($sql_select_users);
	$user_name = $arr['uname'];
	//echo $user_name;
		print '
				<div class="message_form">
				<div class="message_form_center">
				<!--Форма ввода новых сообщений
				через GET получаем текст, ввденный в поля, если заполнены не все обязательные /Имя, mail, сообщение/
				*_error - текст предупреждений, если не все поля заполнены-->
				<form  method="post" action="guestbook_add.php">';
				echo "<div class='user_name'><p>".$user_name.":</p></div>";
				echo "<div class='avatar'><img src=".$arr['uavatar']."></div>";
				echo "<div class='text_box'><p><textarea class='text_color' name='message' cols='45' rows='8' placeholder='Введите текст сообщения'></textarea></p></div>
				<h4>"; echo $_GET['message_error']; print'</h4>
				<input class="message_form_button" name="message_form_button" type="submit" value="Разместить">
				</form>
				</div>
				</div>';
	}
	print'
	</body>
</html>';
?>	
			