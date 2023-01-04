<?php

use yii\db\Migration;

/**
 * Class m230104_094305_add_column_embargo
 */
class m230104_094305_add_column_embargo extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn("caution_embargo", "supervisor_name", $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230104_094305_add_column_embargo cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230104_094305_add_column_embargo cannot be reverted.\n";

        return false;
    }
    */
}
