<?php

use yii\db\Migration;

/**
 * Class m230125_093113_intruction_file_table
 */
class m230125_093113_intruction_file_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%instruction_file}}', [
            'id' => $this->primaryKey(),
            'instructions_id' => $this->integer()->notNull(),            
            'basis_file' => $this->string(),
            'program_file' => $this->string(),
            'order_file' => $this->string(),
            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->notNull(),
        ]);

        $this->createIndex('index-instruction_file-control_instructions_id', 'instruction_file', 'instructions_id');
        $this->addForeignKey('fkey-instruction_file-control_instructions_id', 'instruction_file', 'instructions_id', 'control_instructions', 'id', 'RESTRICT', 'RESTRICT');
        $this->createIndex('index-instruction_file-created_by', 'instruction_file', 'created_by');
        $this->addForeignKey('fkey-instruction_file-created_by-user_id', 'instruction_file', 'created_by', 'user', 'id', 'RESTRICT', 'RESTRICT');
        $this->createIndex('index-instruction_file-updated_by', 'instruction_file', 'updated_by');
        $this->addForeignKey('fkey-instruction_file-updated_by-user_id', 'instruction_file', 'updated_by', 'user', 'id', 'RESTRICT', 'RESTRICT');        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%instruction_file}}');
    }
    

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230125_093113_intruction_file_table cannot be reverted.\n";

        return false;
    }
    */
}
