<?php

use yii\db\Migration;

/**
 * Class m230305_153447_create_table_company
 */
class m230305_153447_create_table_company extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    { $this->createTable('{{%company}}',[
        'id' => $this->primaryKey(),
        'stir' => $this->integer()->notNull(),
        'company_name' => $this->string()->notNull(),
        'registration_date' => $this->integer()->unsigned()->notNull(),
        'region_id' => $this->integer()->notNull(),
        'address' => $this->string()->notNull(),
        'thsht' => $this->integer()->notNull(),
        'ifut' => $this->integer()->notNull(),
        'ownername' => $this->string()->notNull(),
        'phone' => $this->bigInteger()->notNull(),
        'status'=>$this->integer()->notNull(),

        'created_by' => $this->integer()->notNull(),
        'updated_by' => $this->integer()->notNull(),
        'created_at' => $this->integer()->unsigned()->notNull(),
        'updated_at' => $this->integer()->unsigned()->notNull(),
    ]);
    $this->createIndex('index-company-stir', '{{%company}}', 'stir');
    $this->createIndex('index-company-name', '{{%company}}', 'company_name');
    $this->createIndex('index-company-ifut', '{{%company}}', 'ifut');
    $this->createIndex('index-company-status', '{{%company}}', 'status');

    $this->createIndex('index-company-region_id', '{{%company}}', 'region_id');
    $this->addForeignKey('fkey-company-region_id', '{{%company}}', 'region_id', 'regions', 'id', 'CASCADE', 'CASCADE');
    
    $this->createIndex('index-company-created_by', '{{%company}}', 'created_by');
    $this->addForeignKey('fkey-company-created_by', '{{%company}}', 'created_by', 'user', 'id', 'CASCADE', 'CASCADE');
    $this->createIndex('index-company-updated_by', '{{%company}}', 'updated_by');
    $this->addForeignKey('fkey-company-updated_by', '{{%company}}', 'updated_by', 'user', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%company}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230305_153447_create_table_company cannot be reverted.\n";

        return false;
    }
    */
}
