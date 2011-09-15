<?php

namespace Moneybird\Invoice;

use Moneybird\Object;
use Moneybird\Exception\UnknownInvoiceStateException;

/**
 * Advanced filter for finding invoices
 *
 */
class Filter extends Object implements FilterInterface
{
	/**
	 * Constructor
	 *
	 * @access public
	 * @param DateTime $fromDate Start date
	 * @param DateTime $fromDate End date
	 * @param string|array $states States to search (draft|open|late|paid)
	 * @throws MoneybirdUnknownInvoiceStateException
	 */
	public function __construct(\DateTime $fromDate, \DateTime $toDate, $states)
	{
		$statesAvailable = array('draft', 'open', 'late', 'paid');

		$this->properties['from_date'] = $fromDate;
		$this->properties['to_date']   = $toDate;

		$this->properties['states'] = array();
		foreach ((array) $states as $state)
		{
			if (!in_array($state, $statesAvailable))
			{
				throw new UnknownInvoiceStateException('Unknown state for invoices: '.$state);
			}
			$this->properties['states'][] = $state;
		}
	}

	/**
	 * Load object from XML
	 *
	 * @access public
	 * @param SimpleXMLElement $xml
	 */
	public function fromXML(\SimpleXMLElement $xml)
	{
		throw new Exception(__CLASS__.' cannot be loaded from XML');
	}

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
			'<filter>',
			'</filter>'
		);
	}
}