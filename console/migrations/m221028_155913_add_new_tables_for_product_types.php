<?php

use yii\db\Migration;

/**
 * Class m221028_155913_add_new_tables_for_product_types
 */
class m221028_155913_add_new_tables_for_product_types extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropTable('product_types');
        $this->dropTable('group');
        $this->dropTable('position');
        $this->dropTable('subposition');
        $this->dropTable('under_subposition');

        $this->createTable('product_sector', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ]);

        $this->createTable('product_group', [
            'id' => $this->primaryKey(),
            'kode' => $this->string()->unique(),
            'name' => $this->string()->notNull(),
            'sector_id' => $this->integer()->notNull(),
        ]);
        $this->createTable('product_class', [
            'id' => $this->primaryKey(),
            'kode' => $this->string()->unique(),
            'name' => $this->string()->notNull(),
        ]);
        $this->createTable('product_position', [
            'id' => $this->primaryKey(),
            'kode' => $this->string()->unique(),
            'name' => $this->string()->notNull(),
        ]);
        $this->createTable('product_subposition', [
            'id' => $this->primaryKey(),
            'kode' => $this->string()->unique(),
            'name' => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m221028_155913_add_new_tables_for_product_types cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221028_155913_add_new_tables_for_product_types cannot be reverted.\n";

        return false;
    }
    */
}
