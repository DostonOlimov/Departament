<?php

use yii\db\Migration;

/**
 * Class m221219_071215_add_column_control_measures
 */
class m221219_071215_add_column_control_measures extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('control_measures', 'date');
        $this->dropColumn('control_measures', 'amount');
        $this->dropColumn('control_measures', 'quantity');

        $this->addColumn('control_measures', 'realization_date',$this->integer()->after('control_company_id'));
        $this->addColumn('control_measures', 'realization_number', $this->integer()->after('realization_date'));
       
        $this->addColumn('control_measures', 'band_mjtk', $this->string()->after('fine_amount'));
        $this->addColumn('control_measures', 'explanation_letter', $this->string()->after('band_mjtk'));
        $this->addColumn('control_measures', 'claim', $this->string()->after('explanation_letter'));
        $this->addColumn('control_measures', 'court_letter', $this->string()->after('claim'));

        $this->addColumn('control_measures', 'first_warn_date', $this->integer()->after('court_letter'));
        $this->addColumn('control_measures', 'warn_number', $this->integer()->after('first_warn_date'));
        $this->addColumn('control_measures', 'eco_number', $this->integer()->after('warn_number'));
        $this->addColumn('control_measures', 'eco_date', $this->integer()->after('warn_number'));
        $this->addColumn('control_measures', 'eco_amount', $this->string()->after('eco_number'));
        $this->addColumn('control_measures', 'eco_quantity', $this->string()->after('eco_number'));
    
        $this->alterColumn('control_measures', 'type',$this->string()->after('control_company_id'));
        $this->alterColumn('control_measures', 'ov_date',$this->integer()->after('type'));
        $this->alterColumn('control_measures', 'ov_quantity',$this->integer()->after('ov_date'));
        $this->alterColumn('control_measures', 'ov_name',$this->string()->after('type'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m221219_071215_add_column_control_measures cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221219_071215_add_column_control_measures cannot be reverted.\n";

        return false;
    }
    */
}
