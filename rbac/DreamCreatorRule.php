<?php

namespace app\rbac;

use app\models\dj\Dream;
use yii\rbac\Rule;

/**
 * Class DreamCreatorRule
 *
 * Checks if the dream belongs to the user.
 *
 * @package app\rbac
 */
class DreamCreatorRule extends Rule
{
	public $name = 'isDreamCreator';

	public function execute($user, $item, $params)
	{
		$dream = $params['dream'] ?? NULL;
		if(!$dream instanceof Dream)
		{
			//If there is no dream associated, you can do it (create, index, etc.)
			return true;
		}
		else
		{
			//There is a dream, you must own it.
			return $dream->user_id == $user;
		}
	}
}