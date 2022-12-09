<?php

use yii\db\Migration;

/**
 * Class m221117_170252_add_new_table_control_product_checking_labaratory
 */
class m221117_170252_add_new_table_control_product_checking_labaratory extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('control_product_labaratory_checking', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull(),
            'labaratory_checking' => $this->integer(),
            'quality' => $this->integer(),
            'descreption' => $this->text(),
        ]);
        $this->addColumn('control_primary_product', 'quality', $this->integer());
        $this->addColumn('control_primary_product', 'descreption', $this->text());
        
        $this->createIndex('index-control_product_labaratory_checking-product_id', 'control_product_labaratory_checking', 'product_id');
        $this->addForeignKey('fkey-control_product_labaratory_checking-control_primary_product', 'control_product_labaratory_checking', 'product_id', 'control_primary_product', 'id', 'RESTRICT', 'RESTRICT');
  
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m221117_170252_add_new_table_control_product_checking_labaratory cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221117_170252_add_new_table_control_product_checking_labaratory cannot be reverted.\n";

        return false;
    }
    */
}
