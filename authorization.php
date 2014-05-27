<?php
session_start();
	include_once("dbcon.php");
	$uemail = mysql_real_escape_string($_POST['email']);
	//echo $uemail;
	$upassword = md5(mysql_real_escape_string($_POST['password']));
	if (isset($_POST['email'])&& isset($_POST['password']) && (strlen($_POST['email'])!=0) && (strlen($_POST['password'])!=0))
	{
		$query_login = "SELECT * FROM users WHERE uemail = '{$uemail}'";
		$sql = mysql_query($query_login);
		//echo $sql;
		$arr = mysql_fetch_array($sql);
		$counter = mysql_num_rows($sql);
		$uID = $arr['uID'];
		$utpassword = $arr['upassword'];
		if ($counter == 1)
		{
			$_SESSION['uID'] = $uID;
		}
		else 
		{
			$email_miss = "Данный e-mail не зарегистрирован";
			//header("location:login.php?email_miss=".$email_miss."");
		}		
		if ($upassword != $utpassword)
		{
			$password_error = "Неверный пароль";
		}
		
		if ($upassword == $utpassword && isset($_SESSION['uID']))
		{
			header("location:index.php");
		}
		else
		{
			header("location:login.php?email=".htmlspecialchars($uemail)."&password_error=".$password_error."&email_miss=".$email_miss."");
		}
	}
	else
	{
		if(strlen($_POST['email'])==0)
		{
			$email_error = "Введите адрес электронной почты";
		}
		if(strlen($_POST['password'])==0)
		{
			$password_error = "Введите пароль";
		}
		header("location:login.php?email=".htmlspecialchars($uemail)."&email_error=".$email_error."&password_error=".$password_error."");
	}
?>