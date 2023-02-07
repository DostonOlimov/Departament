<?php

use yii\db\Migration;

/**
 * Class m230203_161601_add_column_control_company_type
 */
class m230203_161601_add_column_control_company_type extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('control_companies', 'type');
        $this->addColumn("control_companies", "type", $this->integer());
        $this->addColumn("control_companies", "pre_type", $this->integer());
        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230203_161601_add_column_control_company_type cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230203_161601_add_column_control_company_type cannot be reverted.\n";

        return false;
    }
    */
}
