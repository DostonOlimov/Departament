<?php

use yii\db\Migration;

/**
 * Class m230717_111918_alter_table_risk_analisys
 */
class m230717_111918_alter_table_risk_analisys extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $table_name = 'risk_analisys'; // set the current table name
        $table = '{{%'.$table_name.'}}'; // leave as it is
        $col = 'summary_user_id'; // can be cloned while creating fkey or index
        $ftable_name = 'user'; // can be cloned while creating fkey or index
        $ftable = '{{%'.$ftable_name.'}}'; // can be cloned while creating fkey or index
        $fcol = 'id'; // can be cloned while creating fkey or index

        $this->addColumn($table, $col, $this->integer());
        $this->createIndex('index-'.$table_name.'-'.$col, $table, $col);
        $this->addForeignKey('fkey-'.$table_name.'-'.$col, $table, $col, $ftable, $fcol, 'CASCADE', 'CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $table_name = 'risk_analisys'; // set the current table name
        $table = '{{%'.$table_name.'}}'; // leave as it is
        $col = 'summary_user_id'; // can be cloned while creating fkey or index
        $ftable_name = 'user'; // can be cloned while creating fkey or index
        $ftable = '{{%'.$ftable_name.'}}'; // can be cloned while creating fkey or index
        $fcol = 'id'; // can be cloned while creating fkey or index
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
        echo "m230717_111918_alter_table_risk_analisys cannot be reverted.\n";

        return false;
    }
    */
}
