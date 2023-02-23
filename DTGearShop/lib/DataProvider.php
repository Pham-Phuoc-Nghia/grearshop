<?php
	define("SERVER", "localhost");
	define("DATABASE","quan_ly_cua_hang");
	define("USERNAME", "root");
	define("PASSWORD", "");
	class DataProvider{
		public static function ExcuteQuery($sql)
		{
			global $host, $username, $password, $database;
			
			$connection = mysqli_connect(SERVER,USERNAME,PASSWORD,DATABASE) or
			die("Couldn't connect to localhost");
			mysqli_query($connection, "set names utf8");
			$result = mysqli_query($connection, $sql);
			mysqli_close($connection);
			return $result;
		}
		
	}
?>