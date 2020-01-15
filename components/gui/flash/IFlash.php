<?php

namespace app\components\gui\flash;

/**
 * Interface IFlash
 *
 * The flash interface.
 *
 * @package app\gui\flash
 */
interface IFlash
{
	public function getMessage(): string;
	public function getType(): int;
	public function getHtmlClass(): string;
}