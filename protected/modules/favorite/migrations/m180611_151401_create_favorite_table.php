<?php

use yii\db\Migration;

/**
 * Handles the creation of table `favorite`.
 */
class m180611_151401_create_favorite_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
	    $this->createTable('favorite', array(
		    'id' => 'pk',
		    'target_user_id' => 'int(11) NOT NULL',
		    'object_model' => 'varchar(100) NOT NULL',
		    'object_id' => 'int(11) NOT NULL',
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
	    echo "m160205_203955_initial does not support migration down.\n";
	    return false;
    }
}
