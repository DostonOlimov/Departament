<?php

use yii\db\Migration;

/**
 * Class m230220_172308_add_identification_status_control_products
 */
class m230220_172308_add_identification_status_control_products extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('control_primary_data', 'identification_status', $this->integer()->defaultValue(0));
       // $this->addColumn('control_safprimary_data', 'identification_status', $this->integer()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230220_172308_add_identification_status_control_products cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230220_172308_add_identification_status_control_products cannot be reverted.\n";

        return false;
    }
    */
}
