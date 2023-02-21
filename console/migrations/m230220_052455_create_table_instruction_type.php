<?php

use yii\db\Migration;

/**
 * Class m230220_052455_create_table_instruction_type
 */
class m230220_052455_create_table_instruction_type extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->createTable('{{%instruction_type}}', [
            'id' => $this->primaryKey(),
            'instruction_id' => $this->integer()->notNull(),
            'product' => $this->integer()->defaultValue(1),
            'ov' => $this->integer()->defaultValue(1),
            'document' => $this->integer()->defaultValue(0),
            'canceled' => $this->integer()->defaultValue(0),

            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->notNull(),
            'created_at' => $this->integer()->unsigned()->notNull(),
            'updated_at' => $this->integer()->unsigned()->notNull(),
        ]);

        $this->createIndex('index-instruction_type-instruction_id', 'instruction_type', 'instruction_id');
        $this->addForeignKey('fkey-instruction_type-instruction_id', 'instruction_type', 'instruction_id', 'control_instructions', 'id', 'RESTRICT', 'RESTRICT');

        $this->createIndex('index-instruction_type-created_by', 'instruction_type', 'created_by');
        $this->addForeignKey('fkey-instruction_type-created_by', 'instruction_type', 'created_by', 'user', 'id', 'RESTRICT', 'RESTRICT');

        $this->createIndex('index-instruction_type-updated_by', 'instruction_type', 'updated_by');
        $this->addForeignKey('fkey-instruction_type-updated_by', 'instruction_type', 'updated_by', 'user', 'id', 'RESTRICT', 'RESTRICT');
  
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230220_052455_create_table_instruction_type cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230220_052455_create_table_instruction_type cannot be reverted.\n";

        return false;
    }
    */
}
