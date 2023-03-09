<?php

use yii\db\Migration;

/**
 * Class m230309_092932_create_table_risk_analisys
 */
class m230309_092932_create_table_risk_analisys extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%risk_analisys}}',[
            'id' => $this->primaryKey(),
            'company_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'risk_analisys_date' => $this->integer()->unsigned()->notNull(),
            'risk_analisys_number' => $this->integer()->notNull(),
            'criteria' => $this->string()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->notNull(),
            'created_at' => $this->integer()->unsigned()->notNull(),
            'updated_at' => $this->integer()->unsigned()->notNull(),
        ]);
        $this->addForeignKey('fkey-risk_analisys-company_id', '{{%risk_analisys}}', 'company_id','{{%company}}', 'id','CASCADE', 'CASCADE');
        $this->addForeignKey('fkey-risk_analisys-user_id', '{{%risk_analisys}}', 'user_id','{{%user}}', 'id','CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%risk_analisys}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230309_092932_create_table_risk_analisys cannot be reverted.\n";

        return false;
    }
    */
}
