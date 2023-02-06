<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\bootstrap4\Breadcrumbs;
use common\models\caution\CautionLetters;

/** @var yii\web\View $this */
/** @var common\models\caution\CautionLetters $model */

$this->title = 'Ogohlantirish xati '.'№'.' '.$model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ogohlantirish xati'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="caution-letters-view">
    <p>
        
    <?php echo Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                'options' => [
                    'class' => 'breadcrumb float-sm-right text-primary'
                ]
            ]);
            ?>
    <?= Html::a(Yii::t('app', 'Tahrirlash'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    
    <?= Html::a(Yii::t('app', 'File yuklash'), ['uploads', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

        
    </p>

    <?= DetailView::widget([
            'model' => $model,
            
            'attributes' => [
                [
                    'label' => '№',
                    'value' => function ($data) {
                    // $prevention = Prevention::findOne(['id' => $model->id]);
                        return $data ? $data->id : '';
                    }
                ],
                [
                    'label' => 'XYUS nomi',
                    'value' => function ($data) {
                        //$instruction->controlCompany = instruction->controlCompany::findOne(['id' => $model->companies_id]);
                        return $data ? $data->instruction->controlCompany->name : '';
                    }
                ],
                [
                    'label' => 'XYUS INN',
                    'value' => function ($data) {
                        //$instruction->controlCompany = instruction->controlCompany::findOne(['id' => $model->companies_id]);
                        return $data ? $data->instruction->controlCompany->inn : '';
                    }
                ],

                [
                    'label' => 'XYUS manzili',
                    'value' => function ($data) {
                        //$instruction->controlCompany = instruction->controlCompany::findOne(['id' => $model->companies_id]);
                        return $data ? $data->instruction->controlCompany->address : '';
                    }
                ],
                [
                    'label' => 'XYUS telefon raqami',
                    'value' => function ($data) {
                        // $instruction->controlCompany = instruction->controlCompany::findOne(['id' => $model->companies_id]);
                        return $data ? $data->instruction->controlCompany->phone : '';
                    }
                ],
            
                //'created_at',
                'letter_date',
                'letter_number',
                [
                    'attribute' => 'file',
                    'value' => function(CautionLetters $model) {
                        $model->s_file = $model->file;
                        return $model->s_file ? '<a class="btn btn-info" href="' . $model->getUploadedFileUrl('s_file') . '" download>Yuklash<a/>' : 'Yuklanmagan';

                    },
                    'format' => 'raw'
                ],
                'comment',
                [
                    'attribute'=> 'created_by',
                    'value' => function ($data) {
                    // $instruction = Instruction::findOne(['id' => $model->instructions_id]);
                        return $data ? $data->user->name .' '. $data->user->surname  : '';
                    }
                ],
            ],
        ]) ?>
       

</div>
