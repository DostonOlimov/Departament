<?php

use yii\db\Migration;

/**
 * Class m231009_070938_create_table_laboratory_protocol_content
 */
class m231009_070938_create_table_laboratory_protocol_content extends Migration
{
    const TABLE_NAME = 'laboratory_protocol_content'; // set the current table name
    
    const COL_1 = 'laboratory_protocol_id';
    const COL_2 = 'normative_document_id';
    const COL_3 = 'indicator_name';
    const COL_4 = 'requirement_link';
    const COL_5 = 'requirement_range';
    const COL_6 = 'requirement_min';
    const COL_7 = 'requirement_max';
    const COL_8 = 'current_value';
    const COL_9 = 'unit_om';

    const FTABLE_NAME_1 = 'laboratory_protocol'; // set the current table name
    const FTABLE_NAME_2 = 'normative_document'; // set the current table name
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
    // create
    $this->createTable('{{%'.self::TABLE_NAME.'}}', ['id' => $this->primaryKey()]);
    $this->addColumn('{{%'.self::TABLE_NAME.'}}', self::COL_1,$this->integer());
    $this->addColumn('{{%'.self::TABLE_NAME.'}}', self::COL_2,$this->integer());
    $this->addColumn('{{%'.self::TABLE_NAME.'}}', self::COL_3,$this->string());
    $this->addColumn('{{%'.self::TABLE_NAME.'}}', self::COL_4,$this->string());
    $this->addColumn('{{%'.self::TABLE_NAME.'}}', self::COL_5,$this->integer());
    $this->addColumn('{{%'.self::TABLE_NAME.'}}', self::COL_6,$this->double());
    $this->addColumn('{{%'.self::TABLE_NAME.'}}', self::COL_7,$this->double());
    $this->addColumn('{{%'.self::TABLE_NAME.'}}', self::COL_8,$this->double());
    $this->addColumn('{{%'.self::TABLE_NAME.'}}', self::COL_9,$this->integer());

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
            'fkey-'.self::TABLE_NAME.'-'.self::COL_1, '{{%'.self::TABLE_NAME.'}}');
        $this->dropIndex(
            'index-'.self::TABLE_NAME.'-'.self::COL_1, '{{%'.self::TABLE_NAME.'}}');

        $this->dropForeignKey(
            'fkey-'.self::TABLE_NAME.'-'.self::COL_2, '{{%'.self::TABLE_NAME.'}}');
        $this->dropIndex(
            'index-'.self::TABLE_NAME.'-'.self::COL_2, '{{%'.self::TABLE_NAME.'}}');

        $this->dropTable(self::TABLE_NAME);
    }

}