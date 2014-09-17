<?php
/*
 * 邮件发送类
 * Sendmail::send($html, $email)
 * url http://github.com/whaten/yaf-php
 * 欢迎大家扩展回馈
 */
final class Sendmail {

		private static $smtp = 'smtp.126.com'; //smtp服务器,如smtp.126.com smtp.qq.com
		private static $port = '25'; //端口,一般为25
		private static $user = 'jiangweiweibingo@126.com'; //你的邮件账号,如admin@126.com
		private static $pwd = 'swad1345'; //账号对应的密码
		private static $connection;
		
		private function __construct(){}

		/* 连接smtp服务器并验证账号信息 */
		private static function connect(){
			self::$connection = $connection = fsockopen(self::$smtp, self::$port);
			if($connection){
				fgets($connection); //必须要获取一次，否则下次读取的是上一次的值
				self::write('HELO ' . self::$smtp . "\r\n", 250);
				self::write("auth login \r\n", 334);
				self::write(base64_encode(self::$user) . "\r\n", 334);
				self::write(base64_encode(self::$pwd) . "\r\n", 235);
			}else{
				exit('请检查邮件类成员属性是否正确');
			}

		}

		/*
		 * 发送邮件
		 * @param $html string 发送的内容
		 * @param $email string 对方邮箱地址
		 * @param $subject string 邮件主题
		 */
		public static function send($html, $email, $subject=''){
			if($html==null || $email==null) return null;
			self::connect();
			self::write('MAIL FROM: <' . self::$user . '>' . "\r\n", 250);
			self::write('RCPT TO: <' . $email . '>' . "\r\n", 250);
			self::write("DATA\r\n");
			self::write("From: " . self::$user . "\r\n");
			self::write("To: " . $email . "\r\n");
			if($subject) self::write("Subject: " . $subject . "\r\n");
			self::write("Content-type:text/html; charset=utf-8\r\n");
			self::write("\r\n" . $html . "\r\n.\r\n", 354);
			self::write("QUIT\r\n");
			unset($html);
			fclose(self::$connection);
		}

		/*
		 * 判断每一次发送的命令是否执行成功
		 * @param $msg string 具体发送的命令
		 * @param $responseCode int 判断命令是否执行成功的返回值
		 * @return string 出错的命令以及命令返回的值,命令执行成功没有返回值
		 */
		private static function write($msg, $responseCode=null){
			fputs(self::$connection, $msg);
			if($responseCode){
				$getResponse = fgets(self::$connection);
				if($responseCode!=intval($getResponse)){
					echo $msg;
					exit($getResponse);
				}
			}
		}

}
