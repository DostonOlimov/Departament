<?php

use yii\db\Migration;

/**
 * Class m230703_184833_create_table_act_selection
 */
class m230703_184833_create_table_act_selection extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $table_name = 'act_selection'; // set the current table name
        $table = '{{%'.$table_name.'}}'; // leave as it is
        
        $this->createTable($table, [
            'id' => $this->primaryKey(),
            'gov_control_order_id' => $this->integer(),
        ]);
        
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
        $table_name = 'act_selection'; // set the current table name
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
        echo "m230703_184833_create_table_act_selection cannot be reverted.\n";

        return false;
    }
    */
}
