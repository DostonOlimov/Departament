<?php

use yii\db\Migration;

/**
 * Class m230925_153106_alter_table_gov_control_primary_data
 */
class m230925_153106_alter_table_gov_control_primary_data extends Migration
{
    const TABLE_NAME = 'gov_control_primary_data'; // set the current table name
    const COL_1 = 'company_type_id';
    
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // add
        $this->alterColumn('{{%'.self::TABLE_NAME.'}}', self::COL_1,$this->string(511));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drop
        $this->alterColumn('{{%'.self::TABLE_NAME.'}}', self::COL_1,$this->integer());
    }
}
