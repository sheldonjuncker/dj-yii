<?php

namespace app\models\data;

use app\models\dj\Dream;
use app\models\dj\User;
use yii\base\Model;

class ExportForm extends Model
{
	/** @var  User|null $user */
	public $user;

	public $format;
	public $start_date;
	public $end_date;

	/**
	 * @return array the validation rules.
	 */
	public function rules()
	{
		return [
			// name, email, subject and body are required
			[['format'], 'required'],
			// start and end dates
			[['start_date', 'end_date'], 'date'],
		];
	}

	/**
	 * Gets the dreams to export.
	 *
	 * @return Dream[]
	 */
	public function getDreams(): array
	{
		$startDate = $this->start_date ?: 0;
		$endDate = $this->end_date ?: time();
		$query = Dream::find()->dreamtBetween($startDate, $endDate)->orderBy('dreamt_at DESC');

		//If a user is set, limit to their dreams
		if($this->user)
		{
			$query->whereUser($this->user);
		}

		return $query->all();
	}

	/**
	 * Gets all of the dream data to export.
	 *
	 * @return array
	 */
	public function getDreamData(): array
	{
		$dreams = $this->getDreams();
		$dreamData = [];
		foreach($dreams as $dream)
		{
			$dreamAttributes = $dream->attributes;
			$dreamAttributes['id'] = $dream->getId();
			$dreamAttributes['types'] = array_column($dream->types, 'name');
			$dreamAttributes['categories'] = array_column($dream->categories, 'name');
			$dreamData[] = $dreamAttributes;
		}

		return $dreamData;
	}
}