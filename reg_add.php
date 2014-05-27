<?php
// соединяемся с базой
	include_once("dbcon.php");
	// заносим информацию из заполненных полей в массив, чтобы передать в форму обратно с предупреждением
		$back_text_form = array();
		$back_text_form[0] = mysql_real_escape_string($_POST['name']);
		$back_text_form[1] = mysql_real_escape_string($_POST['sname']);
		$back_text_form[2] = mysql_real_escape_string($_POST['email']);
		$back_text_form[3] = mysql_real_escape_string($_POST['password']);
		$back_text_form[4] = mysql_real_escape_string($_POST['re_password']);
		// для проверки уникальности e-mail
		$sql_select_users = mysql_query ("SELECT * FROM users WHERE uemail = '{$_POST['email']}'", $db);
		$arr = mysql_fetch_array ($sql_select_users);
		$utemail = $arr['uemail'];
		$uqemail = $_POST['email'];
	// проверяем заполненность обязательных полей
	// если хотя бы одно обязательное поле не заполнено делаем:
	if (strlen($_POST['name'])==0 OR strlen($_POST['email'])==0 OR strlen($_POST['password'])==0 OR strlen($_POST['re_password'])==0)
	{	
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
		header("location:reg.php?name=".htmlspecialchars($back_text_form[0])."&sname=".htmlspecialchars($back_text_form[1])."&email=".htmlspecialchars($back_text_form[2])."&password=".htmlspecialchars($back_text_form[3])."&re_password=".htmlspecialchars($back_text_form[4])."&name_error=".$errors[0]."&email_error=".$errors[1]."&password_error=".$errors[2]."&re_password_error=".$errors[3]."&re_error=".$errors[4]."");
	}
	//если все обязательные поля заполнены:
	elseif ($uqemail == $utemail)
	{
	// проверяем уникальность e-mail
		$e_error = "Данный е-mail уже зарегистрирован";
		header("location:reg.php?name=".htmlspecialchars($back_text_form[0])."&sname=".htmlspecialchars($back_text_form[1])."&email=".htmlspecialchars($back_text_form[2])."&email_error=".$e_error."");
	}
	else{
// проверяем соответсвие e-mail маске *@*.*
	 if(preg_match("|^[-0-9a-z_\.]+@[-0-9a-z_^\.]+\.[a-z]{2,6}$|i", $_POST['email']))
	 {
// если пользователь ничего не ввел в поле "фамилия", заполняем переменную пустотой 
		if (strlen($_POST['sname'])=="")
		{
			$_POST['sname']="";
		}
//проверяем одинаковость паролей
			$pass=$_POST['password'];
			$re_pass=$_POST['re_password'];
			if ($pass != $re_pass)
			{
				$re_error="Введенные пароли не совпадают";
				header("location:reg.php?name=".htmlspecialchars($back_text_form[0])."&sname=".htmlspecialchars($back_text_form[1])."&email=".htmlspecialchars($back_text_form[2])."&re_error=".htmlspecialchars($re_error)."");
			}
			else{
// записываем в БД то, что пришло из формы		
			$strSQL = "INSERT INTO users(uname,usname,uemail,upassword) VALUES('".mysql_real_escape_string($_POST['name'])."','".mysql_real_escape_string($_POST['sname'])."','".mysql_real_escape_string($_POST['email'])."','".md5(mysql_real_escape_string($_POST['password']))."')";
			//echo $strSQL;
			mysql_query($strSQL) or die(mysql_error());
// переходим на страницу гостевой книги
			header("location:index.php");
			}
		}
	else 
	{
	// если e-mail не соответсвует маске:
			$mask_e_error = "Введите корректный e-mail. Например: mail@mail.ru";
			header("location:reg.php?name=".htmlspecialchars($back_text_form[0])."&sname=".htmlspecialchars($back_text_form[1])."&email=".htmlspecialchars($back_text_form[2])."&password=".htmlspecialchars($back_text_form[3])."&re_password=".htmlspecialchars($back_text_form[4])."&email_error=".$mask_e_error."");
	}
	}
?>