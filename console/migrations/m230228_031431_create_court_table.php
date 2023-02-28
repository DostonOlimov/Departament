<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%court}}`.
 */
class m230228_031431_create_court_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%court}}', [
            'id' => $this->primaryKey(),
            'region_id'=>$this->integer(),
            'name' => $this->string(),
    
            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->notNull(),
            'created_at' => $this->integer()->unsigned()->notNull(),
            'updated_at' => $this->integer()->unsigned()->notNull(),
            ]);
        $this->addForeignKey(
            'fkey-court-region_id',
            'court',
            'region_id',
            'regions',
            'id', 
            'CASCADE', 
            'CASCADE'
                                                );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%court}}');
    }
}
