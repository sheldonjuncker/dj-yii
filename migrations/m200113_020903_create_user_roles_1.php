<?php

use yii\db\Migration;

/**
 * Class m200113_020903_create_user_roles_1
 */
class m200113_020903_create_user_roles_1 extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
		$auth = Yii::$app->getAuthManager();

		// add admin role
		$admin = $auth->createRole('admin');
		$auth->add($admin);

		// add "manageAdminData" permission
		$adminData = $auth->createPermission('manageAdminData');
		$adminData->description = 'Manage admin data such as categories and concepts.';
		$auth->add($adminData);


		// Admin gets all the permissions
		$auth->addChild($admin, $adminData);

		//Make me the admin.
		$auth->assign($admin, 1);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200113_020903_create_user_roles_1 cannot be reverted.\n";

		$auth = Yii::$app->getAuthManager();
		$auth->removeAll();
    }
}
