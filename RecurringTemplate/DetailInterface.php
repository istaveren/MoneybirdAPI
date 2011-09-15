<?php

namespace Moneybird\RecurringTemplate;

use Moneybird\ObjectInterface;

/**
 * Interface for MoneybirdRecurringTemplateDetail
 *
 */
interface DetailInterface extends ObjectInterface
{
	/**
	 * Mark line for deletion
	 *
	 * @access public
	 */
	public function delete();
}