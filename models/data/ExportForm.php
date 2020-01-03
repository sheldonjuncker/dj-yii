<?php

namespace app\models\data;

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
			['start_date, end_date', 'date'],
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
}