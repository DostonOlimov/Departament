<?php

use yii\db\Migration;

/**
 * Class m230206_123134_update_shopping_products_table
 */
class m230206_123134_update_shopping_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('shopping_products', 'cost');
        $this->addColumn("shopping_products", "sum", $this->string());
        $this->addColumn("shopping_products", "purchase_date", $this->string());
        $this->addColumn("shopping_products", "production_date", $this->string());
        $this->addColumn("shopping_products", "product_lot", $this->string());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230206_123134_update_shopping_products_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230206_123134_update_shopping_products_table cannot be reverted.\n";

        return false;
    }
    */
}
