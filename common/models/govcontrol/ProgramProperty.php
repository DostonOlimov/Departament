<?php

namespace common\models\govcontrol;

use Yii;

/**
 * This is the model class for table "{{%program_property}}".
 *
 * @property int $id
 * @property int|null $gov_control_program_id
 * @property int|null $program_data_id
 * @property int|null $status
 * @property string|null $comment
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property GovControlProgram $govControlProgram
 * @property ProgramData $programData
 */
class ProgramProperty extends \common\models\LocalActiveRecord
{
    public $category_id;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%program_property}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['gov_control_program_id', 'program_data_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['gov_control_program_id'], 'exist', 'skipOnError' => true, 'targetClass' => GovControlProgram::class, 'targetAttribute' => ['gov_control_program_id' => 'id']],
            [['program_data_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProgramData::class, 'targetAttribute' => ['program_data_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'gov_control_program_id' => 'Gov Control Program ID',
            'program_data_id' => 'Program Data ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * Gets query for [[GovControlProgram]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGovControlProgram()
    {
        return $this->hasOne(GovControlProgram::class, ['id' => 'gov_control_program_id']);
    }

    /**
     * Gets query for [[ProgramData]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProgramData()
    {
        return $this->hasOne(ProgramData::class, ['id' => 'program_data_id']);
    }
    public static function getProgramDataNames($type)
    {
        // debug($type);
        $program_data = ProgramData::findAll(['category_id' => $type]);
        $result = [];
        foreach ($program_data as $one_program_data){
            $result[$one_program_data->id] = $one_program_data->content;
        }

        // debug($result);
        return $result;
    }
}
