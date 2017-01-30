<?php

namespace Utils;

use Zend\Crypt\Key\Derivation\Scrypt;
use Ramsey\Uuid\Uuid;

/**
 * Class Utils$CryptUtils
 * @author Bruno Saliba <bsaliba at gmail dot com>
 */
class CryptUtils {
	
	/**
	 * Encrypt string with salt
	 * 
	 * @author Bruno Saliba <bsaliba at gmail dot com>
	 * @since 30 de jan de 2017 10:03:06
	 * @param string $password
	 * @param string $salt
	 * @return string
	 */
	public static function crypt($password, $salt) {
		return bin2hex(Scrypt::calc($password, $salt, 2048, 2, 1, 32));
	}
	
	/**
	 * Generate unique identifier
	 * 
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 01/02/2016 16:32:00
	 * @param int $length
	 * @return string
	 */
	public static function generateUuid($length = 20) {
		if(function_exists('openssl_random_pseudo_bytes')) {
			return substr(bin2hex(openssl_random_pseudo_bytes($length)), 0, $length);
		}
		
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$randomString = '';
		for($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, strlen($characters) - 1)];
		}
		return $randomString;
	}
	
	/**
	 * Generate Uuid4 hash
	 * 
	 * @author Bruno Saliba <bsaliba at gmail dot com>
	 * @since 30 de jan de 2017 10:38:05
	 * @return string
	 */
	public static function uuid4() {
		$uuid4 = Uuid::uuid4();
		return $uuid4->toString();
	}
	
	/**
	 * Generate compatible Oauth2 Access Token
	 * 
	 * @author Bruno Saliba <bsaliba at gmail dot com>
	 * @since 30 de jan de 2017 10:04:36
	 * @return string|unknown
	 */
	public static function generateAccessToken() {
		if(function_exists('mcrypt_create_iv')) {
			$randomData = mcrypt_create_iv(20, MCRYPT_DEV_URANDOM);
			if ($randomData !== false && strlen($randomData) === 20) {
				return bin2hex($randomData);
			}
		}
		if(function_exists('openssl_random_pseudo_bytes')) {
			$randomData = openssl_random_pseudo_bytes(20);
			if ($randomData !== false && strlen($randomData) === 20) {
				return bin2hex($randomData);
			}
		}
		if(@file_exists('/dev/urandom')) { // Get 100 bytes of random data
			$randomData = file_get_contents('/dev/urandom', false, null, 0, 20);
			if ($randomData !== false && strlen($randomData) === 20) {
				return bin2hex($randomData);
			}
		}
		// Last resort which you probably should just get rid of:
		$randomData = mt_rand() . mt_rand() . mt_rand() . mt_rand() . microtime(true) . uniqid(mt_rand(), true);
	
		return substr(hash('sha512', $randomData), 0, 40);
	}
}