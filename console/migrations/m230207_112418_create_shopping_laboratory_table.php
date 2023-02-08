<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%shopping_laboratory}}`.
 */
class m230207_112418_create_shopping_laboratory_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%shopping_laboratory}}', [
            'id' => $this->primaryKey(),
            'shopping_company_id' => $this->integer()->notNull(),
            'shopping_product_id' => $this->integer()->notNull(),
            'conclusion' => $this->string(),
            'comment' => $this->string(),
            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->notNull(),
            'created_at' => $this->integer()->unsigned()->notNull(),
            'updated_at' => $this->integer()->unsigned()->notNull(),
        ]);
        $this->createIndex('index-shopping_laboratory-shopping_company_id', 'shopping_laboratory', 'shopping_company_id');
        $this->createIndex('index-shopping_laboratory-shopping_product_id', 'shopping_laboratory', 'shopping_product_id');
        $this->createIndex('index-shopping_laboratory-created_by', 'shopping_laboratory', 'created_by'); 
        $this->createIndex('index-shopping_laboratory-updated_by', 'shopping_laboratory', 'updated_by');  
        $this->addForeignKey('fkey-shopping_laboratory-shopping_company_id-shopping_company', 'shopping_laboratory', 'shopping_company_id', 'shopping_companies', 'id', 'RESTRICT', 'RESTRICT');  
        $this->addForeignKey('fkey-shopping_laboratory-shopping_product_id-shopping_product', 'shopping_laboratory', 'shopping_product_id', 'shopping_products', 'id', 'RESTRICT', 'RESTRICT');     
        $this->addForeignKey('fkey-shopping_laboratory-created_by-user_id', 'shopping_laboratory', 'created_by', 'user', 'id', 'RESTRICT', 'RESTRICT');   
        $this->addForeignKey('fkey-shopping_laboratory-updated_by-user_id', 'shopping_laboratory', 'updated_by', 'user', 'id', 'RESTRICT', 'RESTRICT');      
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%shopping_laboratory}}');
    }
}
