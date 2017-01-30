<?php

namespace Utils;

/**
 * Class Utils$NumberUtils
 * @author Bruno Saliba <bsaliba at gmail dot com>
 */
class NumberUtils {
	
	/**
	 * Convert string to number
	 * 
	 * @author Bruno Saliba <bsaliba at gmail dot com>
	 * @since 30 de jan de 2017 11:21:08
	 * @param string $str
	 * @return number
	 */
	public static function str2num($str) {
		if(strpos($str, '.') < strpos($str,',')) {
			$str = str_replace('.','',$str);
			$str = strtr($str,',','.');
		} else {
			$str = str_replace(',','',$str);
		}
		return (float)$str;
	}
	
	/**
	 * Format number
	 * 
	 * @author Bruno Saliba <bsaliba at gmail dot com>
	 * @since 30 de jan de 2017 11:21:45
	 * @param number $number
	 * @return string
	 */
	public static function formatNumber($number) {
		if($number === null) {
			return null;
		}
		return number_format($number, 2, ',', '.');
	}
	
	/**
	 * Remove zeros from decimal
	 * 
	 * @author Bruno Saliba <bsaliba at gmail dot com>
	 * @since 30 de jan de 2017 11:22:03
	 * @param string $numberFormatted
	 * @param string $separadorDecimal
	 * @return string
	 */
	public static function removeZerosDecimal($numberFormatted, $separadorDecimal = ',') {
		$f = explode($separadorDecimal, $numberFormatted);
		$dec = rtrim($f[1], '0');
	
		return $f[0] . (strlen($dec) > 0 ? $separadorDecimal . $dec : '');
	}
	
	/**
	 * Compare floats
	 * 
	 * @author Bruno Saliba <bsaliba at gmail dot com>
	 * @since 30 de jan de 2017 11:22:39
	 * @param number $n1
	 * @param number $n2
	 * @return boolean
	 */
	public static function compareFloat($n1, $n2) {
		return abs(($n1 - $n2) / $n2) < 0.0000001;
	}
	
	/**
	 * Format BRL Currency
	 * 
	 * @author Bruno Saliba <bsaliba at gmail dot com>
	 * @since 30 de jan de 2017 11:23:17
	 * @param number $number
	 * @return string
	 */
	public static function formatBRLCurrency($number) {
		return 'R$ ' . number_format($number, 2, ',', '.');
	}
	
	/**
	 * Check if $input is an integer
	 * 
	 * @author Bruno Saliba <bsaliba at gmail dot com>
	 * @since 30 de jan de 2017 11:23:55
	 * @param number $input
	 * @return boolean
	 */
	public static function isInteger($input) {
		return ctype_digit(strval($input));
	}
	
	/**
	 * Get fibonacci number at given position
	 * 
	 * @author Bruno Saliba <bsaliba at gmail dot com>
	 * @since 30 de jan de 2017 11:24:59
	 * @param number $n
	 * @return number
	 */
	public static function fibonacci($n) {
		if($n < 2) {
			return $n;
		}
	
		$int1 = 1;
		$int2 = 1;
	
		$fib = 0;
	
		for($i = 1; $i <= $n - 1; $i++) {
			$fib = $int1 + $int2;
			$int2 = $int1;
			$int1 = $fib;
		}
	
		return $fib;
	}
	
	/**
	 * Get percentagem
	 * 
	 * @author Bruno Saliba <bsaliba at gmail dot com>
	 * @since 30 de jan de 2017 11:25:54
	 * @param number $num
	 * @param number $total
	 * @param string $func
	 * @return number
	 */
	public static function getPercentage($num, $total, $func = 'round') {
		if($func == 'floor') {
			return floor($num * 100 / $total, 2);
		}
	
		return round($num * 100 / $total, 2);
	}
}
