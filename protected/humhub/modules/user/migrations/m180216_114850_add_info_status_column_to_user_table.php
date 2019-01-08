<?php

use yii\db\Migration;

/**
 * Handles adding info_status to table `user`.
 */
class m180216_114850_add_info_status_column_to_user_table extends Migration
{
    /**
     * @inheritdoc
     */
	public function up()
	{
		$this->addColumn('user', 'info_status', $this->string());
	}

	/**
	 * @inheritdoc
	 */
	public function down()
	{
		$this->dropColumn('user', 'info_status');
	}
}
