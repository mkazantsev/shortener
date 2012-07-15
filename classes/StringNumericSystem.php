<?php

/**
 * String numeric system based on [A-Z,a-z] symbols of latin alphabet
 * and standart ord() and chr() functions referencing ASCII table
 *
 * @static
 */
class StringNumericSystem {
	private static $ord = 52;

	/**
	 * Specific version of chr() that handles indices and characters
	 * only from [A-Z,a-z] alphabet.
	 *
	 * @param integer Character index
	 * @return string String of one character that has a given index in [A-Z,a-z] alphabet
	 */
	public static function chr($index) {
		$chr = "";
		if ($index < 26) {
			$chr = chr($index + 65);
		} else if ($index < 52) {
			$chr = chr($index + 71);
		}
		return $chr;
	}


	/**
	 * Specific version of ord() that handles characters and indices
	 * only from [A-Z,a-z] alphabet.
	 *
	 * @param string String of one character
	 * @return integer Given character's index in [A-Z,a-z] alphabet
	 */
	public static function ord($chr) {
		$num = -1;
		if (ord($chr) < 91) {
			$num = ord($chr) - 65;
		} else if (ord($chr) < 123) {
			$num = ord($chr) - 71;
		}
		return $num;
	}

	/**
	 * Converts decimal number to string of a [A-Z,a-z] alphabet
	 *
	 */
	public static function numberToString($number) {
		$string = "";
		do {
			$rest = $number % self::$ord;
			$number = (int) ($number / self::$ord);
			$string = self::chr($rest).$string;
		} while ($number != 0);
		return $string;
	}

	/**
	 * Converts string of a [A-Z,a-z] alphabet to a decimal number 
	 *
	 */
	public static function stringToNumber($string) {
		$number = 0;
		for ($i = 0; $i < strlen($string); $i++) {
			$index = strlen($string) - $i - 1;
			$number += self::ord($string[$index]) * pow(self::$ord, $i);
		}
		return $number;
	}
}

?>
