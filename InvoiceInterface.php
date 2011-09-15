<?php

namespace Moneybird;

/**
 * Interface for MoneybirdInvoice
 *
 */
interface InvoiceInterface extends ObjectInterface
{
	/**
	 * Set a reference to the Api
	 *
	 * @param MoneybirdApi $api
	 * @access public
	 */
	public function setApi(Api $api);

	/**
	 * Copy info from contact to invoice
	 *
	 * @access public
	 * @param iMoneybirdContact $contact
	 */
	public function setContact(ContactInterface $contact);
}