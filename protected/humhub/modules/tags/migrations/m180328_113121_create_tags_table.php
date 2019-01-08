<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tags`.
 */
class m180328_113121_create_tags_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tags', [
            'id' => $this->primaryKey(),
            'title' => 'varchar(255) NOT NULL',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tags');
    }
}
