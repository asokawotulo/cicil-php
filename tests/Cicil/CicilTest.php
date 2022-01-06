<?php

namespace Cicil;

use Cicil\Cicil;
use Cicil\TestCase;

class CicilTest extends TestCase
{
	public function testApiUrlIsProductionByDefault()
	{
		$this->assertEquals(Cicil::PRODUCTION_URL, Cicil::getApiUrl(), 'Cicil API URL is production by default');
	}

	public function testSwitchEnvironments()
	{
		Cicil::setEnv(Cicil::SANDBOX);

		$this->assertEquals(Cicil::SANDBOX_URL, Cicil::getApiUrl(), 'Change environment to sandbox');

		Cicil::setEnv(Cicil::PRODUCTION);

		$this->assertEquals(Cicil::PRODUCTION_URL, Cicil::getApiUrl(), 'Change environment to production');
	}

	public function testThrowInvalidArgumentException()
	{
		$this->expectException(\InvalidArgumentException::class);

		Cicil::setEnv('');
	}

	public function testApiKey()
	{
		$apiKey = $_ENV['API_KEY'];

		Cicil::setApiKey($apiKey);

		$this->assertEquals($apiKey, Cicil::getApiKey());
	}

	public function testMerchantId()
	{
		$merchantId = $_ENV['MERCHANT_ID'];

		Cicil::setMerchantId($merchantId);

		$this->assertEquals($merchantId, Cicil::getMerchantId());
	}

	public function testMerchantSecret()
	{
		$merchantSecret = $_ENV['MERCHANT_SECRET'];

		Cicil::setMerchantSecret($merchantSecret);

		$this->assertEquals($merchantSecret, Cicil::getMerchantSecret());
	}
}
