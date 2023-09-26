<?php

use yii\db\Migration;

/**
 * Class m230828_092718_alter_table_identification
 */
class m230828_092718_alter_table_identification extends Migration
{
    /**
     * {@inheritdoc}
     */
    const TABLE_NAME = 'identification'; // set the current table name
    const FTABLE_NAME_1 = 'user'; // set the foreign table name
    const COL_1 = 'status';
    const COL_2 = 'created_at';
    const COL_3 = 'updated_at';
    const COL_4 = 'created_by';
    const COL_5 = 'updated_by';
    
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // add
        $this->addColumn('{{%'.self::TABLE_NAME.'}}', self::COL_1,$this->integer());
        $this->addColumn('{{%'.self::TABLE_NAME.'}}', self::COL_2,$this->integer()->unsigned());
        $this->addColumn('{{%'.self::TABLE_NAME.'}}', self::COL_3,$this->integer()->unsigned());
        $this->addColumn('{{%'.self::TABLE_NAME.'}}', self::COL_4,$this->integer());
        $this->addColumn('{{%'.self::TABLE_NAME.'}}', self::COL_5,$this->integer());
        // add
        $this->createIndex(
            'index-'.self::TABLE_NAME.'-'.self::COL_4, 
            '{{%'.self::TABLE_NAME.'}}', self::COL_4);
        $this->addForeignKey(
            'fkey-'.self::TABLE_NAME.'-'.self::COL_4, 
            '{{%'.self::TABLE_NAME.'}}', self::COL_4, 
            '{{%'.self::FTABLE_NAME_1.'}}', 'id', 'CASCADE', 'CASCADE');
        // add
        $this->createIndex(
            'index-'.self::TABLE_NAME.'-'.self::COL_5, 
            '{{%'.self::TABLE_NAME.'}}', self::COL_5);
        $this->addForeignKey(
            'fkey-'.self::TABLE_NAME.'-'.self::COL_5, 
            '{{%'.self::TABLE_NAME.'}}', self::COL_5, 
            '{{%'.self::FTABLE_NAME_1.'}}', 'id', 'CASCADE', 'CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drop
        $this->dropForeignKey(
            'fkey-'.self::TABLE_NAME.'-'.self::COL_4, 
            '{{%'.self::TABLE_NAME.'}}');
        $this->dropIndex(
            'index-'.self::TABLE_NAME.'-'.self::COL_4, 
            '{{%'.self::TABLE_NAME.'}}');
        // drop
        $this->dropForeignKey(
            'fkey-'.self::TABLE_NAME.'-'.self::COL_5, 
            '{{%'.self::TABLE_NAME.'}}');
        $this->dropIndex(
            'index-'.self::TABLE_NAME.'-'.self::COL_5, 
            '{{%'.self::TABLE_NAME.'}}');            
        // drop
        $this->dropColumn('{{%'.self::TABLE_NAME.'}}', self::COL_1);
        $this->dropColumn('{{%'.self::TABLE_NAME.'}}', self::COL_2);
        $this->dropColumn('{{%'.self::TABLE_NAME.'}}', self::COL_3);
        $this->dropColumn('{{%'.self::TABLE_NAME.'}}', self::COL_4);
        $this->dropColumn('{{%'.self::TABLE_NAME.'}}', self::COL_5);
    }
}
