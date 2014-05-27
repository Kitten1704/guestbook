<?
session_start();    //инициализируем механизм сессий
session_destroy();  //удаляем текущую сессию
header("Location: index.php");  //перенаправляем на index.php
?>