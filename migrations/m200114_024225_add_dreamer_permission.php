<?php

use yii\db\Migration;

/**
 * Class m200114_024225_add_dreamer_permission
 */
class m200114_024225_add_dreamer_permission extends Migration
{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp()
	{
		$auth = Yii::$app->getAuthManager();

		//Create dreamer role
		$dreamerRole = $auth->createRole('dreamer');
		$dreamerRole->description = 'A user who has access to basic dream interfaces.';
		$auth->add($dreamerRole);

		//Create rule for dream creators
		$dreamerCreatorRule = new \app\rbac\DreamCreatorRule();
		$auth->add($dreamerCreatorRule);

		//Create the dream management permission and assign to role
		$manageDream = $auth->createPermission('manageDream');
		$manageDream->ruleName = $dreamerCreatorRule->name;
		$manageDream->description = 'Allows a user to manage a dream.';
		$auth->add($manageDream);

		$auth->addChild($dreamerRole, $manageDream);

		//Assign dreamer to all users (users will get this upon registration)
		foreach(\app\models\dj\User::find()->all() as $user)
		{
			$auth->assign($dreamerRole, $user->getId());
		}
	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown()
	{
		$auth = Yii::$app->getAuthManager();

		$dreamerRole = $auth->createRole('dreamer');
		$dreamerRole->description = 'A user who has access to basic dream interfaces.';
		$auth->remove($dreamerRole);

		$dreamCreatorRule = new \app\rbac\DreamCreatorRule();
		$auth->remove($dreamCreatorRule);

		$manageDream = $auth->createPermission('manageDream');
		$manageDream->ruleName = $dreamCreatorRule->name;
		$manageDream->description = 'Allows a user to manage a dream.';
		$auth->remove($manageDream);
	}
}
