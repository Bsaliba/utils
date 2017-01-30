<?php

namespace Utils;

/**
 * Class Utils$DateUtils
 * @author Bruno Saliba <bsaliba at gmail dot com>
 */
class DateUtils {
	
	/**
	 * Get last day of month
	 * 
	 * @author Bruno Saliba <bsaliba at gmail dot com>
	 * @since 30 de jan de 2017 11:04:45
	 * @param number $month
	 * @param number $year
	 * @return string
	 */
	public static function getLastDayMonth($month, $year) {
		$dt = \DateTime::createFromFormat('Y-m-d H:i:s', $year . '-' . $month . '-01 00:00:00');
		$dt->modify('last day of this month');
		return $dt;
	}
	
	/**
	 * Get month name
	 * 
	 * @author Bruno Saliba <bsaliba at gmail dot com>
	 * @since 30 de jan de 2017 11:13:29
	 * @param number $month
	 * @return string
	 */
	public static function getMonthName($month) {
		$dt = \DateTime::createFromFormat('Y-m-d H:i:s', date("Y-") . self::lpad($month, 2, '0') . "-01 00:00:00");
	
		$df = new \IntlDateFormatter(
				str_replace('-', '_', \Locale::getDefault()), // string locale
				\IntlDateFormatter::NONE, // int date type
				\IntlDateFormatter::NONE, // int time type
				$dt->getTimezone(), // string timezone
				\IntlDateFormatter::GREGORIAN, // int cal type
				'MMMM' // string pattern
				);
	
		return $df->format($dt);
	}
	
	/**
	 * Get current datetime
	 * 
	 * @author Bruno Saliba <bsaliba at gmail dot com>
	 * @since 30 de jan de 2017 11:14:31
	 * @return unknown
	 */
	public static function now() {
		$now = new \DateTime();
	}
	
	/**
	 * Get today datetime
	 * 
	 * @author Bruno Saliba <bsaliba at gmail dot com>
	 * @since 30 de jan de 2017 11:15:21
	 * @return \DateTime
	 */
	public static function today() {
		return new \DateTime('today');
	}
	
	/**
	 * Get yesterday datetime
	 *
	 * @author Bruno Saliba <bsaliba at gmail dot com>
	 * @since 30 de jan de 2017 11:15:21
	 * @return \DateTime
	 */
	public static function yesterday() {
		return new \DateTime('yesterday');
	}
	
	/**
	 * Get tomorrow datetime
	 *
	 * @author Bruno Saliba <bsaliba at gmail dot com>
	 * @since 30 de jan de 2017 11:15:21
	 * @return \DateTime
	 */
	public static function tomorrow() {
		return new \DateTime('tomorrow');
	}
	
	/**
	 * Create datetime from webservice date
	 * 
	 * @author Bruno Saliba <bsaliba at gmail dot com>
	 * @since 30 de jan de 2017 11:16:20
	 * @param unknown $date
	 * @return unknown
	 */
	public static function getDatetimeFromWSDate($date) {
		return \DateTime::createFromFormat('Y-m-d', $date);
	}
}
