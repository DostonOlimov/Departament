<?php

use yii\db\Migration;

/**
 * Class m230203_091531_update_shopping_instruction_table
 */
class m230203_091531_update_shopping_instruction_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('shopping_instructions', 'base');
        $this->dropColumn('shopping_instructions', 'letter_date');
        $this->dropColumn('shopping_instructions', 'letter_number');
        $this->addColumn("shopping_instructions", "notice_id", $this->integer());
        $this->addColumn("shopping_instructions", "card_number", $this->string());
        $this->addColumn("shopping_instructions", "card_given_date", $this->string());
        $this->addColumn("shopping_instructions", "card_return_date", $this->string());
        $this->addColumn("shopping_instructions", "status", $this->string());
        $this->createIndex('index-shopping_instructions-notice_id', 'shopping_instructions', 'notice_id');
        $this->addForeignKey('fkey-shopping_instructions-notice_id', 'shopping_instructions', 'notice_id', 'shopping_notice', 'id', 'RESTRICT', 'RESTRICT'); 
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230203_091531_update_shopping_instruction_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230203_091531_update_shopping_instruction_table cannot be reverted.\n";

        return false;
    }
    */
}
