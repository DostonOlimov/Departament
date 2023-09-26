<?php

use yii\db\Migration;

/**
 * Class m230829_033619_alter_table_gov_control_primary_data
 */
class m230829_033619_alter_table_gov_control_primary_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    const TABLE_NAME = 'gov_control_primary_data'; // set the current table name
    const COL_1 = 'measuring_and_testing_tools_exists';
    const COL_2 = 'created_at';
    const COL_3 = 'updated_at';
    const COL_4 = 'created_by';
    const COL_5 = 'updated_by';
    const COL_6 = 'status';
    
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
        $this->addColumn('{{%'.self::TABLE_NAME.'}}', self::COL_6,$this->integer());
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
    }
}
