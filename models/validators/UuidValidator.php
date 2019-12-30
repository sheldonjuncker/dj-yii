<?php


namespace app\models\validators;

use Rhumsaa\Uuid\Uuid;
use yii\validators\Validator;

/**
 * Class UuidValidator
 *
 * Performs validation of UUID fields.
 *
 * @package app\models\validators
 */
class UuidValidator extends Validator
{
	//By default we need to run this validator so that we can auto-generate the new ID
	public $skipOnEmpty = false;
	public $allowEmpty = true;
	public $generateOnEmpty = false;

	public function validateAttribute($model, $attribute)
	{
		$value = $model->$attribute;

		if(!$value)
		{
			if($this->generateOnEmpty)
			{
				$model->$attribute = Uuid::uuid1()->getBytes();
			}
			else if(!$this->allowEmpty)
			{
				$this->addError($model, $attribute, 'Missing UUID');
			}
		}
		else
		{
			try
			{
				$uuid = Uuid::fromBytes($value);
			}
			catch(\InvalidArgumentException $e)
			{
				$this->addError($model, $attribute, 'Invalid UUID');
			}
		}
	}

	public function isUuid(string $data): bool
	{
		return preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/', $data);
	}

	public function formatFromDataSource($data): string
	{
		//Don't format if it's empty
		if(!$data)
		{
			return $data;
		}

		//If the data is coming to us as UUID, we are good
		if($this->isUuid($data))
		{
			return $data;
		}
		else
		{
			//Attempt to convert from a binary string to hex
			$hex = bin2hex($data);
			$hex = str_pad($hex, '32', '0', STR_PAD_LEFT);
			return
				substr($hex, 0, 8) .
				'-' .
				substr($hex, 8, 4) .
				'-' .
				substr($hex, 12, 4) .
				'-' .
				substr($hex, 16, 4) .
				'-' .
				substr($hex, 20, 12)
				;
		}
	}

	public function formatToDataSource($data): string
	{
		if($this->isUuid($data))
		{
			$hex = str_replace('-', '', $data);
			return hex2bin($hex);
		}
		else
		{
			return (string) $data;
		}
	}
}