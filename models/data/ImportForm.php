<?php

namespace app\models\data;

use yii\base\Model;
use yii\web\UploadedFile;

class ImportForm extends Model
{
	public $format;

	/** @var  UploadedFile $file */
	public $file;

	/**
	 * @return array the validation rules.
	 */
	public function rules()
	{
		return [
			// name, email, subject and body are required
			[['format'], 'required'],
			// start and end dates
			[['file'], 'file', 'skipOnEmpty' => false],
		];
	}

	public function readFile(): string
	{
		if ($this->validate())
		{
			return file_get_contents($this->file->tempName);
		}
		else
		{
			return '';
		}
	}
}