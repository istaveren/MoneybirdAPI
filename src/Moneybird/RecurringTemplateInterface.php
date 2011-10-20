<?php

namespace Moneybird;

/**
 * Interface for MoneybirdRecurringTemplate
 *
 */
interface RecurringTemplateInterface extends ObjectInterface
{
	/**
	 * Set a reference to the Api
	 *
	 * @param MoneybirdApi $api
	 * @access public
	 */
	public function setApi(Api $api);
}