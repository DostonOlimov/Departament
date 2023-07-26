<?php

use yii\db\Migration;

/**
 * Class m230720_123211_alter_table_normative_document_section
 */
class m230720_123211_alter_table_normative_document_section extends Migration
{
    const TABLE_NAME = 'normative_document_section'; // set the current table name
    const COL_1 = 'parent_id';
    const COL_2 = 'position';
    
    const FTABLE_NAME_1 = self::TABLE_NAME; // set the current table name
    const FCOL_1 = 'id';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%'.self::TABLE_NAME.'}}', self::COL_1,$this->integer()->after('id'));
        $this->createIndex('index-'.self::TABLE_NAME.'-'.self::COL_1, '{{%'.self::TABLE_NAME.'}}', self::COL_1);
        $this->addForeignKey('fkey-'.self::TABLE_NAME.'-'.self::COL_1, '{{%'.self::TABLE_NAME.'}}', self::COL_1, '{{%'.self::FTABLE_NAME_1.'}}', self::FCOL_1, 'CASCADE', 'CASCADE');

        $this->addColumn('{{%'.self::TABLE_NAME.'}}', self::COL_2,$this->integer()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        
        $this->dropForeignKey('fkey-'.self::TABLE_NAME.'-'.self::COL_1, '{{%'.self::TABLE_NAME.'}}');
        $this->dropIndex('index-'.self::TABLE_NAME.'-'.self::COL_1, '{{%'.self::TABLE_NAME.'}}');
        $this->dropColumn('{{%'.self::TABLE_NAME.'}}', self::COL_1);
        
        $this->dropColumn('{{%'.self::TABLE_NAME.'}}', self::COL_2);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230720_123211_alter_table_normative_document_section cannot be reverted.\n";

        return false;
    }
    */
}
