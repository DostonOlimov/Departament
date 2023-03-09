<?php

use yii\db\Migration;

/**
 * Class m230303_143859_alter_table_risk_analisys_criteria
 */
class m230303_143859_alter_table_risk_analisys_criteria extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('{{%risk_analisys_criteria}}', 'created_at');
        $this->dropColumn('{{%risk_analisys_criteria}}', 'updated_at');
        $this->addColumn('{{%risk_analisys_criteria}}', 'created_at',$this->dateTime());
        $this->addColumn('{{%risk_analisys_criteria}}', 'updated_at',$this->dateTime());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230303_143859_alter_table_risk_analisys_criteria cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230303_143859_alter_table_risk_analisys_criteria cannot be reverted.\n";

        return false;
    }
    */
}
