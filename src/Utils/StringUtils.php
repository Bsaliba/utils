<?php

namespace Utils;

/**
 * Class Utils$StringUtils
 * @author Bruno Saliba <bsaliba at gmail dot com>
 */
class StringUtils {
	
	/**
	 * Remove non numeric characteres from string
	 * 
	 * @author Bruno Saliba <bsaliba at gmail dot com>
	 * @since 30 de jan de 2017 09:48:48
	 * @param string $string
	 * @return string
	 */
	public static function removeNonNumericChars($string) {
		return preg_replace("/[^0-9]/", "", $string);
	}
	
	/**
	 * Format Phone Number with DDD
	 * 
	 * @author Bruno Saliba <bsaliba at gmail dot com>
	 * @since 30 de jan de 2017 09:50:43
	 * @param number $ddd
	 * @param number $number
	 * @return string
	 */
	public static function formatPhone($ddd, $number) {
		$phone = self::removeNonNumericChars($ddd . $number);
		if(strlen($phone) == 10) {
			return self::mask($phone,'(##) ####-####');
		} elseif(strlen($phone) == 11) {
			return self::mask($phone,'(##) ####-#####');
		}
		return "";
	}
	
	/**
	 * Format Cpf
	 * 
	 * @author Bruno Saliba <bsaliba at gmail dot com>
	 * @since 30 de jan de 2017 09:51:21
	 * @param string $cpf
	 * @return string
	 */
	public static function formatCpf($cpf) {
		return self::mask($cpf,'###.###.###-##');
	}
	
	/**
	 * Format Cnpj
	 * 
	 * @author Bruno Saliba <bsaliba at gmail dot com>
	 * @since 30 de jan de 2017 09:51:57
	 * @param string $cnpj
	 * @return string
	 */
	public static function formataCnpj($cnpj) {
		return self::mask($cnpj,'##.###.###/####-##');
	}
	
	/**
	 * Fromat Cep
	 * 
	 * @author Bruno Saliba <bsaliba at gmail dot com>
	 * @since 30 de jan de 2017 11:18:32
	 * @param unknown $cep
	 * @return string
	 */
	public static function formataCep($cep) {
		return self::mask($cep,'##.###-##');
	}
	
	/**
	 * Apply mask
	 * 
	 * @author Bruno Saliba <bsaliba at gmail dot com>
	 * @since 30 de jan de 2017 09:50:28
	 * @param string $val
	 * @param string $mask
	 * @return string
	 */
	public static function mask($val, $mask) {
		$maskared = '';
		$k = 0;
		for($i = 0; $i <= strlen($mask) - 1; $i++) {
			if($mask[$i] == '#') {
				if(isset($val[$k])) {
					$maskared .= $val[$k++];
				}
			} else {
				if(isset($mask[$i])) {
					$maskared .= $mask[$i];
				}
			}
		}
	
		return $maskared;
	}
	
	/**
	 * Truncate string without break word
	 * 
	 * @author Bruno Saliba <bsaliba at gmail dot com>
	 * @since 30 de jan de 2017 09:52:21
	 * @param string $string
	 * @param number $maxChars
	 * @return string
	 */
	public static function truncate($string, $maxChars = 40) {
		$words = preg_split('/\s+/', $string);
	
		$chars = 0;
		$truncated = array();
		while(count($words) > 0) {
			$fragment = trim(array_pop($words));
			$chars += strlen($fragment);
	
			if($chars > $maxChars) break;
	
			$truncated[] = $fragment;
		}
	
		$result = implode($truncated, ' ');
	
		return $result . ($string == $result ? '' : '...');
	}
	
	/**
	 * Check if string is null or empty
	 * 
	 * @author Bruno Saliba <bsaliba at gmail dot com>
	 * @since 30 de jan de 2017 09:53:02
	 * @param string $question
	 * @return boolean
	 */
	public static function IsNullOrEmpty($question) {
		return (!isset($question) || trim($question) === '');
	}
	
	/**
	 * Left pad string
	 * 
	 * @author Bruno Saliba <bsaliba at gmail dot com>
	 * @since 30 de jan de 2017 09:53:32
	 * @param string $string
	 * @param number $length
	 * @param string $char
	 * @return string
	 */
	public static function lpad($string, $length, $char) {
		return str_pad($string, $length, $char, STR_PAD_LEFT);
	}
	
	/**
	 * Check if string starts with $needle
	 * 
	 * @author Bruno Saliba <bsaliba at gmail dot com>
	 * @since 30 de jan de 2017 09:54:16
	 * @param string $haystack
	 * @param string $needle
	 * @return boolean
	 */
	public static function startsWith($haystack, $needle) {
		return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== FALSE;
	}
	
	/**
	 * Check if string ends with $needle
	 * 
	 * @author Bruno Saliba <bsaliba at gmail dot com>
	 * @since 30 de jan de 2017 09:54:45
	 * @param string $haystack
	 * @param string $needle
	 * @return boolean
	 */
	public static function endsWith($haystack, $needle) {
		return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== FALSE);
	}
	
	/**
	 * Return first non null param
	 * 
	 * @author Bruno Saliba <bsaliba at gmail dot com>
	 * @since 30 de jan de 2017 09:56:53
	 * @return mixed|NULL
	 */
	public static function nvl() {
		$numargs = func_num_args();
		for($x = 0; $x < $numargs; $x++) {
			if(func_get_arg($x) !== null) {
				return func_get_arg($x);
			}
		}
		return null;
	}
	
	/**
	 * Trim string
	 * 
	 * @author Bruno Saliba <bsaliba at gmail dot com>
	 * @since 30 de jan de 2017 11:19:53
	 * @param unknown $string
	 * @return mixed
	 */
	public static function trim($string) {
		return preg_replace('/\s+/', '', $string);
	}
	
	/**
	 * Trim tabs
	 * 
	 * @author Bruno Saliba <bsaliba at gmail dot com>
	 * @since 30 de jan de 2017 11:20:12
	 * @param unknown $string
	 * @return mixed
	 */
	public static function trimTabs($string) {
		return preg_replace('/\\t+/', '', $string);
	}
}