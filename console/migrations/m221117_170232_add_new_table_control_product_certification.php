<?php

use yii\db\Migration;

/**
 * Class m221117_170232_add_new_table_control_product_certification
 */
class m221117_170232_add_new_table_control_product_certification extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('control_product_certification', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(),
            'number_reestr' => $this->integer(),
            'date_to' => $this->integer(),
            'date_from' => $this->integer(),
            'amount' => $this->integer(),
            'quantity' => $this->integer(),
        ]);
        $this->createIndex('index-control_product_certification-product_id', 'control_product_certification', 'product_id');
        $this->addForeignKey('fkey-control_product_certification-control_primary_product', 'control_product_certification', 'product_id', 'control_primary_product', 'id', 'RESTRICT', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m221117_170232_add_new_table_control_product_certification cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221117_170232_add_new_table_control_product_certification cannot be reverted.\n";

        return false;
    }
    */
}
