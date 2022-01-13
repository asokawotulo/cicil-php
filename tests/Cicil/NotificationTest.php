<?php

namespace Cicil;

use Dotenv\Dotenv;

class NotificationTest extends TestCase
{
	protected function setUp(): void
	{
		$dotenv = Dotenv::createImmutable(__DIR__ . '/../..');
		$dotenv->load();

		Cicil::setEnv(Cicil::SANDBOX);
		Cicil::setApiKey($_ENV['API_KEY']);
		Cicil::setMerchantId($_ENV['MERCHANT_ID']);
		Cicil::setMerchantSecret($_ENV['MERCHANT_SECRET']);
	}

	protected function tearDown(): void
	{
		Cicil::setEnv(Cicil::PRODUCTION);
	}


	public function testNotificationThrowsInvalidArgumentexception()
	{
		$this->expectException(\InvalidArgumentException::class);

		Notification::create([]);
	}
}