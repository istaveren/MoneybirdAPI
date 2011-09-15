<?php

namespace Moneybird\Invoice;

use Moneybird\Exception\UnknownSendMethodException;

/**
 * InvoiceSendInformation for Moneybird
 *
 */
class SendInformation extends Detail
{
	/**
	 * Constructor
	 *
	 * @access public
	 * @param string $sendMethod (email|post|hand)
	 * @param string $email Address to send to
	 * @param string $message Message in mail body
	 * @throws MoneybirdUnknownSendMethodException
	 */
	public function __construct($sendMethod='email', $email=null, $message=null)
	{
		if (!in_array($sendMethod, array('hand', 'email', 'post')))
		{
			throw new UnknownSendMethodException('Unknown send method: '.$sendMethod);
		}
		$this->properties['sendMethod'] = $sendMethod;

		if ($sendMethod == 'email')
		{
			$this->properties['email']   = $email;
			$this->properties['message'] = $message;
		}
	}

	/**
	 * Convert to XML string
	 *
	 * @access public
	 * @return string
	 */
	public function toXML()
	{
		$xml  = '<invoice>'.PHP_EOL;
		$xml .= '   <send-method>'.$this->properties['sendMethod'].'</send-method>'.PHP_EOL;
		if (!empty($this->properties['email']))
		{
			$xml .= '   <email>'.htmlspecialchars($this->properties['email']).'</email>'.PHP_EOL;
		}
		if (!empty($this->properties['message']))
		{
			$xml .= '   <invoice-email>'.htmlspecialchars($this->properties['message']).'</invoice-email>'.PHP_EOL;
		}
		$xml .= '</invoice>'.PHP_EOL;

		return $xml;
	}

	/**
	 * Load object from XML
	 *
	 * @access public
	 * @param SimpleXMLElement $xml
	 */
	public function fromXML(\SimpleXMLElement $xml)
	{
		throw new \Exception(__CLASS__.' cannot be loaded from XML');
	}
}