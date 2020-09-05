<?php
class codeExampleBot {
	private $token;
	private $chatid;
	private $message;
	function __construct() {
		$config = parse_ini_file(dirname(__FILE__,2) . "/config/codeExampleBot_config.ini");
		$this->token = $config['codeExampleBot_token'];
		$this->chatid = $config['chat_id'];
	}
	public function setMessage($msg) {
		$this->message = $msg;
	}
	private function getURL() {
		$returned = "";
		if (isset($this->message) && $this->message != "") {
			$chatid = $this->chatid;
			$token = $this->token;
			$outMessage = $this->message;
			//https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chatnumber}&parse_mode=html&text={$text}
			$returned = sprintf("%s%s/sendMessage?chat_id=%s&parse_mode=html&text=%s","https://api.telegram.org/bot",$token,$chatid,urlencode($outMessage));
		} else { 
			echo "Telegram Bot: Message must be set.\n";
		}
		return $returned;
	}
	public function sendMessage() {
		$APIUrl = $this->getURL();
		if ($APIUrl == "") {
			return 0;
		}
		$postmsg = fopen($APIUrl,"r");
		if ($postmsg) {
			echo("Message has been sent\n");
		} else {
			echo("Error sending message\n");
		}
		return 1;
	}
}
?>
