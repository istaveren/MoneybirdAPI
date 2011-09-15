<?php

namespace Moneybird;

/**
 * Interface for MoneybirdContact
 *
 */
interface ContactInterface extends ObjectInterface
{
	/**
	 * Set a reference to the Api
	 *
	 * @param MoneybirdApi $api
	 * @access public
	 */
	public function setApi(Api $api);

	/**
	 * Set all properties
	 *
	 * @param array $data
	 * @access public
	 */
	public function setProperties(array $data);

	/**
	 * Get all properties
	 *
	 * @return array
	 * @access public
	 */
	public function getProperties();
}