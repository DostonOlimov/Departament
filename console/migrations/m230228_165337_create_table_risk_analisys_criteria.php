<?php

use yii\db\Migration;

/**
 * Class m230228_165337_create_table_risk_analisys_criteria
 */
class m230228_165337_create_table_risk_analisys_criteria extends Migration
{
    /* {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%risk_analisys_criteria}}', [
            'id' => $this->primaryKey(),
            'document_paragraph'=> $this->string(255)->notNull(),
            'criteria_category' => $this->string(255)->notNull(),
            'criteria' => $this->string()->notNull(),
            'company_field_category'=> $this->string(255)->notNull(),
            'criteria_score' => $this->integer()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            ]);

        $this->createIndex('index-risk_analisys_criteria-created_by', 'risk_analisys_criteria', 'created_by');
        $this->addForeignKey('fkey-risk_analisys_criteria-created_by', 'risk_analisys_criteria', 'created_by', 'user', 'id', 'RESTRICT', 'RESTRICT');
    
        $this->createIndex('index-risk_analisys_criteria-updated_by', 'risk_analisys_criteria', 'updated_by');
        $this->addForeignKey('fkey-risk_analisys_criteria-updated_by', 'risk_analisys_criteria', 'updated_by', 'user', 'id', 'RESTRICT', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%risk_analisys_criteria}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230228_090705_risk_analisys_criteria_table cannot be reverted.\n";

        return false;
    }
    */
}
