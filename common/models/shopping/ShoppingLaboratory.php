<?php

namespace common\models\shopping;

use Yii;

/**
 * This is the model class for table "shopping_laboratory".
 *
 * @property int $id
 * @property int $shopping_company_id
 * @property int $shopping_product_id
 * @property string|null $conclusion
 * @property string|null $comment
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property User $createdBy
 * @property ShoppingCompanies $shoppingCompany
 * @property ShoppingProducts $shoppingProduct
 * @property User $updatedBy
 */
class ShoppingLaboratory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shopping_laboratory';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['shopping_company_id', 'shopping_product_id', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'required'],
            [['shopping_company_id', 'shopping_product_id', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['conclusion', 'comment'], 'string', 'max' => 255],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
            [['shopping_company_id'], 'exist', 'skipOnError' => true, 'targetClass' => ShoppingCompanies::class, 'targetAttribute' => ['shopping_company_id' => 'id']],
            [['shopping_product_id'], 'exist', 'skipOnError' => true, 'targetClass' => ShoppingProducts::class, 'targetAttribute' => ['shopping_product_id' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'shopping_company_id' => 'Shopping Company ID',
            'shopping_product_id' => 'Shopping Product ID',
            'conclusion' => 'Conclusion',
            'comment' => 'Comment',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    /**
     * Gets query for [[ShoppingCompany]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getShoppingCompany()
    {
        return $this->hasOne(ShoppingCompanies::class, ['id' => 'shopping_company_id']);
    }

    /**
     * Gets query for [[ShoppingProduct]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getShoppingProduct()
    {
        return $this->hasOne(ShoppingProducts::class, ['id' => 'shopping_product_id']);
    }

    /**
     * Gets query for [[UpdatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'updated_by']);
    }
}
