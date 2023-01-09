<?php

use yii\db\Migration;

/**
 * Class m230107_183227_add_column_embargo_prevention
 */
class m230107_183227_add_column_embargo_prevention extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn("caution_embargo", "message_date", $this->string(255));
        $this->addColumn("caution_embargo", "file", $this->string(255));
        $this->addColumn("caution_prevention", "message_date", $this->string(255));
        $this->addColumn("caution_prevention", "file", $this->string(255));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230107_183227_add_column_embargo_prevention cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230107_183227_add_column_embargo_prevention cannot be reverted.\n";

        return false;
    }
    */
}
