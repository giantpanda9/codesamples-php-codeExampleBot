<?php
function main() {
	require_once dirname(__FILE__) . "/classes/class_parseNASA.php";
	$parseNASAInstance = new parseNASA();
	$NASAAPIResponse = $parseNASAInstance->getDescription();
	require_once dirname(__FILE__) . "/classes/class_codeExampleBot.php";
	$codeExampleBotInstance = new codeExampleBot();
	$codeExampleBotInstance->setMessage($NASAAPIResponse);
	$telegramAPIResponse = $codeExampleBotInstance->sendMessage();
	exit();
}
main();
?>
