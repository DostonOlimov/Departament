<?php

use yii\db\Migration;

/**
 * Class m221115_072722_delete_might_be_broken_letter
 */
class m221115_072722_delete_might_be_broken_letter extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('control_instructions', 'might_be_breakdown_letter');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m221115_072722_delete_might_be_broken_letter cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221115_072722_delete_might_be_broken_letter cannot be reverted.\n";

        return false;
    }
    */
}
