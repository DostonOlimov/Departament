<?php

use yii\db\Migration;

/**
 * Class m221130_065311_update_table_product_labaratory_checking
 */
class m221130_065311_update_table_product_labaratory_checking extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('control_product_labaratory_checking', 'descreption');
        $this->dropColumn('control_product_labaratory_checking', 'labaratory_checking');
        $this->addColumn('control_product_labaratory_checking', 'description', $this->text());
     
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m221130_065311_update_table_product_labaratory_checking cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221130_065311_update_table_product_labaratory_checking cannot be reverted.\n";

        return false;
    }
    */
}
