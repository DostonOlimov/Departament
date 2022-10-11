<?php

use yii\db\Migration;

/**
 * Class m221011_053741_add_type_column_to_control_instructions
 */
class m221011_053741_add_type_column_to_control_instructions extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('control_instructions', 'type', $this->integer()->notNull());
        $this->addColumn('control_instructions', 'code', $this->integer()->notNull());
        $this->addColumn('control_instructions', 'checkup_duration',$this->integer()->notNull());
        $this->addColumn('control_instructions', 'real_checkup_date',$this->integer()->notNull());
        $this->addColumn('control_instructions', 'checkup_duration_start_date',$this->integer()->notNull());
        $this->addColumn('control_instructions', 'checkup_duration_finish_date',$this->integer()->notNull());
        $this->addColumn('control_instructions', 'might_be_breakdown_letter',$this->integer()->notNull());
        $this->addColumn('control_instructions', 'checkup_subject',$this->integer()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m221011_053741_add_type_column_to_control_instructions cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221011_053741_add_type_column_to_control_instructions cannot be reverted.\n";

        return false;
    }
    */
}
