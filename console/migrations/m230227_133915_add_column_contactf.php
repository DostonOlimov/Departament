<?php

use yii\db\Migration;

/**
 * Class m230227_133915_add_column_contactf
 */
class m230227_133915_add_column_contactf extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%court_address}}', [
            'id' => $this->primaryKey(),
            'region_id'=>$this->integer(),
            'name' => $this->string(),

            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->notNull(),
            'created_at' => $this->integer()->unsigned()->notNull(),
            'updated_at' => $this->integer()->unsigned()->notNull(),
        ]);
        $this->addForeignKey('fkey-court_address-region_id','court_address','region_id','regions','id');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%court_address}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230227_133915_add_column_contactf cannot be reverted.\n";

        return false;
    }
    */
}
