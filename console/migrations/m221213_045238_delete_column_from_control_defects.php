<?php

use yii\db\Migration;

/**
 * Class m221213_045238_delete_column_from_control_defects
 */
class m221213_045238_delete_column_from_control_defects extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('control_defects', 'compliance_quantity');
        $this->dropColumn('control_defects', 'compliance_cost');
        $this->dropColumn('control_defects', 'tex_quantity');
        $this->dropColumn('control_defects', 'tex_cost');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m221213_045238_delete_column_from_control_defects cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221213_045238_delete_column_from_control_defects cannot be reverted.\n";

        return false;
    }
    */
}
