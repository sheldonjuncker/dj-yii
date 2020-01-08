<?php

namespace app\models;

use app\models\dj\User;
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

	protected function getUser(): ?User
	{
		return User::find()->andWhere(['email' => $this->email])->one();
	}

	/**
	 * Always pretend to succeed so the user doesn't know if they
	 * reset someone's password or not.
	 *
	 * @return bool
	 */
	public function sendResetLink(): bool
	{
		$user = $this->getUser();
		if($user)
		{
			$user->password_reset_code = "1994";
			$user->save();
		}
		return true;
	}
}