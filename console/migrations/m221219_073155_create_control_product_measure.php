<?php

use yii\db\Migration;

/**
 * Class m221219_073155_create_control_product_measure
 */
class m221219_073155_create_control_product_measure extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('control_product_measures', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull(),
            'amount' => $this->integer(),
            'quantity' => $this->integer(),
        ]);
       
        $this->createIndex('index-control_product_measures-product_id', 'control_product_measures', 'product_id');
        $this->addForeignKey('fkey-control_product_measures-control_primary_product', 'control_product_measures ', 'product_id', 'control_primary_product', 'id', 'RESTRICT', 'RESTRICT');
  
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m221219_073155_create_control_product_measure cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221219_073155_create_control_product_measure cannot be reverted.\n";

        return false;
    }
    */
}
