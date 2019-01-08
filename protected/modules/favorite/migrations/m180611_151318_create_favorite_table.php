<?php

use yii\db\Migration;

/**
 * Handles the creation of table `favorite`.
 */
class m180611_151318_create_favorite_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('favorite', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('favorite');
    }
}
