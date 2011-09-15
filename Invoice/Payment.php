<?php

namespace Moneybird\Invoice;

/**
 * InvoicePayment in Moneybird
 *
 */
class Payment extends Detail
{
	/**
	 * Convert to XML string
	 *
	 * @access public
	 * @return string
	 */
	public function toXML()
	{
		return parent::toXML(
			null,
			'<invoice_payment>',
			'</invoice_payment>',
			array('invoice_id')
		);
	}
}