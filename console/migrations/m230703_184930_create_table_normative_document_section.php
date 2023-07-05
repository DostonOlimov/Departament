<?php

use yii\db\Migration;

/**
 * Class m230703_184930_create_table_normative_document_section
 */
class m230703_184930_create_table_normative_document_section extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $table_name = 'normative_document_section'; // set the current table name
        $table = '{{%'.$table_name.'}}'; // leave as it is
        
        $this->createTable($table, [
            'id' => $this->primaryKey(),
            'normative_document_id' => $this->integer(),
            'section_category_id' => $this->string(),
            'section_number' => $this->string(),
            'section_name' => $this->integer(),
        ]);
        
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
        $table_name = 'normative_document_section'; // set the current table name
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
        echo "m230703_184930_create_table_normative_document_section cannot be reverted.\n";

        return false;
    }
    */
}
