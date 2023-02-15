<?php

use yii\db\Migration;

/**
 * Class m230215_074117_update_shopping_company
 */
class m230215_074117_update_shopping_company extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn("shopping_companies", "lab_comment", $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230215_074117_update_shopping_company cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230215_074117_update_shopping_company cannot be reverted.\n";

        return false;
    }
    */
}
