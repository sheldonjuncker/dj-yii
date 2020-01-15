<?php


namespace app\components\gui\flash;

/**
 * Class FlashContainer
 *
 * Container for flashes used to render flash messages in the main layout.
 *
 * @package app\gui\flash
 */
class FlashContainer
{
	/** @var IFlash[] $flashes */
	protected $flashes = [];

	/**
	 * FlashContainer constructor.
	 *
	 * You can pass in the flashes from another container when initializing a new one.
	 * Why you'd want to do this, I don't know.
	 *
	 * @param array $flashes
	 */
	public function __construct(array $flashes = [])
	{
		foreach($flashes as $flash)
		{
			$this->addFlash($flash);
		}
	}

	public function addFlash(IFlash $flash)
	{
		$key = $flash->getMessage();
		if(!isset($this->flashes[$key]))
		{
			//Add flash
			$this->flashes[$key] = $flash;
		}
		else if($this->flashes[$key]->getType() < $flash->getType())
		{
			//Replace flash if the new type is of a greater severity
			unset($this->flashes[$key]);
			$this->flashes[$key] = $flash;
		}
	}

	/**
	 * Gets all of the flashes.
	 *
	 * @return IFlash[]
	 */
	public function getFlashes(): array
	{
		return $this->flashes;
	}

	/**
	 * Removes a flash and returns it.
	 *
	 * @param IFlash $flash
	 */
	public function removeFlash(IFlash $flash)
	{
		$key = $flash->getMessage();
		unset($this->flashes[$key]);
	}

	/**
	 * Clears all flashes.
	 */
	public function clear()
	{
		$this->flashes = [];
	}
}