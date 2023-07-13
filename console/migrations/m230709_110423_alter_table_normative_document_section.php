<?php

use yii\db\Migration;

/**
 * Class m230709_110423_alter_table_normative_document_section
 */
class m230709_110423_alter_table_normative_document_section extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $table_name = 'normative_document_section'; // set the current table name
        $table = '{{%'.$table_name.'}}'; // leave as it is
        $this->alterColumn($table, 'section_name', $this->string());
        $this->alterColumn($table, 'section_category_id', $this->integer());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $table_name = 'normative_document_section'; // set the current table name
        $table = '{{%'.$table_name.'}}'; // leave as it is
        $this->alterColumn($table, 'section_name', $this->integer());
        $this->alterColumn($table, 'section_category_id', $this->string());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230709_110423_alter_table_normative_document_section cannot be reverted.\n";

        return false;
    }
    */
}
