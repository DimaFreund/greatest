<?php

use yii\db\Migration;

/**
 * Handles the creation of table `guest_question`.
 */
class m180209_132945_create_guest_question_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('guest_question', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'email' => $this->string(),
            'subject' => $this->string(),
            'text' => $this->text(),
            'date' => $this->date()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('guest_question');
    }
}
