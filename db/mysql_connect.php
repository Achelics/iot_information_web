<?php
//引入数据库配置文件
error_reporting(E_ALL ^ E_DEPRECATED);
require_once 'db_config.php';
$link=mysql_connect($db_info['db_host'],$db_info['db_user'],$db_info['db_pswd']);
if(false==$link){
	die("数据库连接失败：".mysql_error());
}
mysql_select_db($db_info['db_name']) or die('select db error'.mysql_error());
mysql_set_charset($db_info['db_charset']);
?>