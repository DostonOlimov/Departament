<?php

use yii\db\Migration;

/**
 * Class m230104_222135_remove_column_embargo
 */
class m230104_222135_remove_column_embargo extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('caution_embargo', 'supervisor_name');
        $this->dropColumn('caution_embargo', 'inspectors');
        $this->dropColumn('caution_embargo', 'inspector_name');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%caution_embargo}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230104_222135_remove_column_embargo cannot be reverted.\n";

        return false;
    }
    */
}
