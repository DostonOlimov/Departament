<?php

use yii\db\Migration;

/**
 * Class m230217_122049_update_shopping_products_table
 */
class m230217_122049_update_shopping_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230217_122049_update_shopping_products_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230217_122049_update_shopping_products_table cannot be reverted.\n";

        return false;
    }
    */
}
