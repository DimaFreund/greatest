<?php

use yii\db\Migration;

/**
 * Handles the creation of table `category`.
 */
class m180403_131530_create_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('category', [
            'id' => $this->primaryKey(),
	        'name' => $this->string(100)->notNull(),
	        'language' => $this->string(8)->notNull(),
	        'object_id' => $this->integer()->null(),
	        'object_model' => $this->string(100)->null(),
        ]);

	    $this->createIndex('idx-content-category', 'category', [
		    'object_model', 'object_id', 'language', 'name'
	    ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
	    echo "m170723_133337_content_filter cannot be reverted.\n";
    }
}
