<?php

use yii\db\Migration;

/**
 * Class m221117_163518_add_labaratory_checking_to_control_product
 */
class m221117_163518_add_labaratory_checking_to_control_product extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
       $this->addColumn('control_primary_product', 'labaratory_checking', $this->integer());
        $this->addColumn('control_primary_product', 'certification', $this->integer());
       $this->addColumn('control_primary_product', 'photo', $this->string());
      
       // $this->alterColumn('control_primary_product', 'residue_amount',$this->integer());
      //  $this->alterColumn('control_primary_product', 'residue_quantity',$this->integer());
      //  $this->alterColumn('control_primary_product', 'year_amount',$this->integer());
      //  $this->alterColumn('control_primary_product', 'year_quantity',$this->integer());
      //  $this->alterColumn('control_primary_product', 'potency',$this->integer());
       
        $this->dropColumn('control_primary_product', 'number_blank');
        $this->dropColumn('control_primary_product', 'number_reestr');
        $this->dropColumn('control_primary_product', 'date_to');
        $this->dropColumn('control_primary_product', 'date_from');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m221117_163518_add_labaratory_checking_to_control_product cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221117_163518_add_labaratory_checking_to_control_product cannot be reverted.\n";

        return false;
    }
    */
}
