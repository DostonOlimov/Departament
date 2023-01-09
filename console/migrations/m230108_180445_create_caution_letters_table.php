<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%caution_letters}}`.
 */
class m230108_180445_create_caution_letters_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%caution_letters}}', [
            'id' => $this->primaryKey(),
            'company_id' => $this->integer()->notNull(),
            'letter_number' => $this->string(),
            'letter_date' => $this->string(),
            'comment' => $this->text(),
            'file' => $this->string(), 
            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->notNull(),
        ]);
        $this->createIndex('index-caution_letters-control_companies_id', 'caution_letters', 'company_id');
        $this->addForeignKey('fkey-caution_letters-control_companies_id', 'caution_letters', 'company_id', 'control_companies', 'id', 'RESTRICT', 'RESTRICT');
        $this->createIndex('index-caution_letters-created_by', 'caution_letters', 'created_by');
        $this->createIndex('index-caution_letters-updated_by', 'caution_letters', 'updated_by');
        $this->addForeignKey('fkey-caution_letters-created_by-user_id', 'caution_letters', 'created_by', 'user', 'id', 'RESTRICT', 'RESTRICT');        
        $this->addForeignKey('fkey-caution_letters-updated_by-user_id_', 'caution_letters', 'updated_by', 'user', 'id', 'RESTRICT', 'RESTRICT');    
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%caution_letters}}');
    }
}
