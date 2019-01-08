<?php

use yii\db\Migration;

/**
 * Handles the creation of table `admin_desires`.
 */
class m180205_142433_create_admin_desires_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('admin_desires', [
	        'id' => $this->primaryKey(),
	        'title' => $this->string(),
	        'description' => $this->text(),
	        'content' => $this->text(),
	        'date' => $this->date(),
	        'image' => $this->string(),
	        'status' => $this->integer(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('admin_desires');
    }
}
