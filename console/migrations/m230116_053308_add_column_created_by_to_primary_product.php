<?php

use yii\db\Migration;

/**
 * Class m230116_053308_add_column_created_by_to_primary_product
 */
class m230116_053308_add_column_created_by_to_primary_product extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn("control_primary_product", "created_by", $this->integer()->notNull()->defaultValue(1));
        $this->addColumn("control_primary_product", "updated_by", $this->integer()->notNull()->defaultValue(1));
        $this->createIndex('index-control_primary_product-created_by', 'control_primary_product', 'created_by');
        $this->createIndex('index-control_primary_product-updated_by', 'control_primary_product', 'updated_by');
        $this->addForeignKey('fkey-control_primary_product-created_by-user_id', 'control_primary_product', 'created_by', 'user', 'id', 'RESTRICT', 'RESTRICT');        
        $this->addForeignKey('fkey-control_primary_product-updated_by-user_id_', 'control_primary_product', 'updated_by', 'user', 'id', 'RESTRICT', 'RESTRICT');    
   
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230116_053308_add_column_created_by_to_primary_product cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230116_053308_add_column_created_by_to_primary_product cannot be reverted.\n";

        return false;
    }
    */
}
