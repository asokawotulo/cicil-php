<?php

namespace Cicil\ApiOperations;

use Cicil\Common\Utils;
use Cicil\HttpClient;

trait Request
{
	public static function validateParams($params, $requiredParams)
	{
		if (!is_array($params)) {
			$message = 'Parameters must be an array';
			throw new \InvalidArgumentException($message);
		}

		foreach ($requiredParams as $param) {
			$value = Utils::getArrayByPath($params, $param);
			if (is_null($value)) {
				$message = "{$param} is required";
				throw new \InvalidArgumentException($message);
			}
		}
	}

	protected static function _request($method, $url, $params = [])
	{
		$httpClient = new HttpClient();

		return $httpClient->request($method, $url, $params);
	}
}