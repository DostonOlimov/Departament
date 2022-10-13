<?php

use yii\db\Migration;

/**
 * Class m221012_155133_update_table_control_instruction_for_column_who_send_letter
 */
class m221012_155133_update_table_control_instruction_for_column_who_send_letter extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('control_instructions', 'might_be_breakdown_letter',$this->text()->notNull());
        $this->alterColumn('control_instructions', 'who_send_letter',$this->string()->Null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m221012_155133_update_table_control_instruction_for_column_who_send_letter cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221012_155133_update_table_control_instruction_for_column_who_send_letter cannot be reverted.\n";

        return false;
    }
    */
}
