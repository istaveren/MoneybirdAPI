<?php

namespace Moneybird;

/**
 * Interface for MoneybirdCompany
 *
 */
interface CompanyInterface extends ObjectInterface
{
	/**
	 * Set a reference to the Api
	 *
	 * @param MoneybirdApi $api
	 * @access public
	 */
	public function setApi(Api $api);
}