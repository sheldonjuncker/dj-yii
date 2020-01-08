<?php

namespace app\models;

use app\models\dj\User;
use yii\base\Model;

class PasswordResetForm extends Model
{
	public $code;
	public $new_password;
	public $new_password_verify;


	/**
	 * @return array the validation rules.
	 */
	public function rules()
	{
		return [
			// username and password are both required
			[['new_password', 'new_password_verify', 'code'], 'required'],
			['new_password', 'validatePassword'],
			['code', 'validateCode']
		];
	}

	public function attributeLabels()
	{
		return [
			'new_password' => 'New Password',
			'new_password_verify' => 'Verify New Password'
		];
	}

	/**
	 * Validates the password.
	 * This method serves as the inline validation for password.
	 *
	 * @param string $attribute the attribute currently being validated
	 * @param array $params the additional name-value pairs given in the rule
	 */
	public function validatePassword($attribute, $params)
	{
		if (!$this->hasErrors())
		{
			if($this->new_password !== $this->new_password_verify)
			{
				$this->addError($attribute, "The password and its verification do not match.");
			}
		}
	}

	/**
	 * Validates the reset code.
	 * This method serves as the inline validation for password.
	 *
	 * @param string $attribute the attribute currently being validated
	 * @param array $params the additional name-value pairs given in the rule
	 */
	public function validateCode($attribute, $params)
	{
		if (!$this->hasErrors())
		{
			if(!$this->code || !$this->getUser())
			{
				$this->addError($attribute, "Invalid or expired password reset link.");
			}
		}
	}

	protected function getUser(): ?User
	{
		if($this->code)
		{
			return User::find()->andWhere(['password_reset_code' => $this->code])->one();
		}
		else
		{
			return NULL;
		}
	}

	public function resetPassword(): bool
	{
		if($this->validate())
		{
			$user = $this->getUser();
			$user->password = $user->generatePassword($this->new_password_verify);
			$user->password_reset_code = NULL;
			return $user->save();
		}
		return false;
	}
}