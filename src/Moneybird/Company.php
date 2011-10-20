<?php

namespace Moneybird;

/**
 * Contact in Moneybird
 *
 */
class Company extends Object implements CompanyInterface
{
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
	 * Save company
	 *
	 * @return MoneybirdCompany
	 * @access public
	 */
	public function save()
	{
		return $this->api->saveSettings($this);
	}
}