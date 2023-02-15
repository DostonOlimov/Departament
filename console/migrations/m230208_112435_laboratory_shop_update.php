<?php

use yii\db\Migration;

/**
 * Class m230208_112435_laboratory_shop_update
 */
class m230208_112435_laboratory_shop_update extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {        
        $this->dropTable("shopping_laboratory");
        $this->addColumn("shopping_products", "lab_conclusion", $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230208_112435_laboratory_shop_update cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230208_112435_laboratory_shop_update cannot be reverted.\n";

        return false;
    }
    */
}
