<?php

use yii\db\Migration;

/**
 * Class m230703_185135_alter_table_document_status
 */
class m230703_185135_alter_table_document_status extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $table_name = 'identification_content'; // set the current table name
        $table = '{{%'.$table_name.'}}'; // leave as it is

        $this->addColumn($table, 'gov_control_primary_data_id',$this->integer());

        $col = 'gov_control_primary_data_id'; // can be cloned while creating fkey or index
        $ftable_name = 'gov_control_primary_data'; // can be cloned while creating fkey or index
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
        $table_name = 'identification_content'; // set the current table name
        $table = '{{%'.$table_name.'}}'; // leave as it is
        $col = 'gov_control_primary_data_id';
        $iname = 'index-'.$table_name.'-'.$col;
        $fkname = 'fkey-'.$table_name.'-'.$col;

        $this->dropForeignKey($fkname, $table);
        $this->dropIndex($iname, $table);
        $this->dropColumn($table, $col);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230703_185135_alter_table_document_status cannot be reverted.\n";

        return false;
    }
    */
}
