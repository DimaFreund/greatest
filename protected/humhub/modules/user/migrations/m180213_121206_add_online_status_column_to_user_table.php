<?php

use yii\db\Migration;

/**
 * Handles adding online_status to table `user`.
 */
class m180213_121206_add_online_status_column_to_user_table extends Migration
{
	/**
	 * @inheritdoc
	 */
	public function up()
	{
		$this->addColumn('user', 'status_online', $this->integer());
	}

	/**
	 * @inheritdoc
	 */
	public function down()
	{
		$this->dropColumn('user', 'status_online');
	}
}
