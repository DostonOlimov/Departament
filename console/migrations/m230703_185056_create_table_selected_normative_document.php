<?php

use yii\db\Migration;

/**
 * Class m230703_185056_create_table_selected_normative_document
 */
class m230703_185056_create_table_selected_normative_document extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $table_name = 'selected_normative_document'; // set the current table name
        $table = '{{%'.$table_name.'}}'; // leave as it is
        
        $this->createTable($table, [
            'id' => $this->primaryKey(),
            'identification_id' => $this->integer(),
            'normative_document_id' => $this->integer(),
        ]);
        
        $col = 'identification_id'; // can be cloned while creating fkey or index
        $ftable_name = 'identification'; // can be cloned while creating fkey or index
        $ftable = '{{%'.$ftable_name.'}}'; // can be cloned while creating fkey or index
        $fcol = 'id'; // can be cloned while creating fkey or index

        $this->createIndex('index-'.$table_name.'-'.$col, $table, $col);
        $this->addForeignKey('fkey-'.$table_name.'-'.$col, $table, $col, $ftable, $fcol, 'CASCADE', 'CASCADE');

        $col = 'normative_document_id'; // can be cloned while creating fkey or index
        $ftable_name = 'normative_document'; // can be cloned while creating fkey or index
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
        $table_name = 'selected_normative_document'; // set the current table name
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
        echo "m230703_185056_create_table_selected_normative_document cannot be reverted.\n";

        return false;
    }
    */
}
