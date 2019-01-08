<?php

use yii\db\Migration;

/**
 * Handles adding category to table `poll`.
 */
class m180803_093119_add_category_column_to_poll_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('poll', 'category', $this->integer());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('poll', 'category');
    }
}
