<?php

use yii\db\Migration;

/**
 * Class m221013_060311_add_column_to_control_company_inn
 */
class m221013_060311_add_column_to_control_company_inn extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('control_companies', 'thsht',$this->string()->Null());
        $this->addColumn('control_companies', 'ifut',$this->string()->Null());
        $this->addColumn('control_companies', 'mhobt',$this->string()->Null());
        $this->addColumn('control_companies', 'ownername',$this->string()->Null());
       // $this->addColumn('control_companies', 'thsht',$this->string()->Null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m221013_060311_add_column_to_control_company_inn cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221013_060311_add_column_to_control_company_inn cannot be reverted.\n";

        return false;
    }
    */
}
