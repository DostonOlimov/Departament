<?php

use yii\db\Migration;

/**
 * Class m221019_105141_create_control_primary_product_nd
 */
class m221019_105141_create_control_primary_product_nd extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->createTable('control_primary_product_nd', [
            'id' => $this->primaryKey(),
            'control_primary_product_id' => $this->integer(),
            'name' => $this->string(),
            'type_id' => $this->integer(),
        ]);
        $this->addForeignKey('fk_nd_primary_product', 'control_primary_product_nd', 'control_primary_product_id', 'control_primary_product', 'id');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m221019_105141_create_control_primary_product_nd cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221019_105141_create_control_primary_product_nd cannot be reverted.\n";

        return false;
    }
    */
}
