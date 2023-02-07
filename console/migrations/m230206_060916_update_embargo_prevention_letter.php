<?php

use yii\db\Migration;

/**
 * Class m230206_060916_update_embargo_prevention_letter
 */
class m230206_060916_update_embargo_prevention_letter extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {        
        $this->dropForeignKey('fkey-caution_embargo-control_companies_id', 'caution_embargo', 'companies_id', 'control_companies', 'id', 'RESTRICT', 'RESTRICT');
        $this->dropForeignKey('fkey-caution_prevention-control_companies_id', 'caution_prevention', 'companies_id', 'control_companies', 'id', 'RESTRICT', 'RESTRICT');
        $this->dropForeignKey('fkey-caution_letters-control_companies_id', 'caution_letters', 'company_id', 'control_companies', 'id', 'RESTRICT', 'RESTRICT'); 
        $this->dropColumn('caution_embargo', 'companies_id');
        $this->dropColumn('caution_prevention', 'companies_id');
        $this->dropColumn('caution_letters', 'company_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230206_060916_update_embargo_prevention_letter cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230206_060916_update_embargo_prevention_letter cannot be reverted.\n";

        return false;
    }
    */
}
