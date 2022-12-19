<?php

use yii\db\Migration;

/**
 * Class m221214_071723_add_codetnved_column_primary_product
 */
class m221214_071723_add_codetnved_column_primary_product extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('control_primary_product', 'codetnved', $this->text());
       
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m221214_071723_add_codetnved_column_primary_product cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221214_071723_add_codetnved_column_primary_product cannot be reverted.\n";

        return false;
    }
    */
}
