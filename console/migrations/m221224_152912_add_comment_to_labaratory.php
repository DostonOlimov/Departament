<?php

use yii\db\Migration;

/**
 * Class m221224_152912_add_comment_to_labaratory
 */
class m221224_152912_add_comment_to_labaratory extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('control_instructions', 'code');
        $this->alterColumn('laboratories', 'out_bayonnoma',$this->string()->after('bayonnoma'));
        $this->alterColumn('laboratories', 'out_dalolatnoma',$this->string()->after('out_bayonnoma'));
        $this->alterColumn('laboratories', 'finish_dalolatnoma',$this->string()->after('out_dalolatnoma'));
        $this->addColumn('laboratories', 'comment',$this->text()->after('finish_dalolatnoma'));
        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m221224_152912_add_comment_to_labaratory cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221224_152912_add_comment_to_labaratory cannot be reverted.\n";

        return false;
    }
    */
}
