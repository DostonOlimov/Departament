<?php

use yii\db\Migration;

/**
 * Class m230112_060459_create_table_economics
 */
class m230112_060459_create_table_economics extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%economics}}', [
            'id' => $this->primaryKey(),
            'control_instruction_id' => $this->integer(),
            'first_warn_date' => $this->integer(),
            'number_passport' => $this->integer(),
            'warn_number' => $this->integer(),
            'eco_date'=> $this->integer(),
            'eco_number' => $this->integer(),
            'eco_quantity' => $this->string(),
            'eco_amount' => $this->string(),

            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->notNull(),
            'created_at' => $this->integer()->unsigned()->notNull(),
            'updated_at' => $this->integer()->unsigned()->notNull(),
        ]);

        $this->createIndex('index-economics-created_by', 'economics', 'created_by');
        $this->addForeignKey('fkey-economics-created_by', 'economics', 'created_by', 'user', 'id', 'RESTRICT', 'RESTRICT');

        $this->createIndex('index-economics-updated_by', 'economics', 'updated_by');
        $this->addForeignKey('fkey-economics-updated_by', 'economics', 'updated_by', 'user', 'id', 'RESTRICT', 'RESTRICT');
    
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230112_060459_create_table_economics cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230112_060459_create_table_economics cannot be reverted.\n";

        return false;
    }
    */
}
