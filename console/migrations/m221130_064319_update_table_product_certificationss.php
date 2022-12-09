<?php

use yii\db\Migration;

/**
 * Class m221130_064319_update_table_product_certificationss
 */
class m221130_064319_update_table_product_certificationss extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
      //  $this->dropColumn('control_primary_product', 'description');
       $this->addColumn('control_primary_product', 'description', $this->text());
       
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m221130_064319_update_table_product_certificationss cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221130_064319_update_table_product_certificationss cannot be reverted.\n";

        return false;
    }
    */
}
