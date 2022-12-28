<?php

use yii\db\Migration;

/**
 * Class m221228_051816_create_caution_embargo_tables
 */
class m221228_051816_create_caution_embargo_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%caution_embargo}}', [
            'id' => $this->primaryKey(),
            'instructions_id' => $this->integer()->notNull(),
            'companies_id' => $this->integer()->notNull(),
            'comment' => $this->text(),
            'message_number' => $this->integer()->defaultValue(0),
            'status' => $this->boolean(),
            'message_date' => $this->string(),
            'inspector_name' => $this->string(),
            'inspectors' => $this->string(), 
        ]);

        $this->createIndex('index-caution_embargo-control_companies_id', 'caution_embargo', 'companies_id');
        $this->addForeignKey('fkey-caution_embargo-control_companies_id', 'caution_embargo', 'companies_id', 'control_companies', 'id', 'RESTRICT', 'RESTRICT');
        $this->createIndex('index-caution_embargo-control_instruction_id', 'caution_embargo', 'instructions_id');
        $this->addForeignKey('fkey-caution_embargo-control_instruction_id', 'caution_embargo', 'instructions_id', 'control_instructions', 'id', 'RESTRICT', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%caution_embargo}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221228_051816_create_caution_embargo_tables cannot be reverted.\n";

        return false;
    }
    */
}
