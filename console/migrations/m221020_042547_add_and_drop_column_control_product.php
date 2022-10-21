<?php

use yii\db\Migration;

/**
 * Class m221020_042547_add_and_drop_column_control_product
 */
class m221020_042547_add_and_drop_column_control_product extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('control_primary_data', 'residue_quantity');
        $this->dropColumn('control_primary_data', 'year_quantity');
        $this->dropColumn('control_primary_data', 'year_amount');
        $this->dropColumn('control_primary_data', 'potency');
        $this->dropColumn('control_primary_data', 'residue_amount');

        $this->dropColumn('control_primary_product', 'nd');
        $this->dropColumn('control_primary_product', 'nd_type');
        $this->dropColumn('control_primary_product', 'number_blank');
        $this->dropColumn('control_primary_product', 'number_reestr');
        $this->dropColumn('control_primary_product', 'date_from');
        $this->dropColumn('control_primary_product', 'date_to');

        $this->dropColumn('mandatory_certification', 'certificate_number');
        $this->dropColumn('mandatory_certification', 'period_of_validity');

        $this->addColumn('control_primary_product', 'group_id', $this->integer());
        $this->addColumn('control_primary_product', 'class_id', $this->integer());
        $this->addColumn('control_primary_product', 'position_id', $this->integer());
        $this->addColumn('control_primary_product', 'under_position_id', $this->integer());
        $this->addColumn('control_primary_product', 'residue_amount', $this->integer());
        $this->addColumn('control_primary_product', 'residue_quantity', $this->integer());
        $this->addColumn('control_primary_product', 'potency', $this->integer());
        $this->addColumn('control_primary_product', 'year_amount', $this->integer());
        $this->addColumn('control_primary_product', 'year_quantity', $this->integer());


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m221020_042547_add_and_drop_column_control_product cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221020_042547_add_and_drop_column_control_product cannot be reverted.\n";

        return false;
    }
    */
}
