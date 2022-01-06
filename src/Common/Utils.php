<?php

namespace Cicil\Common;

use DateTime;
use DateTimeZone;

class Utils
{
	public static function generateAuthorizationToken(
		$apiKey,
		$merchantId,
		$merchantSecret,
		$date
	)
	{
		$digest = hash_hmac('sha256', $merchantSecret . $date, $apiKey);
		$token = base64_encode($merchantId . ':' . $digest);

		return $token;
	}

	public static function getArrayByPath($array, $path, $seperator = '.')
	{
		$keys = explode($seperator, $path);

		foreach ($keys as $key) {
			$array = $array[$key] ?? null;
		}

		return $array;
	}

	public static function generateDate($datetime = 'now')
	{
		return (new DateTime($datetime, new DateTimeZone('GMT')))->format('D, d M Y H:i:s e');
		// return date('D, d M Y H:i:s') . ' GMT';
	}
}