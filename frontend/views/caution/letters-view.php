<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use frontend\widgets\StepsReestr;
use yii\bootstrap4\Breadcrumbs;
use common\models\caution\CautionLetters;
use yii\helpers\Url;


$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ogohlantirish_xati'), 'url' => ['letters']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$this->title = Yii::t('app', 'Bartaraf_etish');
?>
<div class="row">
    <div class="col-3">
        <?= StepsReestr::widget([])?>
    </div>

    <div class="col-sm-8">
    
                    <?php
                        echo Breadcrumbs::widget([
                            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                            'options' => [
                                'class' => 'p-2 bg-primary breadcrumb float-sm-right'
                            ]
                        ]);
                        ?>
                
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
                    'label' => 'Korxona',
                    'value' => function ($data) {
                        //$company = Company::findOne(['id' => $model->companies_id]);
                        return $data ? $data->company->name : '';
                    }
                ],
                [
                    'label' => 'Korxona INN',
                    'value' => function ($data) {
                        //$company = Company::findOne(['id' => $model->companies_id]);
                        return $data ? $data->company->inn : '';
                    }
                ],

                [
                    'label' => 'Korxona manzili',
                    'value' => function ($data) {
                        //$company = Company::findOne(['id' => $model->companies_id]);
                        return $data ? $data->company->address : '';
                    }
                ],
                [
                    'label' => 'Korxona telefon raqami',
                    'value' => function ($data) {
                        // $company = Company::findOne(['id' => $model->companies_id]);
                        return $data ? $data->company->phone : '';
                    }
                ],
                [
                    'attribute' => 'file',
                    'value' => function (CautionLetters $model) {
                        $model->s_file = $model->file;
                        return $model->s_file ? '<a class="btn btn-info" href="' . $model->getUploadedFileUrl('s_file') . '" download>Yuklash<a/>' : 'Yuklanmagan';

                    },
                    'format' => 'raw'
                ],
            
                //'created_at',
                'letter_date',
                'letter_number',
                //'file',
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
        <?php if(!empty($model->file)):?>
            <iframe class="iframemargins" src="<?php echo Url::to("@web/uploads/letters/ogohlantirish/{$model->id}.pdf", true);?>" 
                title="PDF in an i-Frame" frameborder="0" scrolling="auto" width="100%" 
                height="600px">
            </iframe>
            <?php endif;?>
        
    </div>
</div>
