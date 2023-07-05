<?php

use yii\db\Migration;

/**
 * Class m230703_184906_create_table_normative_document
 */
class m230703_184906_create_table_normative_document extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $table_name = 'normative_document'; // set the current table name
        $table = '{{%'.$table_name.'}}'; // leave as it is
        
        $this->createTable($table, [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer(),
            'determination' => $this->string(),
            'name' => $this->text(),
            'activation_date' => $this->integer()->unsigned(),
            'activation_info' => $this->text(),
            'deactivation_date' => $this->integer()->unsigned(),
            'deactivation_info' => $this->text(),

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $table_name = 'normative_document'; // set the current table name
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
        echo "m230703_184906_create_table_normative_document cannot be reverted.\n";

        return false;
    }
    */
}
