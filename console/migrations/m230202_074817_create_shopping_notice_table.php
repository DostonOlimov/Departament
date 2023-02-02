<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%shopping_notice}}`.
 */
class m230202_074817_create_shopping_notice_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%shopping_notice}}', [
            'id' => $this->primaryKey(),
            'notice_number' => $this->string(),
            'notice_sum' => $this->string(),
            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->notNull(),
            'status' => $this->string(),
            'attachment_user_id' => $this->integer(),
        ]);
        $this->createIndex('index-shopping_notice-created_by', 'shopping_notice', 'created_by');
        $this->createIndex('index-shopping_notice-updated_by', 'shopping_notice', 'updated_by');
        $this->createIndex('index-shopping_notice-attachment_user_id', 'shopping_notice', 'attachment_user_id');
        $this->addForeignKey('fkey-shopping_notice-created_by-user_id', 'shopping_notice', 'created_by', 'user', 'id', 'RESTRICT', 'RESTRICT');        
        $this->addForeignKey('fkey-shopping_notice-updated_by-user_id_', 'shopping_notice', 'updated_by', 'user', 'id', 'RESTRICT', 'RESTRICT');  
        $this->addForeignKey('fkey-shopping_notice-attachment_user_id-user_id_', 'shopping_notice', 'attachment_user_id', 'user', 'id', 'RESTRICT', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%shopping_notice}}');
    }
}
