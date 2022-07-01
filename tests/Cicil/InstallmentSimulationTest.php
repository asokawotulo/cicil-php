<?php

namespace Cicil;

use Cicil\Enums\ApiStatusEnum;
use Dotenv\Dotenv;

class InstallmentSimulationTest extends TestCase
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

	public function testInstallmentSimulation()
	{
		$params = [
			'price' => 5000000,
			'dp' => 0,
			'tenure' => 0,
		];

		$simulation = InstallmentSimulation::create($params);

		$this->assertArrayHasKey('dp', $simulation);
		$this->assertArrayHasKey('tenure', $simulation);
		$this->assertArrayHasKey('installment', $simulation);

		$this->assertEquals(ApiStatusEnum::SUCCESS, $simulation['status']);
	}

	public function testInstallmentSimulationThrowsInvalidArgumentException()
	{
		$this->expectException(\InvalidArgumentException::class);

		InstallmentSimulation::create([]);
	}
}