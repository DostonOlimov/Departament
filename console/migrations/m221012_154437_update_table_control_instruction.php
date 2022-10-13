<?php

use yii\db\Migration;

/**
 * Class m221012_154437_update_table_control_instruction
 */
class m221012_154437_update_table_control_instruction extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('control_instructions', 'might_be_breakdown_letter',$this->string()->notNull());
        $this->addColumn('control_instructions', 'who_send_letter',$this->integer()->Null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m221012_154437_update_table_control_instruction cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221012_154437_update_table_control_instruction cannot be reverted.\n";

        return false;
    }
    */
}
