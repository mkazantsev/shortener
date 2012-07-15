<?php

/**
 * Utilities class
 *
 * @static
 */
class Utils {
	private static $urlPattern = "@(((ht|f)tp(s?))\://)(www.|[a-zA-Z].)[a-zA-Z0-9\-\.]+\.([a-zA-Z]{2,7})(\:[0-9]+)*(/[a-zA-Z0-9\.\,\;\?\'\+%#\=~_\-]+)*@";

	/**
	 * Checks if a given string is a URL in a proper form
	 * 
	 * @param string
	 */
	public static function isUrl($url) {
		return (preg_match(self::$urlPattern, $url) > 0 ? true : false);
	}
}

?>
