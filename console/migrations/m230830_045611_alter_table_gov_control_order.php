<?php

use yii\db\Migration;

/**
 * Class m230830_045611_alter_table_gov_control_order
 */
class m230830_045611_alter_table_gov_control_order extends Migration
{
    const TABLE_NAME = 'gov_control_order'; // set the current table name
    const COL_1 = 'order_prefix';
    const COL_2 = 'order_number';
    const COL_3 = 'comment';
    const COL_4 = 'status';
    const COL_5 = 'created_at';
    const COL_6 = 'updated_at';
    const COL_7 = 'created_by';
    const COL_8 = 'updated_by';
    
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // add
        $this->addColumn('{{%'.self::TABLE_NAME.'}}', self::COL_1,$this->integer());
        $this->addColumn('{{%'.self::TABLE_NAME.'}}', self::COL_2,$this->integer());
        $this->addColumn('{{%'.self::TABLE_NAME.'}}', self::COL_3,$this->string(511));
        $this->addColumn('{{%'.self::TABLE_NAME.'}}', self::COL_4,$this->integer());
        $this->addColumn('{{%'.self::TABLE_NAME.'}}', self::COL_5,$this->integer()->unsigned());
        $this->addColumn('{{%'.self::TABLE_NAME.'}}', self::COL_6,$this->integer()->unsigned());
        $this->addColumn('{{%'.self::TABLE_NAME.'}}', self::COL_7,$this->integer());
        $this->addColumn('{{%'.self::TABLE_NAME.'}}', self::COL_8,$this->integer());

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
        $this->dropColumn('{{%'.self::TABLE_NAME.'}}', self::COL_8);

    }
}
