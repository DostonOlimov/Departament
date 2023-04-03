<?php

use yii\db\Migration;

/**
 * Class m230402_055404_drop_userid_risk_analisys
 */
class m230402_055404_drop_userid_risk_analisys extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey('fkey-risk_analisys-user_id','risk_analisys');
        $this->dropColumn('risk_analisys' , 'user_id');
        $this->dropColumn('risk_analisys' ,'criteria');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230402_055404_drop_userid_risk_analisys cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230402_055404_drop_userid_risk_analisys cannot be reverted.\n";

        return false;
    }
    */
}
