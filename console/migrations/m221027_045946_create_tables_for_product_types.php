<?php

use yii\db\Migration;

/**
 * Class m221027_045946_create_tables_for_product_types
 */
class m221027_045946_create_tables_for_product_types extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('group', [
            'id' => $this->primaryKey(),
            'kode' => $this->string()->unique(),
            'name' => $this->string(),
        ]);
        $this->createTable('position', [
            'id' => $this->primaryKey(),
            'kode' => $this->string()->unique(),
            'name' => $this->string(),
        ]);
        $this->createTable('subposition', [
            'id' => $this->primaryKey(),
            'kode' => $this->string()->unique(),
            'name' => $this->string(),
        ]);
        $this->createTable('under_subposition', [
            'id' => $this->primaryKey(),
            'kode' => $this->string()->unique(),
            'name' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m221027_045946_create_tables_for_product_types cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221027_045946_create_tables_for_product_types cannot be reverted.\n";

        return false;
    }
    */
}
