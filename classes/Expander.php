<?php

require_once("StringNumericSystem.php");

/**
 * URL Expander
 *
 */
class Expander {
	private $mysql;

	/**
	 * Constructor
	 *
	 * @param  mysqli $mysql Created mysqli with opened connection to existing database
	 */
	public function __construct($mysql) {
		$this->mysql = $mysql;
	}

	/**
	 * Expands a given short URL
	 *
	 * @throws Exception
	 * @param $url Short URL
	 */
	public function expandUrl($url) {
		$id = StringNumericSystem::stringToNumber($url);
		if ($result = $this->mysql->query("SELECT url FROM Urls WHERE id = ".$id)) {
			if ($row = $result->fetch_row()) {
				$longUrl = $row[0];
			} else {
				throw new Exception("URL not found");
			}
		} else {
			throw new Exception("URL selection failed");
		}
		return $longUrl;
	}
}

?>
