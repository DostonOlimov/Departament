<?php

namespace common\models;

use common\models\govcontrol\Order;
use Yii;

/**
 * This is the model class for table "{{%attached_executor}}".
 *
 * @property int $id
 * @property int|null $status
 * @property int $user_id
 * @property string|null $comment
 * @property int|null $attached_at
 * @property int|null $detached_at
 * @property int|null $detached_comment
 * @property int|null $gov_control_order_id
 *
 * @property GovControlOrder $govControlOrder
 * @property User $user
 */
class AttachedExecutor extends \common\models\LocalActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%attached_executor}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'user_id', 'attached_at', 'detached_at', 'detached_comment', 'gov_control_order_id'], 'integer'],
            [['user_id'], 'required'],
            [['comment'], 'string'],
            [['gov_control_order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Order::class, 'targetAttribute' => ['gov_control_order_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status' => 'Status',
            'user_id' => 'User ID',
            'comment' => 'Comment',
            'attached_at' => 'Attached At',
            'detached_at' => 'Detached At',
            'detached_comment' => 'Detached Comment',
            'gov_control_order_id' => 'Gov Control Order ID',
        ];
    }

    /**
     * Gets query for [[GovControlOrder]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGovControlOrder()
    {
        return $this->hasOne(Order::class, ['id' => 'gov_control_order_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
