<?php

namespace app\models\data;

use app\models\dj\Dream;
use yii\base\Model;

class ExportForm extends Model
{
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
	 * @return array customized attribute labels
	 */
	public function attributeLabels()
	{
		return [
			'format' => 'Format'
		];
	}

	/**
	 * Gets all of the dream data to export.
	 *
	 * @return array
	 */
	public function getDreams(): array
	{
		$startDate = $this->start_date ?: 0;
		$endDate = $this->end_date ?: time();
		$dreams = Dream::find()->dreamtBetween($startDate, $endDate)->all();

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