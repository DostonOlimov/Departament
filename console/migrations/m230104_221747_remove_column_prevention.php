<?php

use yii\db\Migration;

/**
 * Class m230104_221747_remove_column_prevention
 */
class m230104_221747_remove_column_prevention extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('caution_prevention', 'message_num');
        $this->dropColumn('caution_prevention', 'inspectors');
        $this->dropColumn('caution_prevention', 'inspector_name');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%caution_prevention}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230104_221747_remove_column_prevention cannot be reverted.\n";

        return false;
    }
    */
}
