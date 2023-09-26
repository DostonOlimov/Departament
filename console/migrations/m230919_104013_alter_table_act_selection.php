<?php

use yii\db\Migration;

/**
 * Class m230919_104013_alter_table_act_selection
 */
class m230919_104013_alter_table_act_selection extends Migration
{
    const TABLE_NAME = 'act_selection'; // set the current table name
    const COL_1 = 'warehouse_name';
    const COL_2 = 'warehouse_address';
    const COL_3 = 'status';
    const COL_4 = 'created_at';
    const COL_5 = 'updated_at';
    const COL_6 = 'created_by';
    const COL_7 = 'updated_by';
    
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // add
        $this->addColumn('{{%'.self::TABLE_NAME.'}}', self::COL_1,$this->string(511));
        $this->addColumn('{{%'.self::TABLE_NAME.'}}', self::COL_2,$this->string(511));
        $this->addColumn('{{%'.self::TABLE_NAME.'}}', self::COL_3,$this->integer());
        $this->addColumn('{{%'.self::TABLE_NAME.'}}', self::COL_4,$this->integer()->unsigned());
        $this->addColumn('{{%'.self::TABLE_NAME.'}}', self::COL_5,$this->integer()->unsigned());
        $this->addColumn('{{%'.self::TABLE_NAME.'}}', self::COL_6,$this->integer());
        $this->addColumn('{{%'.self::TABLE_NAME.'}}', self::COL_7,$this->integer());

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
        $this->dropColumn('{{%'.self::TABLE_NAME.'}}', self::COL_6);
        $this->dropColumn('{{%'.self::TABLE_NAME.'}}', self::COL_7);
    }
}