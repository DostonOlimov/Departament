<?php

use yii\db\Migration;

/**
 * Class m221020_074959_alter_table_primary_product
 */
class m221020_074959_alter_table_primary_product extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('control_primary_product', 'residue_amount',$this->string()->Null());
        $this->alterColumn('control_primary_product', 'residue_quantity',$this->string()->Null());
        $this->alterColumn('control_primary_product', 'potency',$this->string()->Null());
        $this->alterColumn('control_primary_product', 'year_amount',$this->string()->Null());
        $this->alterColumn('control_primary_product', 'year_quantity',$this->string()->Null());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m221020_074959_alter_table_primary_product cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221020_074959_alter_table_primary_product cannot be reverted.\n";

        return false;
    }
    */
}
