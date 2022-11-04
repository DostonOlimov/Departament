<?php

use yii\db\Migration;

/**
 * Class m221024_154657_add_sector_id_to_control_product
 */
class m221024_154657_add_sector_id_to_control_product extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('product_types', 'sector');
        $this->dropColumn('control_primary_product', 'product_type_parent_id');

        $this->addColumn('control_primary_product', 'sector_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m221024_154657_add_sector_id_to_control_product cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221024_154657_add_sector_id_to_control_product cannot be reverted.\n";

        return false;
    }
    */
}
