<?php
namespace org;

use org\Notify;
use phpmailer\PHPMailer;

/**
* 发送邮件类
*
*/
class Email_Notify implements Notify{
   
	private $to;
	private $title;
	private $content;
	// private $name;
	
	private $mailerObj;
	
	public function __construct($to,$title,$content){
		$this->to = $to;
		$this->title = $title;
		$this->content = $content;
		// $this->name = $name;
		$this->setMailer();
	}
	
	
	/**
	* 执行发送
	*/
	public function send(){
		if (!$this->mailerObj->send()) {
			return false;
			// echo "Mailer Error: " . $mail->ErrorInfo;
		} else {
			return true;
			// echo "Message sent success!";
		}
	}
	
	
	/**
	* 配置mailer
	*/
	private function setMailer(){
		
		//设置时间
        date_default_timezone_set('PRC');
		
		try{
			$mail = new PHPMailer;
			$mail->isSMTP();
			
			//调试模式上线关闭
			// $mail->SMTPDebug = 2;
			
			$mail->Debugoutput = 'html';
			$mail->Host = config('email.host');
			$mail->Port = config('email.port');

			// 安全协议,163用ssl,hotmail gmail用tls.
			//之前测试不加安全协议发送不成功
			$mail->SMTPSecure = "ssl";//"ssl";
			$mail->SMTPAuth = true;
	
			$mail->Username = config('email.username');
			$mail->Password = config('email.password');
			
			$mail->setFrom(config('email.username'), config('email.name'));
			$mail->addAddress($this->to);
			$mail->Subject = $this->title;
			$mail->msgHTML($this->content);
			
			$this->mailerObj = $mail;
          
        }catch (phpmailerException $e){
            return false;
        }		
	}
	
}


