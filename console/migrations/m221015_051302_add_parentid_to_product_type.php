<?php

use yii\db\Migration;

/**
 * Class m221015_051302_add_parentid_to_product_type
 */
class m221015_051302_add_parentid_to_product_type extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('product_types', 'parent_id',$this->integer()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m221015_051302_add_parentid_to_product_type cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221015_051302_add_parentid_to_product_type cannot be reverted.\n";

        return false;
    }
    */
}
