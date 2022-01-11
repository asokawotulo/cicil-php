<?php

namespace Cicil\Enums;

class PurchaseOrderStatusEnum
{
	/**
	 * User has not completed the transaction
	 * 
	 * @var string
	 */
	const PENDING = 'pending';

	/**
	 * User has checked out the order. Waiting for user pay the downpayment
	 * 
	 * @var string
	 */
	const WAITING_DOWNPAYMENT = 'waiting_downpayment';

	/**
	 * User has completed the transaction
	 * 
	 * @var string
	 */
	const COMPLETED = 'completed';

	/**
	 * Transaction has been cancelled by merchant
	 * 
	 * @var string
	 */
	const CANCEL = 'cancel';
}