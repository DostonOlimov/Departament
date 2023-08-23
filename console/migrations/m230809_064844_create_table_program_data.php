<?php

use yii\db\Migration;

/**
 * Class m230809_064844_create_table_program_data
 */
class m230809_064844_create_table_program_data extends Migration
{
    const TABLE_NAME = 'program_data'; // set the current table name
    const COL_1 = 'document_refer_id';
    
    const FTABLE_NAME_1 = 'normative_document_content'; // set the current table name
    
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // add
        $this->createTable('{{%'.self::TABLE_NAME.'}}', [
            'id' => $this->primaryKey(),
            'content' => $this->text(511),
            'document_refer_id' => $this->integer(),
            'status' => $this->integer(),
            'comment' => $this->text(511),
            'category_id' => $this->integer(),
            
            'created_at' => $this->integer()->unsigned(),
            'updated_at' => $this->integer()->unsigned(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ]);

        // add
        $this->createIndex(
            'index-'.self::TABLE_NAME.'-'.self::COL_1, 
            '{{%'.self::TABLE_NAME.'}}', self::COL_1);
        $this->addForeignKey(
            'fkey-'.self::TABLE_NAME.'-'.self::COL_1, 
            '{{%'.self::TABLE_NAME.'}}', self::COL_1, 
            '{{%'.self::FTABLE_NAME_1.'}}', 'id', 'CASCADE', 'CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drop
        $this->dropForeignKey(
            'fkey-'.self::TABLE_NAME.'-'.self::COL_1, 
            '{{%'.self::TABLE_NAME.'}}');
        $this->dropIndex(
            'index-'.self::TABLE_NAME.'-'.self::COL_1, 
            '{{%'.self::TABLE_NAME.'}}');
        // drop
        $this->dropTable(self::TABLE_NAME);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230809_064844_create_table_program_data cannot be reverted.\n";

        return false;
    }
    */
}
