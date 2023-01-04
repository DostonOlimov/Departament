<?php

use yii\db\Migration;

/**
 * Class m230104_202417_add_column_prevention
 */
class m230104_202417_add_column_prevention extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn("caution_prevention", "created_by", $this->integer()->notNull());
        $this->addColumn("caution_prevention", "updated_by", $this->integer()->notNull());
        $this->addColumn("caution_prevention", "created_at", $this->integer()->unsigned()->notNull());
        $this->addColumn("caution_prevention", "updated_at", $this->integer()->unsigned()->notNull());
        $this->createIndex('index-caution_prevention-created_by', 'caution_prevention', 'created_by');
        $this->createIndex('index-caution_prevention-updated_by', 'caution_prevention', 'updated_by');
        $this->addForeignKey('fkey-caution_prevention-created_by-user_id', 'caution_prevention', 'created_by', 'user', 'id', 'RESTRICT', 'RESTRICT');        
        $this->addForeignKey('fkey-caution_prevention-updated_by-user_id_', 'caution_prevention', 'updated_by', 'user', 'id', 'RESTRICT', 'RESTRICT');    
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
        echo "m230104_202417_add_column_prevention cannot be reverted.\n";

        return false;
    }
    */
}
