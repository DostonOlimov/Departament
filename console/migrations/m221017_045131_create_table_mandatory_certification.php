<?php

use yii\db\Migration;

/**
 * Class m221017_045131_create_table_mandatory_certification
 */
class m221017_045131_create_table_mandatory_certification extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('mandatory_certification', [
            'id' => $this->primaryKey(),
            'certificate_number' => $this->string()->Null(),
            'period_of_validity' => $this->string()->Null(),
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m221017_045131_create_table_mandatory_certification cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221017_045131_create_table_mandatory_certification cannot be reverted.\n";

        return false;
    }
    */
}
