<?php

use yii\db\Migration;

/**
 * Class m221027_155831_add_column_fullname_under_subposition
 */
class m221027_155831_add_column_fullname_under_subposition extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('under_subposition', 'full_name', $this->text());
        $this->addColumn('under_subposition', 'status', $this->integer()->defaultValue(1));
        $this->addColumn('subposition', 'status', $this->integer()->defaultValue(1));
        $this->addColumn('position', 'status', $this->integer()->defaultValue(1));
        $this->addColumn('group', 'status', $this->integer()->defaultValue(1));
        $this->alterColumn('group', 'name',$this->text());
        $this->alterColumn('position', 'name',$this->text());
        $this->alterColumn('subposition', 'name',$this->text());
        $this->alterColumn('under_subposition', 'name',$this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m221027_155831_add_column_fullname_under_subposition cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221027_155831_add_column_fullname_under_subposition cannot be reverted.\n";

        return false;
    }
    */
}
