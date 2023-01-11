<?php

use yii\db\Migration;

/**
 * Class m230111_052630_create_table_executions
 */
class m230111_052630_create_table_executions extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%executions}}', [
            'id' => $this->primaryKey(),
            'control_instruction_id' => $this->integer(),
            'person' => $this->string(),
            'number_passport' => $this->string(),
            'fine_amount' => $this->integer(),
            'paid_amount'=> $this->integer(),
            'band_mjtk' => $this->string(),
            'explanation_letter' => $this->string(),
            'claim' => $this->string(),
            'court_letter' => $this->string(),
            'person_position' => $this->text(),
            'first_date' => $this->integer(),
            'caution_number'=> $this->string(),

            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->notNull(),
            'created_at' => $this->integer()->unsigned()->notNull(),
            'updated_at' => $this->integer()->unsigned()->notNull(),
        ]);

        $this->createIndex('index-executions-control_instruction_id', 'executions', 'control_instruction_id');
        $this->addForeignKey('fkey-executions-control_instructions', 'executions', 'control_instruction_id', 'control_instructions', 'id', 'RESTRICT', 'RESTRICT');

        $this->createIndex('index-executions-created_by', 'executions', 'created_by');
        $this->addForeignKey('fkey-executions-created_by', 'executions', 'created_by', 'user', 'id', 'RESTRICT', 'RESTRICT');

        $this->createIndex('index-executions-updated_by', 'executions', 'updated_by');
        $this->addForeignKey('fkey-executions-updated_by', 'executions', 'updated_by', 'user', 'id', 'RESTRICT', 'RESTRICT');
    
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230111_052630_create_table_executions cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230111_052630_create_table_executions cannot be reverted.\n";

        return false;
    }
    */
}
