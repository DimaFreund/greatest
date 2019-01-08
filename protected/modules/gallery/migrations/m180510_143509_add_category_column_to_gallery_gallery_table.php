<?php

use yii\db\Migration;

/**
 * Handles adding category to table `gallery_gallery`.
 */
class m180510_143509_add_category_column_to_gallery_gallery_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('gallery_gallery', 'category', $this->integer()->Null());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('gallery_gallery', 'category');
    }
}
