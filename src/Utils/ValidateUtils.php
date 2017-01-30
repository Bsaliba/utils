<?php

namespace Utils;

/**
 * Class Utils$ValidateUtils
 * @author Bruno Saliba <bsaliba at gmail dot com>
 */
class ValidateUtils {
	
	/**
	 * Validate phone number
	 * 
	 * @author Bruno Saliba <bsaliba at gmail dot com>
	 * @since 30 de jan de 2017 11:38:00
	 * @param unknown $phone
	 * @return number
	 */
	public static function validatePhone($phone) {
		return preg_match("/^\d{10,11}$/i", StringUtils::removeNonNumericChars($phone));
	}
	
	/**
	 * Validate CEP
	 * 
	 * @author Bruno Saliba <bsaliba at gmail dot com>
	 * @since 30 de jan de 2017 11:39:27
	 * @param unknown $cep
	 * @return number
	 */
	public static function validateCep($cep) {
		return preg_match("/^\d{8}$/i", StringUtils::removeNonNumericChars($cep));
	}
	
	/**
	 * Validate Cpf
	 * 
	 * @author Bruno Saliba <bsaliba at gmail dot com>
	 * @since 30 de jan de 2017 11:39:48
	 * @param unknown $cpf
	 * @return boolean
	 */
	public static function validateCpf($cpf) {
		$cpf = str_pad(preg_replace('/[^0-9]/', '', $cpf), 11, '0', STR_PAD_LEFT);
	
		if(strlen($cpf) != 11 || $cpf == '00000000000' || $cpf == '11111111111' ||$cpf == '22222222222' ||
				$cpf == '33333333333' || $cpf == '44444444444' || $cpf == '55555555555' || $cpf == '66666666666' ||
				$cpf == '77777777777' || $cpf == '88888888888' || $cpf == '99999999999') {
			return false;
		} else {
			for($t = 9; $t < 11; $t++) {
				for($d = 0, $c = 0; $c < $t; $c++) {
					$d += $cpf{$c} * (($t + 1) - $c);
				}

				$d = ((10 * $d) % 11) % 10;

				if($cpf{$c} != $d) {
					return false;
				}
			}

			return true;
		}
	}
	
	/**
	 * Validate Cnpj
	 * 
	 * @author Bruno Saliba <bsaliba at gmail dot com>
	 * @since 30 de jan de 2017 11:43:05
	 * @return boolean
	 */
	public static function validateCnpj() {
		$verCNPJ = 0;
		$ind = 2;
		
		for($y = $x; $y>0; $y--) {
			$verCNPJ += (int) substr($cnpj, $y - 1, 1) * $ind;
			if ($ind > 8) {
				$ind = 2;
			} else {
				$ind++;
			}
		}
		
		$verCNPJ %= 11;
		if($verCNPJ == 0 || $verCNPJ == 1) {
			$verCNPJ = 0;
		} else {
			$verCNPJ = 11 - $verCNPJ;
		}
		
		if($verCNPJ != (int) substr($cnpj, $x, 1)) {
			return false;
		} else {
			return true;
		}
	}
}
