<?php

use yii\db\Migration;

/**
 * Class m230808_192211_drop_table_document_status
 */
class m230808_192211_drop_table_document_status extends Migration
{
    const TABLE_NAME = 'document_status'; // set the current table name
    const COL_1 = 'gov_control_program_id';
    const COL_2 = 'gov_control_order_id';
    const COL_3 = 'gov_control_primary_data_id';
    
    const FTABLE_NAME_1 = 'gov_control_program'; // set the current table name
    const FTABLE_NAME_2 = 'gov_control_order'; // set the current table name
    const FTABLE_NAME_3 = 'gov_control_primary_data'; // set the current table name
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
// drop
        $this->dropForeignKey(
            'fkey-'.self::TABLE_NAME.'-'.self::COL_1, 
            '{{%'.self::TABLE_NAME.'}}');
        $this->dropIndex(
            'index-'.self::TABLE_NAME.'-'.self::COL_1, 
            '{{%'.self::TABLE_NAME.'}}');
        $this->dropColumn('{{%'.self::TABLE_NAME.'}}', self::COL_1);
// drop
        $this->dropForeignKey(
            'fkey-'.self::TABLE_NAME.'-'.self::COL_2, 
            '{{%'.self::TABLE_NAME.'}}');
        $this->dropIndex(
            'index-'.self::TABLE_NAME.'-'.self::COL_2, 
            '{{%'.self::TABLE_NAME.'}}');
        $this->dropColumn('{{%'.self::TABLE_NAME.'}}', self::COL_2);
// drop
        $this->dropForeignKey(
            'fkey-'.self::TABLE_NAME.'-'.self::COL_3, 
            '{{%'.self::TABLE_NAME.'}}');
        $this->dropIndex(
            'index-'.self::TABLE_NAME.'-'.self::COL_3, 
            '{{%'.self::TABLE_NAME.'}}');
        $this->dropColumn('{{%'.self::TABLE_NAME.'}}', self::COL_3);

// drop
        $this->dropTable(self::TABLE_NAME);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    // add
    $this->createTable('{{%'.self::TABLE_NAME.'}}', [
        'id' => $this->integer()->notNull(),
        'document_number' => $this->string(255),
        'status' => $this->integer(),
        'comment' => $this->integer(),
        'created_at' => $this->integer()->unsigned(),
        'updated_at' => $this->integer()->unsigned(),
        'created_by' => $this->integer(),
        'updated_by' => $this->integer(),
    ]);
    // add
        $this->addColumn('{{%'.self::TABLE_NAME.'}}', self::COL_1,$this->integer());
        $this->createIndex(
            'index-'.self::TABLE_NAME.'-'.self::COL_1, 
            '{{%'.self::TABLE_NAME.'}}', self::COL_1);
        $this->addForeignKey(
            'fkey-'.self::TABLE_NAME.'-'.self::COL_1, 
            '{{%'.self::TABLE_NAME.'}}', self::COL_1, 
            '{{%'.self::FTABLE_NAME_1.'}}', 'id', 'CASCADE', 'CASCADE');
    // add
        $this->addColumn('{{%'.self::TABLE_NAME.'}}', self::COL_2,$this->integer());
        $this->createIndex(
            'index-'.self::TABLE_NAME.'-'.self::COL_2, 
            '{{%'.self::TABLE_NAME.'}}', self::COL_2);
        $this->addForeignKey(
            'fkey-'.self::TABLE_NAME.'-'.self::COL_2, 
            '{{%'.self::TABLE_NAME.'}}', self::COL_2, 
            '{{%'.self::FTABLE_NAME_2.'}}', 'id', 'CASCADE', 'CASCADE');
    // add
        $this->addColumn('{{%'.self::TABLE_NAME.'}}', self::COL_3,$this->integer());
        $this->createIndex(
            'index-'.self::TABLE_NAME.'-'.self::COL_3, 
            '{{%'.self::TABLE_NAME.'}}', self::COL_3);
        $this->addForeignKey(
            'fkey-'.self::TABLE_NAME.'-'.self::COL_3, 
            '{{%'.self::TABLE_NAME.'}}', self::COL_3, 
            '{{%'.self::FTABLE_NAME_3.'}}', 'id', 'CASCADE', 'CASCADE');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230808_192211_drop_table_document_status cannot be reverted.\n";

        return false;
    }
    */
}
