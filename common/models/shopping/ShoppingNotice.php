<?php

namespace common\models\shopping;
use common\models\shopping\Instruction;
use common\models\User;

use Yii;

/**
 * This is the model class for table "shopping_notice".
 *
 * @property int $id
 * @property string|null $notice_number
 * @property string|null $notice_sum
 * @property int $created_by
 * @property int $updated_by
 * @property string|null $status
 * @property int|null $attachment_user_id
 *
 * @property User $attachmentUser
 * @property User $createdBy
 * @property User $updatedBy
 */
class ShoppingNotice extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shopping_notice';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_by', 'updated_by','notice_number','notice_sum'], 'required'],
            [['created_by', 'updated_by', 'attachment_user_id'], 'integer'],
            [['notice_number', 'notice_sum', 'status'], 'string', 'max' => 255],
          //  [['attachment_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['attachment_user_id' => 'id']],
            // [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
            // [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'notice_number' => 'Bildirgi raqami',
            'notice_sum' => 'Bildirgi summasi',
            'created_by' => 'Inspector',
            'updated_by' => 'Nazoratchi',
            'status' => 'Holati',
            'attachment_user_id' => 'Biriktirilgan shaxs',
        ];
    }

    /**
     * Gets query for [[AttachmentUser]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAttachmentUser()
    {
        return $this->hasOne(User::class, ['id' => 'attachment_user_id']);
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
     * Gets query for [[UpdatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'updated_by']);
    }
    public function getInstruction()
    {
        return $this->hasMany(Instruction::class, ['notice_id' => 'id']);
    }
}
