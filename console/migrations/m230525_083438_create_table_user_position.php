<?php

use yii\db\Migration;

/**
 * Class m230525_083438_create_table_user_position
 */
class m230525_083438_create_table_user_position extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_position}}', [
            'id' => $this->primaryKey(),
            'position' => $this->string()->notNull()->unique(),
            'alias' => $this->string()->notNull()->unique(),
            'status' => $this->boolean()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230525_083438_create_table_user_position cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230525_083438_create_table_user_position cannot be reverted.\n";

        return false;
    }
    */
}
