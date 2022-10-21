<?php

use yii\db\Migration;

/**
 * Class m221020_041111_delete_data_product_type
 */
class m221020_041111_delete_data_product_type extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey('fkey-control_primary_product-product_type_id', 'control_primary_product');
        $this->delete('product_types', );
        $this->dropTable('pro_primary_data');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m221020_041111_delete_data_product_type cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221020_041111_delete_data_product_type cannot be reverted.\n";

        return false;
    }
    */
}
