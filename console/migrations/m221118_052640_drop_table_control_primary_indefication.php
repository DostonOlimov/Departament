<?php

use yii\db\Migration;

/**
 * Class m221118_052640_drop_table_control_primary_indefication
 */
class m221118_052640_drop_table_control_primary_indefication extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('control_primary_product', 'select_of_exsamle_purpose');

        $this->dropForeignKey('fkey-control_product_identification-control_primary_data', 'control_product_identification');
        $this->dropForeignKey('fkey-control_product_identification-control_primary_product', 'control_product_identification');
        $this->dropTable('control_product_identification');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m221118_052640_drop_table_control_primary_indefication cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221118_052640_drop_table_control_primary_indefication cannot be reverted.\n";

        return false;
    }
    */
}
