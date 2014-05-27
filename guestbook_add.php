<?php
session_start();
// соединяемся с базой
	include_once("dbcon.php");
	if (strlen($_POST['message'])==0)
	{
		$message_error = "Введите текст сообщения";
		header("location:index.php?message_error=".$message_error."");
	}
	else 
	{
		$strSQL = "INSERT INTO posts(userID,ptext) VALUES('".$_SESSION['uID']."','".mysql_real_escape_string($_POST['message'])."')";
			//echo $strSQL;
			mysql_query($strSQL) or die(mysql_error());
// переходим на страницу гостевой книги
			header("location:index.php");
	}
	/*// проверяем заполненность обязательных полей
	// если хотя бы одно обязательное поле не заполнено делаем:
	if (strlen($_POST['name'])==0 OR strlen($_POST['email'])==0 OR strlen($_POST['message'])==0)
	{	
	// заносим информацию из заполненных полей в массив, чтобы передать в форму обратно с предупреждением
		$back_text_form = array();
		$back_text_form[0] = mysql_real_escape_string($_POST['name']);
		$back_text_form[1] = mysql_real_escape_string($_POST['email']);
		$message_back = mysql_real_escape_string($_POST['message']);
		$back_text_form[2] = $message_back;
	// проверяем, какие обязательные поля не заполнены, 
	//пишем в массив текстов ошибок соответствующие предупреждения
		$errors = array();
			if (strlen($_POST['name'])==0)
			{
				$errors[0]="Введите свое имя";
			}
			if (strlen($_POST['email'])==0)
			{
				$errors[1]="Введите адрес электронной почты";
			}
			if (strlen($_POST['message'])==0)
			{
				$errors[2]="Введите сообщение";
			}
		// передаем уже введенную информацию в те поля ввода, из которых она пришла
		//+передаем тексты предупреждений для пустых обязательных полей
		header("location:index.php?name=".htmlspecialchars($back_text_form[0])."&email=".htmlspecialchars($back_text_form[1])."&message=".htmlspecialchars($back_text_form[2])."&name_error=".$errors[0]."&email_error=".$errors[1]."&message_error=".$errors[2]."");
	}
	//если все обязательные поля заполнены:
	else
	{
// если пользователь ничего не ввел в поле "фамилия", заполняем переменную пустотой 
		if (strlen($_POST['sname'])=="")
		{
			$_POST['sname']="";
		}
// записываем в БД то, что пришло из формы		
			$strSQL = "INSERT INTO posts(pname,psname,pemail,ptext) VALUES('".mysql_real_escape_string($_POST['name'])."','".mysql_real_escape_string($_POST['sname'])."','".mysql_real_escape_string($_POST['email'])."','".mysql_real_escape_string($_POST['message'])."')";
			//echo $strSQL;
			mysql_query($strSQL) or die(mysql_error());
// переходим на страницу гостевой книги
			header("location:index.php");

	}*/
?>