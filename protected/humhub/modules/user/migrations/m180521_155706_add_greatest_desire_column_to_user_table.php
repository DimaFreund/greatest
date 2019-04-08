<?php

use yii\db\Migration;

/**
 * Handles adding greatest_desire to table `user`.
 */
class m180521_155706_add_greatest_desire_column_to_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('user', 'greatest_desire', $this->integer());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('user', 'greatest_desire');
    }
}
