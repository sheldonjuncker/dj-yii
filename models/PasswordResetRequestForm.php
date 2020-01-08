<?php

namespace app\models;

use yii\base\Model;

class PasswordResetRequestForm extends Model
{
	public $email;


	/**
	 * @return array the validation rules.
	 */
	public function rules()
	{
		return [
			// username and password are both required
			[['email'], 'required'],
			// rememberMe must be a boolean value
			['email', 'email']
		];
	}

	public function sendResetLink()
	{

	}
}