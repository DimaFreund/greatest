<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tags_relationship`.
 */
class m180328_113558_create_tags_relationship_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tags_relationship', [
	        'tags_id' => 'int(8) NOT NULL',
	        'desire_id' => 'int(8) NOT NULL',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tags_relationship');
    }
}
