<?php

use yii\db\Migration;

/**
 * Handles adding date_create to table `gallery_media`.
 */
class m180510_132026_add_date_create_column_to_gallery_media_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('gallery_media', 'date_create', $this->dateTime());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('gallery_media', 'date_create');
    }
}
