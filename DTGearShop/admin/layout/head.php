<?php
	session_start();
	if(isset($_SESSION['maLoai']) && $_SESSION['maLoai'] == 0 && isset($_SESSION['tenDN']) && isset($_SESSION['matKhau']))
		header('location:../index.php');
	else if(!isset($_SESSION['tenDN']))
		header('location:../index.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/style_AM.css"/>
<link rel="stylesheet" type="text/css" href="css/design_fromAD.css"/>
<script type="text/javascript" src="js/jquery-1.8.2.js"></script>
<link rel="stylesheet" type="text/css" href="js/jquery-ui.css"/>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<title>Trang quản trị DT Gear Shop</title>
</head>