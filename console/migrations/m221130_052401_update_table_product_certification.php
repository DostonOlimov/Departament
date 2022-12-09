<?php

use yii\db\Migration;

/**
 * Class m221130_052401_update_table_product_certification
 */
class m221130_052401_update_table_product_certification extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('control_primary_product', 'descreption');
        $this->addColumn('control_primary_product', 'cer_amount', $this->integer()->defaultValue(0));
        $this->addColumn('control_primary_product', 'cer_quantity', $this->integer()->defaultValue(0));
       
        $this->dropColumn('control_product_certification', 'amount');
        $this->dropColumn('control_product_certification', 'quantity');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m221130_052401_update_table_product_certification cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221130_052401_update_table_product_certification cannot be reverted.\n";

        return false;
    }
    */
}
