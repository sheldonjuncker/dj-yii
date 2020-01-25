<?php

namespace app\api\DreamAnalysis;

/**
 * Class Response
 *
 * All responses for Dream Analysis have these fields.
 *
 * @package app\api\DreamAnalysis
 */
class Response
{
	/** @var  int HTTP response code */
	public $code;

	/** @var  string The error message or NULL on success */
	public $error;

	/**
	 * Checks to see if the API request succeeded.
	 *
	 * @return bool
	 */
	public function isSuccess(): bool
	{
		return $this->code == 200;
	}
}