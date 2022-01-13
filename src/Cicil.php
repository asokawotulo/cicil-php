<?php

namespace Cicil;

class Cicil
{
	const SANDBOX = 'SANDBOX';
	const SANDBOX_URL = 'https://sandbox-api.cicil.dev/v1/';

	const PRODUCTION = 'PRODUCTION';
	const PRODUCTION_URL = 'https://api.cicil.co.id/v1/';

	/**
	 * @var string
	 */
	public static $apiUrl = self::PRODUCTION_URL;

	/**
	 * @var string
	 */
	public static $apiKey;

	/**
	 * @var string
	 */
	public static $merchantId;

	/**
	 * @var string
	 */
	public static $merchantSecret;

	/**
	 * Get API URL
	 * 
	 * @return string 
	 */
	public static function getApiUrl()
	{
		return self::$apiUrl;
	}

	/**
	 * Set API URL
	 * 
	 * @param string $apiUrl 
	 * @return void 
	 */
	public static function setApiUrl(string $apiUrl)
	{
		self::$apiUrl = $apiUrl;
	}

	/**
	 * Get API key
	 * 
	 * @return string
	 */
	public static function getApiKey()
	{
		return self::$apiKey;
	}

	/**
	 * Set API key
	 * 
	 * @param string $apiKey 
	 * @return void 
	 */
	public static function setApiKey(string $apiKey)
	{
		self::$apiKey = $apiKey;
	}

	/**
	 * Get merchant id
	 * 
	 * @return string
	 */
	public static function getMerchantId()
	{
		return self::$merchantId;
	}

	/**
	 * Set merchant id
	 * 
	 * @param string $merchantId 
	 * @return void 
	 */
	public static function setMerchantId(string $merchantId)
	{
		self::$merchantId = $merchantId;
	}

	/**
	 * Get merchant secret
	 * 
	 * @return string
	 */
	public static function getMerchantSecret()
	{
		return self::$merchantSecret;
	}

	/**
	 * Set merchant secret
	 * 
	 * @param string $merchantSecret 
	 * @return void 
	 */
	public static function setMerchantSecret(string $merchantSecret)
	{
		self::$merchantSecret = $merchantSecret;
	}

	/**
	 * Set environment
	 * 
	 * @param string $env 
	 * @return void 
	 * @throws \InvalidArgumentException 
	 */
	public static function setEnv(string $env)
	{
		$constant = __CLASS__ . '::' . $env . '_URL';

		if (!defined($constant))
			throw new \InvalidArgumentException('Invalid environment');
		
		self::setApiUrl(constant($constant));
	}


	/**
	 * Create purchase order
	 * 
	 * @param array $params 
	 * @return array 
	 */
	public static function createPurchaseOrder($params)
	{
		return PurchaseOrder::create($params);
	}

	/**
	 * Create notification
	 * 
	 * @param array $params
	 * @return array 
	 */
	public static function createNotification($params)
	{
		return Notification::create($params);
	}
}
