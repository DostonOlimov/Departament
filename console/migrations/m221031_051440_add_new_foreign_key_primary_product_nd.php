<?php

use yii\db\Migration;

/**
 * Class m221031_051440_add_new_foreign_key_primary_product_nd
 */
class m221031_051440_add_new_foreign_key_primary_product_nd extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey('fkey-control_primary_product_nd-control_primary_product_id', 'control_primary_product_nd');
        $this->dropForeignKey('fkey-mandatory_certification-control_primary_product_id', 'mandatory_certification');

        $this->createIndex('index-control_primary_product_nd-nd_type', 'control_primary_product_nd', 'type_id');
        $this->addForeignKey('fkey-control_primary_product_nd-nd_type', 'control_primary_product_nd', 'control_primary_product_id', 'nd_type', 'id', 'RESTRICT', 'RESTRICT');

        $this->createIndex('index-control_primary_product-contries', 'control_primary_product', 'made_country');
        $this->addForeignKey('fkey-control_primary_product-contries', 'control_primary_product', 'made_country', 'countries', 'id', 'RESTRICT', 'RESTRICT');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m221031_051440_add_new_foreign_key_primary_product_nd cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221031_051440_add_new_foreign_key_primary_product_nd cannot be reverted.\n";

        return false;
    }
    */
}
