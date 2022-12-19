<?php

namespace common\models\control;

use common\models\User;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yiidreamteam\upload\FileUploadBehavior;

/**
 * This is the model class for table "laboratories".
 *
 * @property int $id
 * @property int $control_company_id
 * @property string|null $dalolatnoma
 * @property string|null $bayonnoma
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property User $createdBy
 * @property User $updatedBy
 * @property Company $controlCompany
 */
class Laboratory extends \yii\db\ActiveRecord
{
    public $finish_dalolatnoma;
    public $out_dalolatnoma;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'laboratories';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['control_company_id','dalolatnoma','out_bayonnoma'], 'required'],
            [['control_company_id'], 'integer'],
           // ['finish_dalolatnoma','validateFinish'],
         //  [['finish_dalolatnoma'],'validateEither', ['other' => ['phone']]],
           ['finish_dalolatnoma', 'validateEither', 'params' => ['other' => 'out_dalolatnoma']],
            [['dalolatnoma', 'bayonnoma', 'finish_dalolatnoma', 'out_bayonnoma', 'out_dalolatnoma'], 'file'],
        ];
    }
    public function validateEither($attribute, $params)
{
    $field1 = $this->getAttributeLabel($attribute);
    $field2 = $this->getAttributeLabel($params['other']);
    if (is_null($this->finish_dalolatnoma) && is_null($this->{$params['other']})) {
        $this->addError($attribute, 'ss');
    }
}
   /* public function validateValidator() {
        var_dump($this->out_dalolatnoma);die(); 
       
    }
    public function validateFinish($attribute, $params, $validator)
    {
   //  var_dump($attribute);die(); 
        if (is_null($this->finish_dalolatnoma)) {
            //die;
            $this->addError($attribute, 'Oraliq yoki yakuniy dalolatnomadan biri yuklanishi shart.');
        }
    }
*/
   
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dalolatnoma' => 'Na`muna olish dalolatnomasi',
            'bayonnoma' => 'Sinov bayonnomasi',
            'out_bayonnoma' => 'Tashqi ko\'rinish bayonnomasi',
            'out_dalolatnoma' => 'Oraliq dalolatnoma',
            'finish_dalolatnoma' => 'Yakuniy dalolatnoma',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            BlameableBehavior::class,
            [
                'class' => FileUploadBehavior::class,
                'attribute' => 'dalolatnoma',
                'filePath' => '@webroot/uploads/dalolatnoma/[[pk]].[[extension]]',
                'fileUrl' => '/uploads/dalolatnoma/[[pk]].[[extension]]',
            ],
            [
                'class' => FileUploadBehavior::class,
                'attribute' => 'bayonnoma',
                'filePath' => '@webroot/uploads/bayonnoma/[[pk]].[[extension]]',
                'fileUrl' => '/uploads/bayonnoma/[[pk]].[[extension]]',
            ],
            [
                'class' => FileUploadBehavior::class,
                'attribute' => 'out_bayonnoma',
                'filePath' => '@webroot/uploads/out_bayonnoma/[[pk]].[[extension]]',
                'fileUrl' => '/uploads/out_bayonnoma/[[pk]].[[extension]]',
            ],
            [
                'class' => FileUploadBehavior::class,
                'attribute' => 'out_dalolatnoma',
                'filePath' => '@webroot/uploads/out_dalolatnoma/[[pk]].[[extension]]',
                'fileUrl' => '/uploads/out_dalolatnoma/[[pk]].[[extension]]',
            ],
            [
                'class' => FileUploadBehavior::class,
                'attribute' => 'finish_dalolatnoma',
                'filePath' => '@webroot/uploads/finish_dalolatnoma/[[pk]].[[extension]]',
                'fileUrl' => '/uploads/finish_dalolatnoma/[[pk]].[[extension]]',
            ],
        ];
    }

    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    public function getControlCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'control_company_id']);
    }
}
