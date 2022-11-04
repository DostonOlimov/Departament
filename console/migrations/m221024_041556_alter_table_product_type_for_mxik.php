<?php

use yii\db\Migration;

/**
 * Class m221024_041556_alter_table_product_type_for_mxik
 */
class m221024_041556_alter_table_product_type_for_mxik extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('product_types', 'parent_id');
        $this->dropColumn('product_types', 'group_id');
        $this->dropColumn('product_types', 'position_id');
        $this->dropColumn('product_types', 'class_id');
        $this->dropColumn('product_types', 'under_position_id');

        $this->addColumn('product_types', 'code', $this->string());
        $this->addColumn('product_types', 'position', $this->string());
        $this->addColumn('product_types', 'class', $this->string());
        $this->addColumn('product_types', 'group', $this->string());
        $this->addColumn('product_types', 'sector', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m221024_041556_alter_table_product_type_for_mxik cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221024_041556_alter_table_product_type_for_mxik cannot be reverted.\n";

        return false;
    }
    */
}
