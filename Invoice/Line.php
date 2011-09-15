<?php

namespace Moneybird\Invoice;

/**
 * InvoiceLine in Moneybird
 *
 */
class Line extends Detail
{
	/**
	 * Line is marked for deletion
	 * @var bool
	 */
	protected $deleted = false;

	/**
	 * Load object from XML
	 *
	 * @access public
	 * @param SimpleXMLElement $xml
	 */
	public function fromXML(\SimpleXMLElement $xml)
	{
		parent::fromXML($xml);
		$this->amount = $this->amount_plain;
	}

	/**
	 * Convert to XML string
	 *
	 * @access public
	 * @return string
	 */
	public function toXML()
	{
		$keyOpen  = '<detail type="InvoiceDetail"';
		if ($this->deleted)
		{
			$keyOpen .= ' _destroy="1"';
		}
		$keyOpen .= '>';

		return parent::toXML(
			null,
			$keyOpen,
			'</detail>',
			array(
				'total_price_excl_tax',
				'total_price_incl_tax',
				'amount_plain',
			)
		);
	}

	/**
	 * Mark line for deletion
	 *
	 * @access public
	 */
	public function delete()
	{
		$this->deleted = true;
	}
}