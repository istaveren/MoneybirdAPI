<?php

namespace Moneybird;

use Moneybird\Exception\ItemNotFoundException;

/**
 * Contact in Moneybird
 *
 */
class Contact extends Object implements ContactInterface
{
    /**
     * Get all valid properties for contact
     * 
     * @see http://www.moneybird.nl/api/contact
     * @return array
     */
    public function getValidProperties()
    {
      return array(
        'company_name', 'firstname', 'lastname', 'attention', 'address1', 'address2', 
        'zipcode', 'city', 'country', 'customer_id', 'email', 'created_at', 'tax_number',
        'updated_at',
      );
    }
    
	/**
	 * Api object
	 *
	 * @access private
	 * @var MoneybirdApi
	 */
	protected $api;

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
	 * Set all properties
	 *
	 * @param array $data
	 * @return MoneybirdContact
	 * @access public
	 */
	public function setProperties(array $data)
	{
		$properties = $this->getValidProperties();

		foreach ($properties as $property)
		{
			$this->$property = isset($data[$property])?$data[$property]:'';
		}

		return $this;
	}

	/**
	 * Get all properties
	 *
	 * @return array
	 * @access public
	 */
	public function getProperties()
	{
		$properties = $this->getValidProperties();

		$return = array();
		foreach ($properties as $property)
		{
			$return[$property] = $this->$property;
		}

		return $return;
	}

	/**
	 * Get invoice
	 *
	 * @param integer $invoiceID invoice to retreive
	 * @return MoneybirdInvoice
	 * @access public
	 * @throws MoneybirdInvalidIdException
	 * @throws MoneybirdItemNotFoundException
	 */
	public function getInvoice($invoiceID)
	{
		$invoice = $this->api->getInvoice($invoiceID);
		if ($invoice->contact_id != $this->id)
		{
			throw new ItemNotFoundException('The entity or action is not found in the API');
		}
		return $invoice;
	}

	/**
	 * Get an invoice by invoice ID
	 *
	 * @param string $invoiceID
	 * @return MoneybirdInvoice
	 * @access public
	 * @throws MoneybirdItemNotFoundException
	 */
	public function getInvoiceByInvoiceId($invoiceID)
	{
		$invoice = $this->api->getInvoiceByInvoiceId($invoiceID);
		if ($invoice->contact_id != $this->id)
		{
			throw new ItemNotFoundException('The entity or action is not found in the API');
		}
		return $invoice;
	}

	/**
	 * Get all invoices of contact
	 *
	 * @return array
	 * @param string|iMoneybirdFilter $filter optional, filter to apply
	 * @access public
	 * @throws MoneybirdUnknownFilterException
	 */
	public function getInvoices($filter=null)
	{
		return $this->api->getInvoices($filter, $this);
	}

	/**
	 * Create a new invoice
	 *
	 * @return MoneybirdInvoice
	 * @access public
	 */
	public function createInvoice()
	{
		list($typegroup, $class) = $this->api->typeInfo('invoice');
		$invoice = new $class;
		$invoice->setApi($this->api);
		$invoice->setContact($this);
		return $invoice;
	}

	/**
	 * Save invoice
	 *
	 * @return MoneybirdInvoice
	 * @param iMoneybirdInvoice $invoice invoice to save
	 * @access public
	 */
	public function saveInvoice(InvoiceInterface $invoice)
	{
		if (intval($invoice->contact_id) == 0)
		{
			$invoice->setContact($this);
		}
		return $this->api->saveInvoice($invoice);
	}

	/**
	 * Get all templates for recurring invoices
	 *
	 * @return array
	 * @access public
	 */
	public function getRecurringTemplates()
	{
		return $this->api->getRecurringTemplates($this);
	}

	/**
	 * Save template for recurring invoices
	 *
	 * @return MoneybirdRecurringTemplate
	 * @param iMoneybirdRecurringTemplate $template template to save
	 * @access public
	 */
	public function saveRecurringTemplate(RecurringTemplateInterface $template)
	{
		if (intval($template->contact_id) == 0)
		{
			$template->contact_id = $this->id;
		}
		return $this->api->saveRecurringTemplate($template);
	}

	/**
	 * Save contact
	 *
	 * @return MoneybirdContact
	 * @access public
	 */
	public function save()
	{
		return $this->api->saveContact($this);
	}

	/**
	 * Delete contact
	 *
	 * @access public
	 */
	public function delete()
	{
		$this->api->deleteContact($this);
	}

	/**
	 * Get all invoices that need a reminder
	 *
	 * Example:
	 * $invoices = $api->getRemindableInvoices(array(
	 *	 'Herinnering' => 10,
	 *	 'Tweede herinnering' => 10,
	 *	 'Aanmaning' => 10,
	 *	 'Deurwaarder' => 0,
	 * ));
	 *
	 * @access public
	 * @return array
	 * @param array $documentDays Associative array with document titles as keys and days since last document as value
	 * @param DateTime $now
	 */
	public function getRemindableInvoices(array $documentDays, \DateTime $now = null)
	{
		return $this->api->getRemindableInvoices($documentDays, $now, $this);
	}
}