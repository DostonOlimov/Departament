<?php

use yii\db\Migration;

/**
 * Class m230810_022347_create_table_program_property
 */
class m230810_022347_create_table_program_property extends Migration
{
    const TABLE_NAME = 'program_property'; // set the current table name
    const COL_1 = 'gov_control_program_id';
    const COL_2 = 'program_data_id';
    
    const FTABLE_NAME_1 = 'gov_control_program'; // set the current table name
    const FTABLE_NAME_2 = 'program_data'; // set the current table name
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
    // add
    $this->createTable('{{%'.self::TABLE_NAME.'}}', [
        'id' => $this->primaryKey(),
        'gov_control_program_id' => $this->integer(),
        'program_data_id' => $this->integer(),
        
        'created_at' => $this->integer()->unsigned(),
        'updated_at' => $this->integer()->unsigned(),
        'created_by' => $this->integer(),
        'updated_by' => $this->integer(),
    ]);
    // add
    $this->createIndex(
        'index-'.self::TABLE_NAME.'-'.self::COL_1, 
        '{{%'.self::TABLE_NAME.'}}', self::COL_1);
    $this->addForeignKey(
        'fkey-'.self::TABLE_NAME.'-'.self::COL_1, 
        '{{%'.self::TABLE_NAME.'}}', self::COL_1, 
        '{{%'.self::FTABLE_NAME_1.'}}', 'id', 'CASCADE', 'CASCADE');
    // add
    $this->createIndex(
        'index-'.self::TABLE_NAME.'-'.self::COL_2, 
        '{{%'.self::TABLE_NAME.'}}', self::COL_2);
    $this->addForeignKey(
        'fkey-'.self::TABLE_NAME.'-'.self::COL_2, 
        '{{%'.self::TABLE_NAME.'}}', self::COL_2, 
        '{{%'.self::FTABLE_NAME_2.'}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drop
        $this->dropForeignKey(
            'fkey-'.self::TABLE_NAME.'-'.self::COL_1, 
            '{{%'.self::TABLE_NAME.'}}');
        $this->dropIndex(
            'index-'.self::TABLE_NAME.'-'.self::COL_1, 
            '{{%'.self::TABLE_NAME.'}}');
        // drop
        $this->dropForeignKey(
            'fkey-'.self::TABLE_NAME.'-'.self::COL_2, 
            '{{%'.self::TABLE_NAME.'}}');
        $this->dropIndex(
            'index-'.self::TABLE_NAME.'-'.self::COL_2, 
            '{{%'.self::TABLE_NAME.'}}');
        // drop
        $this->dropTable(self::TABLE_NAME);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230810_022347_create_table_program_property cannot be reverted.\n";

        return false;
    }
    */
}
