<?php 
namespace common\models;

use Yii;

/**
 * This is the model class for table "codetnved".
 *
 * @property int $id
 * @property string $kod
 * @property string $name
 * @property int|null $import
 */
class Test extends \yii\db\ActiveRecord
{
    public function getLabel()
    {
        return [
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Yaratilgan sanasi',
            'updated_at' => 'O\'zgartirilgan sanasi',
        ];
    }
}
?>