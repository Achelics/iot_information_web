<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6 lt8"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7 lt8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8 lt8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="UTF-8" />
        <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">  -->
        <title>Achelics|Waiting</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="description" content="Login and Registration Form with HTML5 and CSS3" />
        <meta name="keywords" content="html5, css3, form, switch, animation, :target, pseudo-class" />
        <meta name="author" content="Codrops" />
        <link rel="shortcut icon" href="../favicon.ico"> 
        <link rel="stylesheet" type="text/css" href="css/demo.css" />
     </head>
    <body>
		<div class="container">
		<header>
				<nav class="codrops-demos">
					<span>聚类分析<strong>"数据"</strong> 结果展示!</span>
				</nav>
        </header>
        	 	<p align="left"><?php
					//1.连接到数据库
					require_once 'db/mysql_connect.php';
					// 从表中提取信息的sql语句
					$sql="select * from data_cluster1";
					// 执行sql查询
					$result=mysql_query($sql);;
					mysql_db_query("set names utf-8");
					// 获取查询结果
					$row=mysql_fetch_row($result);

					echo '<font face="verdana">';
					echo '<table border="1" cellpadding="1" cellspacing="2">';

					// 显示字段名称
					for ($i=0; $i<mysql_num_fields($result); $i++)
					{
					echo '<td bgcolor="#FFFFFF"><b>'.
					mysql_field_name($result, $i);
					}
					// 定位到第一条记录
					mysql_data_seek($result, 0);
					// 循环取出记录
					while ($row=mysql_fetch_row($result))
					{
					echo "<tr>";
					for ($i=0; $i<mysql_num_fields($result); $i++ )
					{
					echo '<td bgcolor="#fff">';
					echo "$row[$i]";
					echo '</td>';
					}
					}
					echo "</font>";
					// 释放资源
					mysql_free_result($result);
					// 关闭连接
					mysql_close(); 
				?>
				</p>
				<p align="center"><?php
					//1.连接到数据库
					require_once 'db/mysql_connect.php';
					// 从表中提取信息的sql语句
					$sql2="select * from data_cluster2";
					// 执行sql查询
					$result2=mysql_query($sql2);;
					mysql_db_query("set names utf-8");
					// 获取查询结果
					$row2=mysql_fetch_row($result2);

					echo '<font face="verdana">';
					echo '<table border="1" cellpadding="1" cellspacing="2">';

					// 显示字段名称
					for ($i=0; $i<mysql_num_fields($result2); $i++)
					{
					echo '<td bgcolor="#FFFFFF"><b>'.
					mysql_field_name($result2, $i);
					}
					// 定位到第一条记录
					mysql_data_seek($result2, 0);
					// 循环取出记录
					while ($row2=mysql_fetch_row($result2))
					{
					echo "<tr>";
					for ($i=0; $i<mysql_num_fields($result2); $i++ )
					{
					echo '<td bgcolor="#fff">';
					echo "$row2[$i]";
					echo '</td>';
					}
					}
					echo "</font>";
					// 释放资源
					mysql_free_result($result2);
					// 关闭连接
					mysql_close(); 
				?>
				</p>
		</div>
	</body>
</html>
