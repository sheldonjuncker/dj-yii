<?php

namespace app\components\gui\flash;

/**
 * Class Flash
 *
 * The base flash class.
 *
 * @package app\gui\flash
 */
class Flash implements IFlash
{
	const SUCCESS = 0;
	const INFO = 1;
	const WARNING = 2;
	const FAILURE = 3;

	protected $message;
	protected $type;

	public function __construct(string $message, int $type)
	{
		$this->message = $message;
		$this->type = $type;
	}

	public function getMessage(): string
	{
		return $this->message;
	}

	public function getType(): int
	{
		return $this->type;
	}

	/**
	 * Gets the HTML class to be used to display this flash message.
	 *
	 * @return string
	 */
	public function getHtmlClass(): string
	{
		$classMap = [
			self::SUCCESS => 'success',
			self::INFO => 'info',
			self::WARNING => 'warning',
			self::FAILURE => 'danger'
		];

		return $classMap[$this->getType()];
	}
}