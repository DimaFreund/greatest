<?php

use yii\db\Migration;

/**
 * Handles the creation of table `blog`.
 */
class m180315_154709_create_blog_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
	    $this->createTable('blog', array(
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
		echo "m180315_154709_create_blog_table does not support migration down.\n";
		return false;
	}
}

