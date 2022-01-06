<?php

namespace Cicil;

use Cicil\Common\Utils;

class UtilTest extends TestCase
{
	public function testGenerateAuthorizationToken()
	{
		$apiKey = 'dMUXDj7vf7hvkgkB6Zu0ZTPtzMYS6wEnj2nmNyWa';
		$merchantId = 'tokocicil';
		$merchantSecret = 'www.tokocicil.com';
		$date = Utils::generateDate('12-11-2018 10:00:00');
		
		$authorizationToken = Utils::generateAuthorizationToken(
			$apiKey,
			$merchantId,
			$merchantSecret,
			$date
		);

		$this->assertEquals(
			'dG9rb2NpY2lsOjUyNTUwNWVlYzFmYzIyMzUwYjJkZDI0N2ViZTE1YTY5NzMyMTE2ZmE1Y2EzMjhjYWIxN2U0N2M3MDFmMjBkNzE=',
			$authorizationToken
		);
	}

	public function testGetArrayByPath()
	{
		$array = [
			'foo' => [
				'bar' => 'foobar',
			],
		];

		$this->assertEquals(
			$array['foo']['bar'],
			Utils::getArrayByPath($array, 'foo.bar')
		);
	}

	public function testGenerateDate()
	{
		$datetimes = [
			'24-12-2021 15:31:23' => 'Fri, 24 Dec 2021 15:31:23 GMT',
			'1-1-2022 09:01:02' => 'Sat, 01 Jan 2022 09:01:02 GMT',
			'15-6-2021 12:59:59' => 'Tue, 15 Jun 2021 12:59:59 GMT',
		];

		foreach ($datetimes as $datetime => $expected) {
			$this->assertEquals($expected, Utils::generateDate($datetime));
		}

	}
}
