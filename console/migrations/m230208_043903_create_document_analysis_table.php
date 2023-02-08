<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%document_analysis}}`.
 */
class m230208_043903_create_document_analysis_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%document_analysis}}', [
            'id' => $this->primaryKey(),
            'control_instruction_id' => $this->integer()->notNull(),
            'reestr_number' => $this->string(),
            'given_date' => $this->integer(),
            'defect' => $this->string(),

            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->notNull(),
            'created_at' => $this->integer()->unsigned()->notNull(),
            'updated_at' => $this->integer()->unsigned()->notNull(),
        ]);

        $this->createIndex('index-document_analysis-control_instruction_id', 'document_analysis', 'control_instruction_id');
        $this->addForeignKey('fkey-document_analysis-control_instruction_id', 'document_analysis', 'control_instruction_id', 'control_instructions', 'id', 'RESTRICT', 'RESTRICT');

        $this->createIndex('index-document_analysis-created_by', 'document_analysis', 'created_by');
        $this->addForeignKey('fkey-document_analysis-created_by', 'document_analysis', 'created_by', 'user', 'id', 'RESTRICT', 'RESTRICT');

        $this->createIndex('index-document_analysis-updated_by', 'document_analysis', 'updated_by');
        $this->addForeignKey('fkey-document_analysis-updated_by', 'document_analysis', 'updated_by', 'user', 'id', 'RESTRICT', 'RESTRICT');
   
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%document_analysis}}');
    }
}
