<?php

use yii\db\Migration;

/**
 * Class m230104_194648_alter_column_embargo
 */
class m230104_194648_alter_column_embargo extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn("caution_embargo", "created_by", $this->integer()->notNull());
        $this->addColumn("caution_embargo", "updated_by", $this->integer()->notNull());
        $this->addColumn("caution_embargo", "created_at", $this->integer()->unsigned()->notNull());
        $this->addColumn("caution_embargo", "updated_at", $this->integer()->unsigned()->notNull());
        $this->createIndex('index-caution_embargo-created_by', 'caution_embargo', 'created_by');
        $this->createIndex('index-caution_embargo-updated_by', 'caution_embargo', 'updated_by');
        $this->addForeignKey('fkey-caution_embargo-created_by-user_id', 'caution_embargo', 'created_by', 'user', 'id', 'RESTRICT', 'RESTRICT');        
        $this->addForeignKey('fkey-caution_embargo-updated_by-user_id_', 'caution_embargo', 'updated_by', 'user', 'id', 'RESTRICT', 'RESTRICT');    
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
        echo "m230104_194648_alter_column_embargo cannot be reverted.\n";

        return false;
    }
    */
}
