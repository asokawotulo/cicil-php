<?php

namespace Cicil;

use Cicil\Enums\ApiStatusEnum;
use Dotenv\Dotenv;

class PurchaseOrderTest extends TestCase
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

	public function testPurchaseOrder()
	{
		$params = [
			'transaction'  => [
				'total_amount' => 1_000_000,
				'transaction_id' => 'TEST-' . time(),
				'item_list' => [
					[
						'item_id' => '1',
						'name' => 'Test',
						'price' => 1_000_000,
						'quantity' => 1,
					]
				],
			],
			'buyer' => [
				'fullname' => 'John Doe',
				'email' => 'john.doe@mail.com',
				'phone' => '085322984060',
			],
			'shipment' => [
				'shipment_provider' => 'Provider',
				'name' => 'John Doe',
				'address' => 'GoWork Fatmawati',
				'city' => 'Jakarta Selatan',
				'postal_code' => '11630',
				'phone' => '085322984060',
			],
			'push_url' => 'https://api.tokocicil.com/update',
			'redirect_url' => 'https://toko.cicil.dev',
		];

		$checkout = PurchaseOrder::create($params);

		$this->assertArrayHasKey('message', $checkout);
		$this->assertArrayHasKey('po_number', $checkout);
		$this->assertArrayHasKey('status', $checkout);
		$this->assertArrayHasKey('url', $checkout);

		$this->assertEquals(ApiStatusEnum::SUCCESS, $checkout['status']);
	}

	public function testPurchaseOrderThrowsInvalidArgumentException()
	{
		$this->expectException(\InvalidArgumentException::class);

		PurchaseOrder::create([]);
	}
}