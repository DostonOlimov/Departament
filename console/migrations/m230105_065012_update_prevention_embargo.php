<?php

use yii\db\Migration;

/**
 * Class m230105_065012_update_prevention_embargo
 */
class m230105_065012_update_prevention_embargo extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('caution_embargo', 'created_at');
        $this->dropColumn('caution_embargo', 'message_date');
        $this->dropColumn('caution_embargo', 'updated_at');
        $this->dropColumn('caution_prevention', 'created_at');
        $this->dropColumn('caution_prevention', 'message_date');
        $this->dropColumn('caution_prevention', 'updated_at');
        $this->addColumn("caution_prevention", "created_at", $this->dateTime()->defaultValue(date("Y-m-d H:i:s", time())));
        $this->addColumn("caution_prevention", "updated_at", $this->dateTime()->defaultValue(date("Y-m-d H:i:s", time())));
        $this->addColumn("caution_embargo", "created_at", $this->dateTime()->defaultValue(date("Y-m-d H:i:s", time())));
        $this->addColumn("caution_embargo", "updated_at", $this->dateTime()->defaultValue(date("Y-m-d H:i:s", time())));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230105_065012_update_prevention_embargo cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230105_065012_update_prevention_embargo cannot be reverted.\n";

        return false;
    }
    */
}
