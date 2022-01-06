<?php

namespace Cicil;

class PurchaseOrder
{
	use ApiOperations\Request;
	use ApiOperations\Create;

	public static function classUrl()
	{
		return 'po';
	}

	public static function createRequiredParams()
	{
		return [
			'transaction.total_amount',
			'transaction.transaction_id',
			'transaction.item_list',
			'buyer.fullname',
			'buyer.email',
			'buyer.phone',
			'shipment.shipment_provider',
			'shipment.name',
			'shipment.address',
			'shipment.city',
			'shipment.postal_code',
			'shipment.phone',
			'push_url',
			'redirect_url',
		];
	}
}