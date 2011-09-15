<?php

namespace Moneybird;

/**
 * RecurringTemplate in Moneybird
 *
 */
class RecurringTemplate extends Object implements RecurringTemplateInterface
{
	/**
	 * Send frequency
	 *
	 * @const FREQUENCY_MONTH Send every month
	 */
	const FREQUENCY_MONTH = 2;

	/**
	 * Send frequency
	 *
	 * @const FREQUENCY_QUARTER Send every quarter
	 */
	const FREQUENCY_QUARTER = 3;

	/**
	 * Send frequency
	 *
	 * @const FREQUENCY_6MONTHS Send every 6 months
	 */
	const FREQUENCY_6MONTHS = 4;

	/**
	 * Send frequency
	 *
	 * @const FREQUENCY_YEAR Send every year
	 */
	const FREQUENCY_YEAR = 5;

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
			'details'  => 'MoneybirdRecurringTemplateLine',
		));
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
			'<recurring-template>',
			'</recurring-template>'
		);
	}

	/**
	 * Save template
	 *
	 * @return MoneybirdRecurringTemplate
	 * @access public
	 */
	public function save()
	{
		return $this->api->saveRecurringTemplate($this);
	}

	/**
	 * Delete template
	 *
	 * @access public
	 */
	public function delete()
	{
		$this->api->deleteRecurringTemplate($this);
	}
}