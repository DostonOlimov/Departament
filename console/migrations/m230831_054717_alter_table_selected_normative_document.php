<?php

use yii\db\Migration;

/**
 * Class m230831_054717_alter_table_selected_normative_document
 */
class m230831_054717_alter_table_selected_normative_document extends Migration
{
    const TABLE_NAME = 'selected_normative_document'; // set the current table name
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

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drop
        $this->dropColumn('{{%'.self::TABLE_NAME.'}}', self::COL_1);
        $this->dropColumn('{{%'.self::TABLE_NAME.'}}', self::COL_2);
        $this->dropColumn('{{%'.self::TABLE_NAME.'}}', self::COL_3);
        $this->dropColumn('{{%'.self::TABLE_NAME.'}}', self::COL_4);
        $this->dropColumn('{{%'.self::TABLE_NAME.'}}', self::COL_5);
    }
}