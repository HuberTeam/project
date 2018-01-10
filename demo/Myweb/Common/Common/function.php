<?php
	//$to 接收方  $title 邮件主题  $content 发送邮件的内容
	function sendmail($to, $title, $content){
		//通过命名空间加载第三方发送邮件类 PHPMailer 
		$mail=new \Org\Util\PHPMailer();
		// echo $mail->Version;
		//设置字符集
		$mail->CharSet="utf-8";
		//设置采用SMTP方式发送邮件
		$mail->IsSMTP();
		//设置邮件服务器地址 smtp.163.com
		$mail->Host=C('mail1.smtp');//C 获取配置文件信息 
		//设置邮件服务器的端口 默认的是25  如果需要谷歌邮箱的话 443 端口号
		$mail->Port=25;
		//设置发件人的邮箱地址
		$mail->From=C('mail1.username'); //
		// $mail->FromName='我';//
		//设置SMTP是否需要密码验证
		$mail->SMTPAuth=true;
		//发送方
		$mail->Username=C('mail1.username');
		$mail->Password=C('mail1.password');//C客户端的授权密码(不是163邮箱的登录密码)
		//发送邮件的主题
		$mail->Subject=$title;
		//内容类型 文本型
		$mail->AltBody="text/html";
		//发送的内容
		$mail->Body=$content;
		//设置内容是否为html格式
		$mail->IsHTML(true);
		//设置接收方
		$mail->AddAddress(trim($to));
		//执行邮件发送
		if(!$mail->Send()){
			echo "失败".$mail->ErrorInfo;
			return false;
			
		}else{
			return true;
		}
	}
 ?>