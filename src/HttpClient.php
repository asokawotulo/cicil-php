<?php

namespace Cicil;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Cicil\Common\Utils;
use Cicil\Cicil;

class HttpClient
{
	/**
	 * @var \GuzzleHttp\Client
	 */
	private $_guzzleClient;

	/**
	 * @return array
	 */
	public function request($method, $url, $params)
	{
		return json_decode($this->_requestRaw($method, $url, $params), true);
	}

	/**
	 * @return array
	 */
	private function _setDefaultHeaders()
	{
		$defaultHeaders = [];
		$defaultHeaders['Date'] = Utils::generateDate();

		return $defaultHeaders;
	}

	/**
	 * @return \Psr\Http\Message\StreamInterface
	 */
	private function _requestRaw($method, $url, $params)
	{
		$headers = $this->_setDefaultHeaders();
		$headers['Authorization'] = 'Basic ' . Utils::generateAuthorizationToken(
			Cicil::getApiKey(),
			Cicil::getMerchantId(),
			Cicil::getMerchantSecret(),
			$headers['Date'],
		);

		$response = $this->_guzzleClient()->request(
			$method,
			$url,
			[
				RequestOptions::JSON => $params,
				'headers' => $headers,
			]
		);

		return $response->getBody();
	}

	/**
	 * @return \GuzzleHttp\Client
	 */
	private function _guzzleClient()
	{
		if (!$this->_guzzleClient) {
			$this->_guzzleClient = new Client([
				'base_uri' => Cicil::getApiUrl()
			]);
		}

		return $this->_guzzleClient;
	}
}