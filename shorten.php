<?php

require_once("config.php");
require_once("classes/Shortener.php");
require_once("classes/Utils.php");

$json = "";

try {
	$mysql = new mysqli($config['db_hostname'], $config['db_username'], $config['db_password'], $config['db_db']);
	if ($mysql->connect_error) {
	    throw new Exception("Connection error ".$mysql->connect_error);
	}

	$shortener = new Shortener($mysql);

	$url = $_POST['url'];
	if (!Utils::isUrl($url)) {
	    throw new Exception("Not a URL");
	}

	$json = "{ 'url': '".$config['path'].$shortener->shortenUrl($url)."' }";

	$mysql->close();
} catch (Exception $e) {
	$json = "{ 'error': '".$e->getMessage()."' }";
}

if ($_GET['callback']) {
	print($_GET['callback']."(".$json.")");
} else if ($_GET['jsonp']) {
	print($_GET['jsonp']."(".$json.")");
} else {
	print($json);
}

?>
