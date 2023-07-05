<?php

use yii\db\Migration;

/**
 * Class m230703_184850_create_table_selected_product
 */
class m230703_184850_create_table_selected_product extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $table_name = 'selected_product'; // set the current table name
        $table = '{{%'.$table_name.'}}'; // leave as it is
        
        $this->createTable($table, [
            'id' => $this->primaryKey(),
            'act_selection_id' => $this->integer(),
            'name' => $this->string(),
            'batch_number' => $this->string(),
            'ctry_ogn_code' => $this->integer(),
            'mfr_name' => $this->string(),
            'mfr_id' => $this->integer(),
            'mfrd_date' => $this->integer()->unsigned(),
            'exptr_ctry_code' => $this->integer(),
            'imptr_name' => $this->string(),
            'imptr_id' => $this->integer(),
            'prod_netto' => $this->double(),
            'xtra_value' => $this->double(),
            'xtra_unit_om' => $this->integer(),
            'cnfea_code' => $this->string(),
            'bar_code' => $this->string(),
        ]);
        
        $col = 'act_selection_id'; // can be cloned while creating fkey or index
        $ftable_name = 'act_selection'; // can be cloned while creating fkey or index
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
        $table_name = 'selected_product'; // set the current table name
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
        echo "m230703_184850_create_table_selected_product cannot be reverted.\n";

        return false;
    }
    */
}
