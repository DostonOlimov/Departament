<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%shopping_laboratory}}`.
 */
class m230207_112418_create_shopping_laboratory_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%shopping_laboratory}}', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%shopping_laboratory}}');
    }
}
