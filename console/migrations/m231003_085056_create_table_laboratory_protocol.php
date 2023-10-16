<?php

use yii\db\Migration;

/**
 * Class m231003_085056_create_table_laboratory_protocol
 */
class m231003_085056_create_table_laboratory_protocol extends Migration
{
    const TABLE_NAME = 'laboratory_protocol'; // set the current table name

    const COL_1 = 'selected_product_id';
    const COL_2 = 'laboratory_id';
    const COL_3 = 'delivery_date';
    const COL_4 = 'protocol_number';
    const COL_5 = 'protocol_date';
    const COL_6 = 'status';
    const COL_7 = 'created_at';
    const COL_8 = 'updated_at';
    const COL_9 = 'created_by';
    const COL_10 = 'updated_by';

    const FTABLE_NAME_1 = 'selected_product'; // set the current table name
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
    // create
    $this->createTable('{{%'.self::TABLE_NAME.'}}', ['id' => $this->primaryKey()]);

    $this->addColumn('{{%'.self::TABLE_NAME.'}}', self::COL_1,$this->integer());
    $this->addColumn('{{%'.self::TABLE_NAME.'}}', self::COL_2,$this->integer());
    $this->addColumn('{{%'.self::TABLE_NAME.'}}', self::COL_3,$this->integer()->unsigned());
    $this->addColumn('{{%'.self::TABLE_NAME.'}}', self::COL_4,$this->string());
    $this->addColumn('{{%'.self::TABLE_NAME.'}}', self::COL_5,$this->integer()->unsigned());
    $this->addColumn('{{%'.self::TABLE_NAME.'}}', self::COL_6,$this->integer());
    $this->addColumn('{{%'.self::TABLE_NAME.'}}', self::COL_7,$this->integer()->unsigned());
    $this->addColumn('{{%'.self::TABLE_NAME.'}}', self::COL_8,$this->integer()->unsigned());
    $this->addColumn('{{%'.self::TABLE_NAME.'}}', self::COL_9,$this->integer());
    $this->addColumn('{{%'.self::TABLE_NAME.'}}', self::COL_10,$this->integer());

    // add
    $this->createIndex(
        'index-'.self::TABLE_NAME.'-'.self::COL_1, 
        '{{%'.self::TABLE_NAME.'}}', self::COL_1);
    $this->addForeignKey(
        'fkey-'.self::TABLE_NAME.'-'.self::COL_1, 
        '{{%'.self::TABLE_NAME.'}}', self::COL_1, 
        '{{%'.self::FTABLE_NAME_1.'}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function safeDown()
    {
        // drop
        $this->dropForeignKey(
            'fkey-'.self::TABLE_NAME.'-'.self::COL_1, '{{%'.self::TABLE_NAME.'}}');
        $this->dropIndex(
            'index-'.self::TABLE_NAME.'-'.self::COL_1, '{{%'.self::TABLE_NAME.'}}');

        $this->dropTable(self::TABLE_NAME);
    }

}