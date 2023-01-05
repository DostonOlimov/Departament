<?php

use yii\db\Migration;

/**
 * Class m230104_155533_add_defect_type_to_primary_product
 */
class m230104_155533_add_defect_type_to_primary_product extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('control_primary_product', 'defect_type',$this->string());
        $this->addColumn('control_primary_product', 'updated_at',$this->integer()->notNull()->after('codetnved'));
        $this->addColumn('control_primary_product', 'created_at',$this->integer()->notNull()->after('codetnved'));
     
     }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230104_155533_add_defect_type_to_primary_product cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230104_155533_add_defect_type_to_primary_product cannot be reverted.\n";

        return false;
    }
    */
}
