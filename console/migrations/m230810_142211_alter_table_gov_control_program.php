<?php

use yii\db\Migration;

/**
 * Class m230810_142211_alter_table_gov_control_program
 */
class m230810_142211_alter_table_gov_control_program extends Migration
{
    const TABLE_NAME = 'gov_control_program'; // set the current table name
    const COL_1 = 'comment';
    const COL_2 = 'status';
    const COL_3 = 'created_at';
    const COL_4 = 'updated_at';
    const COL_5 = 'created_by';
    const COL_6 = 'updated_by';
    
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // add
        $this->addColumn('{{%'.self::TABLE_NAME.'}}', self::COL_1,$this->string(511));
        $this->addColumn('{{%'.self::TABLE_NAME.'}}', self::COL_2,$this->integer());
        $this->addColumn('{{%'.self::TABLE_NAME.'}}', self::COL_3,$this->integer()->unsigned());
        $this->addColumn('{{%'.self::TABLE_NAME.'}}', self::COL_4,$this->integer()->unsigned());
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

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230810_142211_alter_table_gov_control_program cannot be reverted.\n";

        return false;
    }
    */
}
