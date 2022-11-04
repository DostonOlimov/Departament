<?php

use yii\db\Migration;

/**
 * Class m221101_062805_alter_product_type_to_string
 */
class m221101_062805_alter_product_type_to_string extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey('fkey-control_primary_product-product_type_id', 'control_primary_product');
        $this->dropForeignKey('fkey-control_primary_product_nd-nd_type', 'control_primary_product_nd');
        $this->alterColumn('control_primary_product', 'product_type_id',$this->string());
      //  $this->addForeignKey('fkey-control_primary_product-product_type_id', 'control_primary_product', 'product_type_id', 'product_subposition', 'id', 'RESTRICT', 'RESTRICT');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m221101_062805_alter_product_type_to_string cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221101_062805_alter_product_type_to_string cannot be reverted.\n";

        return false;
    }
    */
}
