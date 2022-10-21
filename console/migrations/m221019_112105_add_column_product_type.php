<?php

use yii\db\Migration;

/**
 * Class m221019_112105_add_column_product_type
 */
class m221019_112105_add_column_product_type extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->addColumn('product_types', 'group_id',$this->integer()->defaultValue(1));
        $this->addColumn('product_types', 'position_id',$this->integer()->defaultValue(3));
        $this->addColumn('product_types', 'under_position_id',$this->integer()->defaultValue(4));
        $this->addColumn('product_types', 'class_id',$this->integer()->defaultValue(2));

        $this->dropForeignKey('fk-pro_answers-product_type_id', 'pro_answers');
        $this->dropIndex('idx-pro_answers-product_type_id', 'pro_answers');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m221019_112105_add_column_product_type cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221019_112105_add_column_product_type cannot be reverted.\n";

        return false;
    }
    */
}
