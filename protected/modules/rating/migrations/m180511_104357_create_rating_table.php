<?php

use yii\db\Migration;

/**
 * Handles the creation of table `rating`.
 */
class m180511_104357_create_rating_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('rating', [
	        'id' => 'pk',
	        'rating' => 'int(5) DEFAULT NULL',
	        'desire_id' => 'int(11) NOT NULL',
	        'created_at' => 'datetime DEFAULT NULL',
	        'created_by' => 'int(11) DEFAULT NULL',
	        'updated_at' => 'datetime DEFAULT NULL',
	        'updated_by' => 'int(11) DEFAULT NULL',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('rating');
    }
}
