<?php

use yii\db\Migration;

/**
 * Class m230703_184733_create_table_attached_executor
 */
class m230703_184733_create_table_attached_executor extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $table_name = 'attached_executor'; // set the current table name
        $table = '{{%'.$table_name.'}}'; // leave as it is
        
        $this->createTable($table, [
            'id' => $this->primaryKey(),
            'status' => $this->integer(),
            'user_id' => $this->integer()->notNull(),
            'comment' => $this->text(),
            'attached_at' => $this->integer()->unsigned(),
            'detached_at' => $this->integer()->unsigned(),
            'detached_comment' => $this->integer(),
            'gov_control_order_id' => $this->integer(),
        ]);
        
        $col = 'user_id'; // can be cloned while creating fkey or index
        $ftable_name = 'user'; // can be cloned while creating fkey or index
        $ftable = '{{%'.$ftable_name.'}}'; // can be cloned while creating fkey or index
        $fcol = 'id'; // can be cloned while creating fkey or index

        $this->createIndex('index-'.$table_name.'-'.$col, $table, $col);
        $this->addForeignKey('fkey-'.$table_name.'-'.$col, $table, $col, $ftable, $fcol, 'CASCADE', 'CASCADE');

        $col = 'gov_control_order_id'; // can be cloned while creating fkey or index
        $ftable_name = 'gov_control_order'; // can be cloned while creating fkey or index
        $ftable = '{{%'.$ftable_name.'}}'; // can be cloned while creating fkey or index
        $fcol = 'id'; // can be cloned while creating fkey or index

        $this->createIndex('index-'.$table_name.'-'.$col, $table, $col);
        $this->addForeignKey('fkey-'.$table_name.'-'.$col, $table, $col, $ftable, $fcol, 'CASCADE', 'CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $table_name = 'attached_executor'; // set the current table name
        $table = '{{%'.$table_name.'}}'; // leave as it is

        $this->dropTable($table);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230703_184733_create_table_attached_executor cannot be reverted.\n";

        return false;
    }
    */
}
