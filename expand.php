<?php

require_once("config.php");
require_once("classes/Expander.php");

$key = $_GET['key'];

try {
        $mysql = new mysqli($config['db_hostname'], $config['db_username'], $config['db_password'], $config['db_db']);
        if ($mysql->connect_error) {
            throw new Exception("Connection error ".$mysql->connect_error);
        }

	$expander = new Expander($mysql);
	$url = $expander->expandUrl($key);

	$mysql->close();

	header("HTTP/1.1 301 Moved Permanently");
	header("Location: ".$url);
} catch (Exception $e) {
	print($e->getMessage());
}

?>
