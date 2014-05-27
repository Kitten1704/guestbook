<?php
session_start();
// соединяемся с базой
	include_once("dbcon.php");
	$errors = array();
	$errors_arr =array();
	unset ($errors_arr);
	// заносим информацию из заполненных полей в массив, чтобы передать в форму обратно с предупреждением
		$back_text_form = array();
		$back_text_form[0] = mysql_real_escape_string($_POST['name']);
		$back_text_form[1] = mysql_real_escape_string($_POST['sname']);
		$back_text_form[2] = mysql_real_escape_string($_POST['email']);
		$back_text_form[3] = mysql_real_escape_string($_POST['password']);
		$back_text_form[4] = mysql_real_escape_string($_POST['re_password']);
	// проверяем заполненность обязательных полей
	// если хотя бы одно обязательное поле не заполнено делаем:
	if (strlen($_POST['name'])==0 OR strlen($_POST['email'])==0 OR strlen($_POST['password'])==0 OR strlen($_POST['re_password'])==0)
	{	
	// проверяем, какие обязательные поля не заполнены, 
	//пишем в массив текстов ошибок соответствующие предупреждения
		
			if (strlen($_POST['name'])==0)
			{
				$errors[0]="Введите свое имя";
			}
			if (strlen($_POST['email'])==0)
			{
				$errors[1]="Введите адрес электронной почты";
			}
			if (strlen($_POST['password'])==0)
			{
				$errors[2]="Введите пароль";
			}
			if (strlen($_POST['re_password'])==0)
			{
				$errors[3]="Подтвердите пароль";
			}
			
		// передаем уже введенную информацию в те поля ввода, из которых она пришла
		//+передаем тексты предупреждений для пустых обязательных полей
		header("location:profile.php?name=".htmlspecialchars($back_text_form[0])."&sname=".htmlspecialchars($back_text_form[1])."&email=".htmlspecialchars($back_text_form[2])."&password=".htmlspecialchars($back_text_form[3])."&re_password=".htmlspecialchars($back_text_form[4])."&name_error=".$errors[0]."&email_error=".$errors[1]."&password_error=".$errors[2]."&re_password_error=".$errors[3]."&re_error=".$errors[4]."");
	}
	//если все обязательные поля заполнены:
	else
	
	{
	// проверяем загруженный аватар
		if ($_FILES['avatar']['size']!=0)
		{
			if($_FILES['avatar']['type'] != "image/gif" AND $_FILES['avatar']['type'] !="image/jpeg" AND $_FILES['avatar']['type'] !="image/jpg" AND $_FILES['avatar']['type'] !="image/png")
			{
				$errors_arr[0] = "Загружен файл недопустимого формата";
			}	
			else
			{
			// сохраняем исходное расширение файла
				if ($_FILES['avatar']['type'] == "image/jpeg" OR $_FILES['avatar']['type'] == "image/jpg")
				{
					$ftype = "jpg";
				}
				if ($_FILES['avatar']['type'] == "image/gif")
				{
					$ftype = "gif";
				}
				if ($_FILES['avatar']['type'] == "image/png")
				{
					$ftype = "png";
				}
				//директория загрузки
				$uploaddir = "usr/";
				//новое имя изображения
				$fname=$_SESSION['uID'].'.'.$ftype;
				//путь к новому изображению
				$uploadfile = "$uploaddir$fname";
				$file_uploaded = move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadfile);
				//echo $uploadfile;
			}
		}
		$correct_info = array();
		$correct_info[0]=mysql_real_escape_string($_POST['name']);
		$correct_info[4]=$uploadfile;
		
		
		// если пользователь ничего не ввел в поле "фамилия", заполняем переменную пустотой 
		if (strlen($_POST['sname'])==0)
		{
			$_POST['sname']="";
			$correct_info[1]=$_POST['sname'];
		}
		// если e-mail соответствует маске *@*.*
		if(preg_match("|^[-0-9a-z_\.]+@[-0-9a-z_^\.]+\.[a-z]{2,6}$|i", $_POST['email']))
		{
			$correct_info[2]=mysql_real_escape_string($_POST['email']);
		}
		else
		{
			$errors_arr[1]="Введите корректный e-mail. Например: mail@mail.ru";
		}
		
		//проверяем одинаковость паролей
		$pass=$_POST['password'];
		$re_pass=$_POST['re_password'];
		if ($pass == $re_pass)
		{
			$correct_info[3]=mysql_real_escape_string($_POST['password']);
		}
		else
		{
			$errors_arr[2]="Введенные пароли не совпадают";
		}
		// проверяем, обновил ли пользователь пароль
		$sql_select_users = mysql_query ("SELECT * FROM users WHERE uID = '{$_SESSION['uID']}'", $db);
		$arr = mysql_fetch_array ($sql_select_users);
		$utpass = $arr['upassword'];
		$ufpass = $_POST['password'];
		if ($utpass == $ufpass)	
		{
			$correct_info[3]=mysql_real_escape_string($_POST['password']);
		}
		else
		{
			$correct_info[3]=md5(mysql_real_escape_string($_POST['password']));
		}
		// проверяем, есть ли ошибки. Если есть - выводим предупреждения пользователю
		if (isset($errors_arr))
		{
			header("location:profile.php?name=".htmlspecialchars($back_text_form[0])."
			&sname=".htmlspecialchars($back_text_form[1])."&email=".htmlspecialchars($back_text_form[2])."
			&password=".htmlspecialchars($back_text_form[3])."&re_password=".htmlspecialchars($back_text_form[4])."
			&email_error=".$errors_arr[1]."&re_error=".$errors_arr[2]."&av_error=".$errors_arr[0]."");
			
		}
		if (!isset($errors_arr) AND $file_uploaded)
		{
			$strSQL = "UPDATE users SET uname ='{$correct_info[0]}',usname='{$correct_info[1]}',uemail='{$correct_info[2]}',
			upassword='{$correct_info[3]}',uavatar='{$correct_info[4]}'WHERE uID = '{$_SESSION['uID']}'";
			//echo $strSQL;
			mysql_query($strSQL) or die(mysql_error());
			header("location:index.php");
		}
		elseif (!isset($errors_arr))
		{
			$strSQL = "UPDATE users SET uname ='{$correct_info[0]}',usname='{$correct_info[1]}',uemail='{$correct_info[2]}',
			upassword='{$correct_info[3]}'WHERE uID = '{$_SESSION['uID']}'";
			//echo $strSQL;
			mysql_query($strSQL) or die(mysql_error());
			header("location:index.php");
		}
	}		
?>