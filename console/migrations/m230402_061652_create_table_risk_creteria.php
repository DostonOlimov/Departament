<?php

use yii\db\Migration;

/**
 * Class m230402_061652_create_table_risk_creteria
 */
class m230402_061652_create_table_risk_creteria extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%risks_criteria}}',[
            'id' => $this->primaryKey(),
            'risk_analisys_id' => $this->integer()->notNull(),
            'criteria_id' => $this->integer()->notNull(),
            'comment' => $this->string(),

        ]);
        $this->addForeignKey('fkey-risks_criteria-risk_analisys_id', '{{%risks_criteria}}', 'risk_analisys_id','{{%risk_analisys}}', 'id','CASCADE', 'CASCADE');
        $this->addForeignKey('fkey-risks_criteria-criteria_id', '{{%risks_criteria}}', 'criteria_id','{{%risk_analisys_criteria}}', 'id','CASCADE', 'CASCADE');
 
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230402_061652_create_table_risk_creteria cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230402_061652_create_table_risk_creteria cannot be reverted.\n";

        return false;
    }
    */
}
