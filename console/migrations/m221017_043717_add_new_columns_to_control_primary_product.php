<?php

use yii\db\Migration;

/**
 * Class m221017_043717_add_new_columns_to_control_primary_product
 */
class m221017_043717_add_new_columns_to_control_primary_product extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('control_primary_product', 'product_type_parent_id', $this->integer()->defaultValue(0));
        $this->addColumn('control_primary_product', 'made_country',$this->integer()->Null());
        $this->addColumn('control_primary_product', 'product_measure',$this->integer()->notNull());
        $this->addColumn('control_primary_product','select_of_exsamle_purpose',$this->integer()->notNull());
        $this->addColumn('control_primary_product','mandatory_certification_id',$this->integer()->defaultValue(0));
    }


    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m221017_043717_add_new_columns_to_control_primary_product cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221017_043717_add_new_columns_to_control_primary_product cannot be reverted.\n";

        return false;
    }
    */
}
