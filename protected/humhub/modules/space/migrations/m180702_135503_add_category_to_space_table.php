<?php

use yii\db\Migration;

class m180702_135503_add_category_to_space_table extends Migration
{
	public function up()
	{
		$this->addColumn('space', 'category', $this->integer());
	}

	public function down()
	{
		$this->dropColumn('space', 'category');
	}
}
