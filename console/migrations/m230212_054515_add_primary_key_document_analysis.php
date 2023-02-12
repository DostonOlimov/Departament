<?php

use yii\db\Migration;

/**
 * Class m230212_054515_add_primary_key_document_analysis
 */
class m230212_054515_add_primary_key_document_analysis extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey('fkey-document_analysis-control_instruction_id', 'document_analysis', 'control_instruction_id', 'control_instructions', 'id', 'RESTRICT', 'RESTRICT'); 
        $this->dropColumn('document_analysis', 'control_instruction_id');
        $this->addColumn("document_analysis", "primary_data_id", $this->integer()->notNull());
        $this->createIndex('index-document_analysis-primary_data_id', 'document_analysis', 'primary_data_id');
        $this->delete('document_analysis');
        $this->addForeignKey('fkey-document_analysis-primary_data_id', 'document_analysis', 'primary_data_id', 'control_primary_data', 'id', 'RESTRICT', 'RESTRICT');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230212_054515_add_primary_key_document_analysis cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230212_054515_add_primary_key_document_analysis cannot be reverted.\n";

        return false;
    }
    */
}
