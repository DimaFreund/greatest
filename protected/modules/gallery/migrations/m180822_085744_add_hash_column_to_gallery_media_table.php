<?php

use yii\db\Migration;

/**
 * Handles adding hash to table `gallery_media`.
 */
class m180822_085744_add_hash_column_to_gallery_media_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
	    $this->addColumn('gallery_media','guid', 'varchar(45) DEFAULT NULL'
		    );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
    }
}
