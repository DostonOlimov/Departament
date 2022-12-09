<?php

use yii\db\Migration;

/**
 * Class m221116_053421_add_file_column_product_identification
 */
class m221116_053421_add_file_column_product_identification extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->addColumn('control_product_identification', 'file', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m221116_053421_add_file_column_product_identification cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221116_053421_add_file_column_product_identification cannot be reverted.\n";

        return false;
    }
    */
}
