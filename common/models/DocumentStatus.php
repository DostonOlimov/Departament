<?php

namespace common\models;
use common\models\govcontrol\Program;
use common\models\govcontrol\Order;

use Yii;

/**
 * This is the model class for table "{{%document_status}}".
 *
 * @property int $id
 * @property int $document_number
 * @property int|null $status
 * @property int|null $comment
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $gov_control_program_id
 * @property int|null $gov_control_order_id
 *
 * @property User $createdBy
 * @property GovControlOrder $govControlOrder
 * @property GovControlProgram $govControlProgram
 * @property User $updatedBy
 */
class DocumentStatus extends \common\models\LocalActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%document_status}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'document_number'], 'required'],
            [['id',  'status', 'comment', 'created_at', 'updated_at', 'created_by', 'updated_by', 'gov_control_program_id', 'gov_control_order_id'], 'integer'],
            [['document_number'], 'string'],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['updated_by' => 'id']],
            [['gov_control_order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Order::class, 'targetAttribute' => ['gov_control_order_id' => 'id']],
            [['gov_control_program_id'], 'exist', 'skipOnError' => true, 'targetClass' => Program::class, 'targetAttribute' => ['gov_control_program_id' => 'id']],
            [['gov_control_primary_data'], 'exist', 'skipOnError' => true, 'targetClass' => Program::class, 'targetAttribute' => ['gov_control_program_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {   $ParentAttrLbl = parent::AttributeLabels();
        $AttrLbl = [
            // 'id' => 'ID',
            'document_number' => 'Document Number',
            // 'status' => 'Status',
            // 'comment' => 'Comment',
            // 'created_at' => 'Created At',
            // 'updated_at' => 'Updated At',
            // 'created_by' => 'Created By',
            // 'updated_by' => 'Updated By',
            'gov_control_program_id' => 'Tekshiruv dasturi raqami',
            'gov_control_order_id' => 'Tekshiruv buyrug\'i raqami',
            'gov_control_primary_data' => 'Tekshiruv birlamchi ma\'lumotlari raqami',
        ];

        return array_merge($ParentAttrLbl, $AttrLbl);
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'created_by'])->inverseOf('documentStatuses');
    }

    /**
     * Gets query for [[GovControlOrder]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGovControlOrder()
    {
        return $this->hasOne(Order::class, ['id' => 'gov_control_order_id'])->inverseOf('documentStatuses');
    }

    /**
     * Gets query for [[GovControlProgram]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGovControlProgram()
    {
        return $this->hasOne(Program::class, ['id' => 'gov_control_program_id'])->inverseOf('documentStatuses');
    }

    /**
     * Gets query for [[UpdatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'updated_by'])->inverseOf('documentStatuses0');
    }
}
