<?php
/*	mysql_query ("set character_set_client='utf8'"); //кодировка, в которой данные будут поступать от клиента
	mysql_query ("set character_set_results='utf8'"); //кодировка, в которой будет выбран результат
	mysql_query ("set collation_connection='utf8'"); //кодировка по умолчанию для всего, что в рамках соединения не имеет кодировки
	mysql_query('SET CHARACTER SET utf8');
	mysql_query('SET NAMES utf8');	
	*/
	$db = mysql_connect("localhost","root", "");
	mysql_select_db("aibek", $db);
	//$db->query("SET NAMES 'utf8'");
?>