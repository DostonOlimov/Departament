<?php

use yii\db\Migration;

/**
 * Class m221019_102524_add_column_mandatory_certification
 */
class m221019_102524_add_column_mandatory_certification extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('mandatory_certification', 'control_primary_product_id', $this->integer()->defaultValue(0));
        $this->addColumn('mandatory_certification', 'number_blank', $this->string());
        $this->addColumn('mandatory_certification', 'number_reestr', $this->string());
        $this->addColumn('mandatory_certification', 'date_from', $this->integer());
        $this->addColumn('mandatory_certification', 'date_to', $this->integer());
        $this->delete('mandatory_certification', 'certificate_number');
        $this->delete('mandatory_certification', 'period_of_validity');
        $this->addForeignKey('fk_mandatory_certification_primary_product', 'mandatory_certification', 'control_primary_product_id', 'control_primary_product', 'id');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m221019_102524_add_column_mandatory_certification cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221019_102524_add_column_mandatory_certification cannot be reverted.\n";

        return false;
    }
    */
}
