<?php

use yii\db\Migration;

/**
 * Class m230129_085842_delete_caution_tables
 */
class m230129_085842_delete_caution_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey('fkey-caution_executions-caution_company_id', 'caution_executions');
        $this->dropForeignKey('fkey-caution_executions-created_by', 'caution_executions');
        $this->dropForeignKey('fkey-caution_executions-updated_by', 'caution_executions');
        $this->delete('caution_executions', );
        $this->dropTable('caution_executions');
        
        $this->dropForeignKey('fkey-caution_companies-region_id', 'caution_companies');
        $this->dropForeignKey('fkey-caution_companies-caution_instruction_id', 'caution_companies');
        $this->dropForeignKey('fkey-caution_companies-created_by', 'caution_companies');
        $this->dropForeignKey('fkey-caution_companies-updated_by', 'caution_companies');
        $this->delete('caution_companies', );
        $this->dropTable('caution_companies');

        $this->dropForeignKey('fkey-caution_instructions-created_by', 'caution_instructions');
        $this->dropForeignKey('fkey-caution_instructions-updated_by', 'caution_instructions');
        $this->delete('caution_instructions', );
        $this->dropTable('caution_instructions');
    
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230129_085842_delete_caution_tables cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230129_085842_delete_caution_tables cannot be reverted.\n";

        return false;
    }
    */
}
