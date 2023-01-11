<?php

use yii\db\Migration;

/**
 * Class m230111_122422_add_letters_column
 */
class m230111_122422_add_letters_column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn("caution_letters", "instructions_id", $this->integer()->notNull());
        $this->createIndex('index-caution_letters-instructions_id', 'caution_letters', 'instructions_id');
        $this->addForeignKey('fkey-caution_letters-control_instruction-id', 'caution_letters', 'instructions_id', 'control_instructions', 'id', 'RESTRICT', 'RESTRICT');        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230111_122422_add_letters_column cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230111_122422_add_letters_column cannot be reverted.\n";

        return false;
    }
    */
}
