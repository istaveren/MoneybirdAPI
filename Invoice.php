<?php

namespace Moneybird;

use Moneybird\Invoice\SendInformation;
use Moneybird\Invoice\Payment;

/**
 * Invoice in Moneybird
 *
 */
class Invoice extends Object implements InvoiceInterface
{
	/**
	 * Api object
	 *
	 * @access private
	 * @var MoneybirdApi
	 */
	private $api;

	/**
	 * Set a reference to the Api
	 *
	 * @param MoneybirdApi $api
	 * @access public
	 */
	public function setApi(Api $api)
	{
		$this->api = $api;
	}

	/**
	 * Load object from XML
	 *
	 * @access public
	 * @param SimpleXMLElement $xml
	 */
	public function fromXML(\SimpleXMLElement $xml)
	{
		parent::fromXML($xml, array(
			'history'  => 'Moneybird\Invoice\HistoryItem',
			'payments' => 'Moneybird\Invoice\Payment',
			'details'  => 'Moneybird\Invoice\Line',
		));
		$this->pdf = $this->url.'.pdf';
	}

	/**
	 * Convert object to XML
	 *
	 * @access public
	 * @return string
	 */
	public function toXML()
	{
		return parent::toXML(
			array(
				'details' => 'details_attributes',
			),
			null,
			null,
			array('pdf', 'history', 'payments')
		);
	}

	/**
	 * Copy info from contact to invoice
	 *
	 * @access public
	 * @param iMoneybirdContact $contact
	 */
	public function setContact(ContactInterface $contact)
	{
		$this->contact_id = $contact->id;
		foreach ($contact->getProperties() as $property => $value)
		{
			$this->$property = $value;
		}
	}

	/**
	 * Save invoice
	 *
	 * @return MoneybirdInvoice
	 * @access public
	 */
	public function save()
	{
		return $this->api->saveInvoice($this);
	}

	/**
	 * Delete invoice
	 *
	 * @access public
	 */
	public function delete()
	{
		$this->api->deleteInvoice($this);
	}

	/**
	 * Send an invoice
	 *
	 * @access public
	 * @param MoneybirdInvoiceSendInformation optional $sendinfo information to send invoice
	 */
	public function send(SendInformation $sendinfo = null)
	{
		$this->api->sendInvoice($this, $sendinfo);
	}

	/**
	 * Send a reminder
	 *
	 * @access public
	 * @param MoneybirdInvoiceSendInformation optional $sendinfo information to send reminder
	 */
	public function remind(SendInformation $sendinfo = null)
	{
		$this->api->sendInvoiceReminder($this, $sendinfo);
	}

	/**
	 * Mark invoice as send
	 *
	 * @access public
	 */
	public function markAsSent()
	{
		$this->send(new SendInformation('hand'));
	}

	/**
	 * Register invoice payment
	 *
	 * @access public
	 * @param MoneybirdInvoicePayment $payment payment to register
	 */
	public function registerPayment(Payment $payment)
	{
		$this->api->registerInvoicePayment($this, $payment);
	}

	/**
	 * Get invoice as PDF
	 *
	 * @access public
	 */
	public function getPdf()
	{
		return $this->api->getInvoicePdf($this);
	}
}