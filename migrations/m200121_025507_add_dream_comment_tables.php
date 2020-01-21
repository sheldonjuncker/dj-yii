<?php

use yii\db\Migration;

/**
 * Class m200121_025507_add_dream_comment_tables
 */
class m200121_025507_add_dream_comment_tables extends Migration
{
    public function up()
    {
		$this->createTable('dj.dream_comment', [
			'id' => 'BINARY(16) NOT NULL PRIMARY KEY',
			'dream_id' => 'BINARY(16) NOT NULL',
			'user_id' => 'BIGINT UNSIGNED NOT NULL',
			'created_at' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP',
			'description' => 'TEXT',
			'
				CONSTRAINT 
					dream_comment_to_dream_fk
					FOREIGN KEY (dream_id)
					REFERENCES dj.dream(id)
					ON UPDATE CASCADE
					ON DELETE CASCADE
			',
			'
				CONSTRAINT 
					dream_comment_to_user_fk
					FOREIGN KEY (user_id)
					REFERENCES dj.user(id)
					ON UPDATE CASCADE
					ON DELETE CASCADE
			'
		]);
    }

    public function down()
    {
		$this->dropTable('dj.dream_comment');
    }
}
