<?php

use yii\db\Migration;

/**
 * Class m231003_050926_alter_table_selected_product
 */
class m231003_050926_alter_table_selected_product extends Migration
{
    const TABLE_NAME = 'selected_product'; // set the current table name
    const COL_1 = 'xtra_value_identification';
    const COL_2 = 'xtra_value_laboratory';
    
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // add
        $this->addColumn('{{%'.self::TABLE_NAME.'}}', self::COL_1,$this->double());
        $this->addColumn('{{%'.self::TABLE_NAME.'}}', self::COL_2,$this->double());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drop
        $this->dropColumn('{{%'.self::TABLE_NAME.'}}', self::COL_1);
        $this->dropColumn('{{%'.self::TABLE_NAME.'}}', self::COL_2);
    }
}
