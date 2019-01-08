<?php

use yii\db\Migration;

/**
 * Handles the creation of table `news`.
 */
class m180814_121629_create_news_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
	    $this->createTable('news', array(
		    'id' => 'pk',
		    'title'   => 'text DEFAULT NULL',
		    'message' => 'text DEFAULT NULL',
		    'category' => 'int(4) DEFAULT NULL',
		    'url' => 'varchar(255) DEFAULT NULL',
		    'created_at' => 'datetime DEFAULT NULL',
		    'created_by' => 'int(11) DEFAULT NULL',
		    'updated_at' => 'datetime DEFAULT NULL',
		    'updated_by' => 'int(11) DEFAULT NULL',
	    ), '');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('news');
    }
}
