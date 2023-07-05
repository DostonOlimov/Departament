<?php

use yii\db\Migration;

/**
 * Class m230703_184811_create_table_gov_control_primary_data
 */
class m230703_184811_create_table_gov_control_primary_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $table_name = 'gov_control_primary_data'; // set the current table name
        $table = '{{%'.$table_name.'}}'; // leave as it is
        
        $this->createTable($table, [
            'id' => $this->primaryKey(),
            'company_type_id' => $this->integer(),
            'gov_control_order_id' => $this->integer(),
            'real_control_date_from' => $this->integer()->unsigned(),
            'real_control_date_to' => $this->integer()->unsigned(),
            'quality_management_system' => $this->integer(),
            'product_exists' => $this->integer()->unsigned(),
            'laboratory_exists' => $this->integer(),
            'last_gov_control_date' => $this->integer()->unsigned(),
            'last_gov_control_number' => $this->string(),
            'comment' => $this->text(),
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
        $table_name = 'gov_control_primary_data'; // set the current table name
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
        echo "m230703_184811_create_table_gov_control_primary_data cannot be reverted.\n";

        return false;
    }
    */
}
