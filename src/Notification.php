<?php

namespace Cicil;

class Notification
{
	use ApiOperations\Request;
	use ApiOperations\Create;

	public static function classUrl()
	{
		return 'po/notify';
	}


	public static function createRequiredParams()
	{
		return [
			'po_number',
			'po_status',
			'transaction_id',
		];
	}
}