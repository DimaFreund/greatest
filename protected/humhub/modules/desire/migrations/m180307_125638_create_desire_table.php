<?php

use yii\db\Migration;

/**
 * Handles the creation of table `desire`.
 */
class m180307_125638_create_desire_table extends Migration
{
	public function up()
	{

		$this->createTable('desire', array(
			'id' => 'pk',
			'title'   => 'text DEFAULT NULL',
			'message' => 'text DEFAULT NULL',
			'greatest'   => 'int(1) DEFAULT NULL',
			'url' => 'varchar(255) DEFAULT NULL',
			'created_at' => 'datetime DEFAULT NULL',
			'created_by' => 'int(11) DEFAULT NULL',
			'updated_at' => 'datetime DEFAULT NULL',
			'updated_by' => 'int(11) DEFAULT NULL',
		), '');
	}

	public function down()
	{
		echo "m180307_125638_create_desire_table does not support migration down.\n";
		return false;
	}

}
