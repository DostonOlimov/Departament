<?php

use yii\db\Migration;

/**
 * Class m221116_050823_create_new_table_control_product_identification
 */
class m221116_050823_create_new_table_control_product_identification extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%control_product_identification}}', [
            'id' => $this->primaryKey(),
            'control_primary_data_id' => $this->integer()->notNull(),
            'control_product_id' => $this->integer()->notNull(),
            'product_purpose_id' => $this->integer()->notNull(),
            'quality' => $this->integer()->notNull(),
            'comment' => $this->text(),
            'quantity' => $this->integer()->defaultValue(0),
            'amount' => $this->integer()->defaultValue(0),
        ]);

        $this->createIndex('index-control_product_identification-control_primary_data_id', 'control_product_identification', 'control_primary_data_id');
        $this->addForeignKey('fkey-control_product_identification-control_primary_data', 'control_product_identification', 'control_primary_data_id', 'control_primary_data', 'id', 'RESTRICT', 'RESTRICT');
        
        $this->createIndex('index-control_product_identification-control_product_id', 'control_product_identification', 'control_product_id');
        $this->addForeignKey('fkey-control_product_identification-control_primary_product', 'control_product_identification', 'control_product_id', 'control_primary_product', 'id', 'RESTRICT', 'RESTRICT');
 
    }

    public function safeDown()
    {
        $this->dropTable('{{%control_product_identification}}');
    }


    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221116_050823_create_new_table_control_product_identification cannot be reverted.\n";

        return false;
    }
    */
}
