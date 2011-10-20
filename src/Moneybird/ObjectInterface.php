<?php

namespace Moneybird;

/**
 * Interface for MoneybirdObject
 *
 */
interface ObjectInterface
{
	/**
	 * Fill with XML
	 *
	 * @access public
	 * @param SimpleXMLElement $xml
	 */
	public function fromXML(\SimpleXMLElement $xml);

	/**
	 * Convert to XML string
	 *
	 * @access public
	 * @return string
	 */
	public function toXML();
}