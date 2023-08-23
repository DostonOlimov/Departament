<?php

namespace common\models\govcontrol;

use common\models\normativedocument\NormativeDocumentContent;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%program_data}}".
 *
 * @property int $id
 * @property string|null $content
 * @property int|null $document_refer_id
 * @property int|null $status
 * @property string|null $comment
 * @property int|null $category_id
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property NormativeDocumentContent $documentRefer
 */
class ProgramData extends \common\models\LocalActiveRecord
{
    const TYPE_1 = 1;
    const TYPE_2 = 2;
    const TYPE_3 = 3;
    const TYPE_4 = 4;
    const TYPE_5 = 5;
    const TYPE_6 = 6;
    const TYPE_7 = 7;
    
    const STATUS_0 = 0;
    const STATUS_1 = 1;
    const STATUS_2 = 2;
    const STATUS_3 = 3;
    const STATUS_4 = 4;
    

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%program_data}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content', 'comment', 'created_at', 'updated_at'], 'string'],
            [['document_refer_id', 'status', 'category_id', 'created_by', 'updated_by'], 'integer'],
            [['document_refer_id'], 'exist', 'skipOnError' => true, 'targetClass' => NormativeDocumentContent::class, 'targetAttribute' => ['document_refer_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {   $ParentAttrLbl = parent::AttributeLabels();
        $AttrLbl = [
            'content' => 'Mazmuni',
            'document_refer_id' => 'Havola etilgan hujjat',
        ];
        return array_merge($ParentAttrLbl, $AttrLbl);
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            BlameableBehavior::class,
        ];
    }

    /**
     * Gets query for [[DocumentRefer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentRefer()
    {
        return $this->hasOne(NormativeDocumentContent::class, ['id' => 'document_refer_id']);
    }
    public static function getCategory($type = null)
    {
        $arr = [
    
            self::TYPE_1 => 'Tashkilotga kirish',
            self::TYPE_2 => 'Tashkilot to\'g\'risida ma\'lumotlar',
            self::TYPE_3 => 'Tekshirish maqsadi',
            self::TYPE_4 => 'Tekshirish predmeti',
            self::TYPE_5 => 'Tekshirishda o\'rganib chiqiladigan masalalar',
            self::TYPE_6 => 'Tekshirish natijalari bo‘yicha 2 nusxada dalolatnoma tuziladi va quyidagi hujjatlar nusxasi ilova qilinadi',
            self::TYPE_7 => 'Texnik jihatdan tartibga solish, standartlashtirish, sertifikatlashtirish va metrologiya sohalarini tartibga solishga doir qonun va normativ huquqiy hujjatlarda belgilangan talablar buzilishi holati ko‘rilgan choralar dalolatnomada yoritiladi',
        ];
    
        if ($type === null) {
            return $arr;
        }
    
        return $arr[$type];
    }
    public static function getStatus($type = null)
    {
        $arr = [
    
            self::STATUS_0 => 'Yangi',
            self::STATUS_1 => 'Yuborilgan',
            self::STATUS_2 => 'Tasdiqlangan',
            self::STATUS_3 => 'Rad etilgan',
            self::STATUS_4 => 'Bekor qilingan',
        ];
    
        if ($type === null) {
            return $arr;
        }
    
        return $arr[$type];
    }
    

}
