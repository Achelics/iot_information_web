<!DOCTYPE>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="stylesheet" type="text/css" href="css/default.css" />
<title>Achelics|Waiting</title>
<!--必要样式-->
<link rel="stylesheet" type="text/css" href="css/component.css" />

<script src="js/modernizr.custom.js"></script>
<base target="_blank">
</head>
<body>
	<?php
		if(isset($_POST["submit"]) && $_POST["submit"] == "Login")
		{	
			$username = $_POST["username"];
			$password = $_POST["password"];
			//1.连接到数据库
			require_once 'db/mysql_connect.php';
			$sql="select user_name,user_psd from iot_user where user_name='$username' and user_psd='$password' or user_email='$username' and user_psd='$password'";
			$result=mysql_query($sql);
			$num=mysql_num_rows($result);
			if($num){
				 $row = mysql_fetch_array($result);  //将数据以索引方式储存在数组中  
			}
			else
			{
				echo "<script>alert('用户名或密码不正确！');history.go(-1);</script>";
				exit();
			}
			
		}
		else
		{
			echo "<script>alert('提交未成功！'); history.go(-1);</script>";
			exit();
		}
	?>
<div class="container">	
	<header class="clearfix">
		<h1>欢迎来到数据分析模块</h1>	
	</header>
	<div class="main">
		<p>点击用户下面的生成图标的链接，则可以生成对应的图形</p>
		<div class="side">
			<nav class="dr-menu">
				<div class="dr-trigger"><span class="dr-icon dr-icon-menu"></span><a class="dr-label">帐户</a></div>
				<ul>
					<li><a class="dr-icon dr-icon-user" href="#"><?php echo $row[0] ?></a></li>
					<li><a href="charts/line.html">折线图</a></li>
					<li><a href="charts/bar.html">柱状图</a></li>
					<li><a href="charts/doughnut.html">环形图</a></li>
					<li><a href="charts/pie.html">饼状图</a></li>
					<li><a href="charts/polar-area.html">等高线图</a></li>
					<li><a href="runcluster.php">聚类分析图</a></li>
				</ul>
			</nav>
		</div>
	</div>
</div><!-- /container -->

<script src="js/ytmenu.js"></script>
 

</body>
</html>