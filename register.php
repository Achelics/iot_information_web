<?php
	if(isset($_POST["Submit"]) && $_POST["Submit"] == "Sign")
	{

		$username = $_POST["usernamesignup"];
		$email = $_POST["emailsignup"];
		$password = $_POST["passwordsignup"];
		$psw_confirm = $_POST["passwordsignup_confirm"];
				
		if($password == $psw_confirm)
		{	
			//1.连接到数据库
			require_once 'db/mysql_connect.php';
			$sql = "select user_name from iot_user where user_name = '$username'";	//SQL语句
			$result = mysql_query($sql);	//执行SQL语句
			$num = mysql_num_rows($result);	//统计执行结果影响的行数
			if($num)//如果已经存在该用户
			{
				echo "<script>alert('The user name already exists!'); history.go(-1);</script>";
			}
			else//不存在当前注册用户名称
			{
				$sql_insert = "insert into iot_user (user_name,user_psd,user_email) values('$username','$password','$psw_confirm')";
				$res_insert = mysql_query($sql_insert);
				if($res_insert)
				{
					echo "<script>alert('The success of the registration!'); history.go(-1);</script>";
				}
				else
				{
					echo "<script>alert('The system is busy, please wait!'); history.go(-1);</script>";
				}
			}
			
		}
		else
		{
			echo "<script>alert('Passwords do not match!'); history.go(-1);</script>";
		}
	}
	else
	{
		echo "<script>alert('Submit without success!'); history.go(-1);</script>";
	}
?>