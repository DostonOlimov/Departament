<?php

use yii\db\Migration;

/**
 * Class m230207_042454_add_new_table_ov_nd
 */
class m230207_042454_add_new_table_ov_nd extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->createTable('control_primary_ov_nd', [
            'id' => $this->primaryKey(),
            'ov_id' => $this->integer(),
            'name' => $this->string(),
            'type_id' => $this->integer(),
        ]);
        $this->addForeignKey('fk-control_primary_ov_nd-control_primary_ovs', 'control_primary_ov_nd', 'ov_id', 'control_primary_ovs', 'id');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230207_042454_add_new_table_ov_nd cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230207_042454_add_new_table_ov_nd cannot be reverted.\n";

        return false;
    }
    */
}
