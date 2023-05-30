<?php

use yii\db\Migration;

/**
 * Class m230530_025115_alter_alias_in_user_position
 */
class m230530_025115_alter_alias_in_user_position extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {   
        $this->dropIndex('alias', '{{%user_position}}');
        $this->alterColumn('{{%user_position}}', 'alias', $this->string()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230530_025115_alter_alias_in_user_position cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230530_025115_alter_alias_in_user_position cannot be reverted.\n";

        return false;
    }
    */
}
