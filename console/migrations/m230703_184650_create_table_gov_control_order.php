<?php

use yii\db\Migration;

/**
 * Class m230703_184650_create_table_gov_control_order
 */
class m230703_184650_create_table_gov_control_order extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $table_name = 'gov_control_order'; // set the current table name
        $table = '{{%'.$table_name.'}}'; // leave as it is
        
        $this->createTable($table, [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer(),
            'gov_control_program_id' => $this->integer(),
            'control_period_from' => $this->integer()->unsigned(),
            'control_period_to' => $this->integer()->unsigned(),
            'control_date_from' => $this->integer()->unsigned(),
            'control_date_to' => $this->integer()->unsigned(),
            'control_days_number' => $this->integer(),
            'ombudsman_code_date' => $this->integer()->unsigned(),
            'ombudsman_code_number' => $this->string(),
        ]);
        
        $col = 'parent_id'; // can be cloned while creating fkey or index
        $ftable_name = $table_name; // can be cloned while creating fkey or index
        $ftable = '{{%'.$ftable_name.'}}'; // can be cloned while creating fkey or index
        $fcol = 'id'; // can be cloned while creating fkey or index

        $this->createIndex('index-'.$table_name.'-'.$col, $table, $col);
        $this->addForeignKey('fkey-'.$table_name.'-'.$col, $table, $col, $ftable, $fcol, 'CASCADE', 'CASCADE');

        $col = 'gov_control_program_id'; // can be cloned while creating fkey or index
        $ftable_name = 'gov_control_program'; // can be cloned while creating fkey or index
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
        $table_name = 'gov_control_order'; // set the current table name
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
        echo "m230703_184650_create_table_gov_control_order cannot be reverted.\n";

        return false;
    }
    */
}
