<?php

use yii\db\Migration;

/**
 * Class m230217_054358_add_repeat_instruction_primary_data
 */
class m230217_054358_add_repeat_instruction_primary_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('control_primary_data', 'product_exsist', $this->integer()->defaultValue(0));
        $this->addColumn('control_primary_data', 'repeat_instruction', $this->integer()->defaultValue(0));
        $this->addColumn('control_primary_data', 'repeat_comment', $this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230217_054358_add_repeat_instruction_primary_data cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230217_054358_add_repeat_instruction_primary_data cannot be reverted.\n";

        return false;
    }
    */
}
