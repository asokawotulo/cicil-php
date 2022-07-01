<?php

namespace Cicil;

class InstallmentSimulation
{
	use ApiOperations\Request;
	use ApiOperations\Create;

	public static function classUrl()
	{
		return 'po/mock-calculation';
	}

	public static function createRequiredParams()
	{
		return [
			'price',
			'dp',
			'tenure',
		];
	}
}