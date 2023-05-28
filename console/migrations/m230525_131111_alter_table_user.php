<?php

use yii\db\Migration;

/**
 * Class m230525_131111_alter_table_user
 */
class m230525_131111_alter_table_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'position_id',$this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230525_131111_alter_table_user cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230525_131111_alter_table_user cannot be reverted.\n";

        return false;
    }
    */
}
