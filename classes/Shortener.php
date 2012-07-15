<?php

require_once("StringNumericSystem.php");

/**
 * URL Shortener
 *
 */
class Shortener {
	private $mysql;

	/**
	 * Constructor
	 *
	 * @param mysqli $mysql Created mysqli with opened connection to existing database
	 */
	public function __construct($mysql) {
		$this->mysql = $mysql;
	}

	/**
	 * Shortens a given URL
	 *
	 * @param $url Any possible long URL
	*/
	public function shortenUrl($url) {
		if (!$this->mysql->query("INSERT INTO Urls (url) VALUES ('".$url."')")) {
			throw new Exception("Couldn't save URL to database");
		}
		return StringNumericSystem::numberToString($this->mysql->insert_id);
	}
}

?>
