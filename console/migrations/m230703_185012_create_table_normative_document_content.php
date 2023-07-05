<?php

use yii\db\Migration;

/**
 * Class m230703_185012_create_table_normative_document_content
 */
class m230703_185012_create_table_normative_document_content extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $table_name = 'normative_document_content'; // set the current table name
        $table = '{{%'.$table_name.'}}'; // leave as it is
        
        $this->createTable($table, [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer(),
            'document_section_id' => $this->integer(),
            'content' => $this->text(),
            'position' => $this->integer()->defaultValue(0),
        ]);
        
        $col = 'document_section_id'; // can be cloned while creating fkey or index
        $ftable_name = 'normative_document_section'; // can be cloned while creating fkey or index
        $ftable = '{{%'.$ftable_name.'}}'; // can be cloned while creating fkey or index
        $fcol = 'id'; // can be cloned while creating fkey or index

        $this->createIndex('index-'.$table_name.'-'.$col, $table, $col);
        $this->addForeignKey('fkey-'.$table_name.'-'.$col, $table, $col, $ftable, $fcol, 'CASCADE', 'CASCADE');

        $col = 'parent_id'; // can be cloned while creating fkey or index
        $ftable_name = $table_name; // can be cloned while creating fkey or index
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
        $table_name = 'normative_document_content'; // set the current table name
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
        echo "m230703_185012_create_table_normative_document_content cannot be reverted.\n";

        return false;
    }
    */
}
