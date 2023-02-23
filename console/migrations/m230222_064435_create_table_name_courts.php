<?php

use yii\db\Migration;

/**
 * Class m230222_064435_create_table_name_courts
 */
class m230222_064435_create_table_name_courts extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%courts_name}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),

            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->notNull(),
            'created_at' => $this->integer()->unsigned()->notNull(),
            'updated_at' => $this->integer()->unsigned()->notNull(),
        ]);

        $this->createIndex('index-courts_name-created_by', 'courts_name', 'created_by');
        $this->addForeignKey('fkey-courts_name-created_by', 'courts_name', 'created_by', 'user', 'id', 'RESTRICT', 'RESTRICT');

        $this->createIndex('index-courts_name-updated_by', 'courts_name', 'updated_by');
        $this->addForeignKey('fkey-courts_name-updated_by', 'courts_name', 'updated_by', 'user', 'id', 'RESTRICT', 'RESTRICT');
  
        $this->createTable('{{%court_decision}}', [
            'id' => $this->primaryKey(),
            'execution_id' => $this->integer()->notNull(),
            'court_id' => $this->integer()->notNull(),
            'decision_date' => $this->integer(),
            'decision_file' => $this->string(),
            'fine_amount' => $this->integer()->defaultValue(0),
            'paid_amount' => $this->integer()->defaultValue(0),
            'paid_date' => $this->integer(),
            'discont' => $this->integer()->defaultValue(0),
            'paid_acount' => $this->integer(15)->defaultValue(0),
            'comment' => $this->string(),

            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->notNull(),
            'created_at' => $this->integer()->unsigned()->notNull(),
            'updated_at' => $this->integer()->unsigned()->notNull(),
        ]);

        $this->createIndex('index-court_decision-execution_id', 'court_decision', 'execution_id');
        $this->addForeignKey('fkey-court_decision-execution_id', 'court_decision', 'execution_id', 'executions', 'id', 'RESTRICT', 'RESTRICT');
        $this->createIndex('index-court_decision-court_id', 'court_decision', 'court_id');
        $this->addForeignKey('fkey-court_decision-court_id', 'court_decision', 'court_id', 'courts_name', 'id', 'RESTRICT', 'RESTRICT');

        $this->createIndex('index-court_decision-created_by', 'court_decision', 'created_by');
        $this->addForeignKey('fkey-court_decision-created_by', 'court_decision', 'created_by', 'user', 'id', 'RESTRICT', 'RESTRICT');

        $this->createIndex('index-court_decision-updated_by', 'court_decision', 'updated_by');
        $this->addForeignKey('fkey-court_decision-updated_by', 'court_decision', 'updated_by', 'user', 'id', 'RESTRICT', 'RESTRICT');
  

        $this->dropColumn('executions', 'fine_amount');
        $this->dropColumn('executions', 'paid_amount');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230222_064435_create_table_name_courts cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230222_064435_create_table_name_courts cannot be reverted.\n";

        return false;
    }
    */
}
