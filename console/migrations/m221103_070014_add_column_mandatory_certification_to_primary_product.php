<?php

use yii\db\Migration;

/**
 * Class m221103_070014_add_column_mandatory_certification_to_primary_product
 */
class m221103_070014_add_column_mandatory_certification_to_primary_product extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
       // $this->dropForeignKey('fkey-mandatory_certification-control_primary_product_id', 'mandatory_certification');
        //$this->dropIndex('index-mandatory_certification-control_primary_product_id', 'mandatory_certification');

        $this->addColumn('control_primary_product', 'number_blank', $this->string());
        $this->addColumn('control_primary_product', 'number_reestr', $this->string());
        $this->addColumn('control_primary_product', 'date_from', $this->integer());
        $this->addColumn('control_primary_product', 'date_to', $this->integer());

        $this->dropTable('mandatory_certification');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m221103_070014_add_column_mandatory_certification_to_primary_product cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221103_070014_add_column_mandatory_certification_to_primary_product cannot be reverted.\n";

        return false;
    }
    */
}
