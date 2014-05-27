<?php
	$dblocation = "localhost"; // Имя сервера
	$dbuser = "root"; // Имя пользователя
	$dbpassword = ""; // Пароль 		
	$dbname="guestbook"; // Имя базы
	$db=@mysql_connect ($dblocation,$dbuser,$dbpassword);// Символ @ нужен для того, чтобы не выводилась ошибка при неудачном подключении
	if (!$db) // Если соединение не установлено
		{echo "<p>В данный момент соединиться с базой данных невозможно. Напишите об этом администратору.</p>";
			exit();
		}
	mysql_select_db ($dbname,$db); 
?>