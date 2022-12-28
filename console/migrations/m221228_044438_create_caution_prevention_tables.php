<?php

use yii\db\Migration;

/**
 * Class m221228_044438_create_caution_prevention_tables
 */
class m221228_044438_create_caution_prevention_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%caution_prevention}}', [
            'id' => $this->primaryKey(),
            'instructions_id' => $this->integer()->notNull(),
            'companies_id' => $this->integer()->notNull(),
            'message_num' => $this->string(),
            'message_date' => $this->string(),
            'comment' => $this->text(),
            'inspector_name' => $this->string(),
            'inspectors' => $this->string(), 
        ]);

        $this->createIndex('index-caution_prevention-control_companies_id', 'caution_prevention', 'companies_id');
        $this->addForeignKey('fkey-caution_prevention-control_companies_id', 'caution_prevention', 'companies_id', 'control_companies', 'id', 'RESTRICT', 'RESTRICT');
        $this->createIndex('index-caution_prevention-control_instruction_id', 'caution_prevention', 'instructions_id');
        $this->addForeignKey('fkey-caution_prevention-control_instruction_id', 'caution_prevention', 'instructions_id', 'control_instructions', 'id', 'RESTRICT', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%caution_prevention}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221228_044438_create_caution_prevention_tables cannot be reverted.\n";

        return false;
    }
    */
}
