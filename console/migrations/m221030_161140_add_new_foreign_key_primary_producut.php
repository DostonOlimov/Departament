<?php

use yii\db\Migration;

/**
 * Class m221030_161140_add_new_foreign_key_primary_producut
 */
class m221030_161140_add_new_foreign_key_primary_producut extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('control_primary_product' , 'mandatory_certification_id');
        $this->dropColumn('control_primary_product' , 'group_id');
        $this->dropColumn('control_primary_product' , 'class_id');
        $this->dropColumn('control_primary_product' , 'position_id');
        $this->dropColumn('control_primary_product' , 'under_position_id');
        $this->dropColumn('control_primary_product' , 'sector_id');

       // $this->createIndex('index-control_primary_product-product_type_id', 'control_primary_product', 'product_type_id');
        $this->addForeignKey('fkey-control_primary_product-product_type_id', 'control_primary_product', 'product_type_id', 'product_subposition', 'id', 'RESTRICT', 'RESTRICT');

        $this->createIndex('index-control_primary_product_nd-control_primary_product_id', 'control_primary_product_nd', 'control_primary_product_id');
        $this->addForeignKey('fkey-control_primary_product_nd-control_primary_product_id', 'control_primary_product_nd', 'control_primary_product_id', 'control_primary_product', 'id', 'RESTRICT', 'RESTRICT');

        $this->createIndex('index-mandatory_certification-control_primary_product_id', 'mandatory_certification', 'control_primary_product_id');
        $this->addForeignKey('fkey-mandatory_certification-control_primary_product_id', 'mandatory_certification', 'control_primary_product_id', 'control_primary_product', 'id', 'RESTRICT', 'RESTRICT');

        $this->createIndex('index-product_group-sector_id', 'product_group', 'sector_id');
        $this->addForeignKey('fkey-product_group-product_sector', 'product_group', 'sector_id', 'product_sector', 'id', 'RESTRICT', 'RESTRICT');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m221030_161140_add_new_foreign_key_primary_producut cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221030_161140_add_new_foreign_key_primary_producut cannot be reverted.\n";

        return false;
    }
    */
}
