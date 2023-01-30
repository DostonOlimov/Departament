<?php

use yii\db\Migration;

/**
 * Class m230129_151349_add_column_primary_ov
 */
class m230129_151349_add_column_primary_ov extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn("control_primary_ovs", "uncompared", $this->string());
        $this->addColumn("control_primary_ovs", "expired", $this->string());
        $this->addColumn("control_primary_ovs", "unworked", $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230129_151349_add_column_primary_ov cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230129_151349_add_column_primary_ov cannot be reverted.\n";

        return false;
    }
    */
}
