<?php

namespace app\utilities\date;

/**
 * Class MysqlFormatter
 *
 * Utility for formatting dates for usage with MySQL.
 *
 * @package app\utilities\date
 */
class MysqlFormatter
{
	/**
	 * Converts a date to be used in a MySQL query.
	 *
	 * @param $date
	 * @return string
	 */
	public static function toMysql($date): string
	{
		if(is_int($date))
		{
			$timestamp = $date;
		}
		else if($date instanceof \DateTime)
		{
			$timestamp = $date->getTimestamp();
		}
		else
		{
			$timestamp = strtotime($date);
		}

		return date("Y-m-d H:i:s", $timestamp);
	}
}