<?php

use yii\db\Migration;

/**
 * Class m221220_154517_alter_control_instruction_subject
 */
class m221220_154517_alter_control_instruction_subject extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('control_instructions', 'type',$this->integer()->after('id'));
        $this->alterColumn('control_instructions', 'general_status',$this->integer()->after('type'));
        $this->alterColumn('control_instructions', 'code',$this->integer()->after('general_status'));
        $this->alterColumn('control_instructions', 'checkup_duration',$this->integer()->after('code'));
        $this->alterColumn('control_instructions', 'real_checkup_date',$this->integer()->after('code'));
        $this->alterColumn('control_instructions', 'checkup_duration_finish_date',$this->integer()->after('code'));
        $this->alterColumn('control_instructions', 'checkup_duration_start_date',$this->integer()->after('code'));
        $this->alterColumn('control_instructions', 'checkup_subject',$this->string()->after('code'));
        $this->alterColumn('control_instructions', 'who_send_letter',$this->string()->after('code'));
   
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m221220_154517_alter_control_instruction_subject cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221220_154517_alter_control_instruction_subject cannot be reverted.\n";

        return false;
    }
    */
}
