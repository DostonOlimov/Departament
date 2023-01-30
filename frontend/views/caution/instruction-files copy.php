<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\control\Instruction;
use common\models\control\InstructionFile;
use common\models\User;
use frontend\widgets\StepsReestr;
use yii\bootstrap4\Breadcrumbs;
use yii\helpers\Url;


/** @var yii\web\View $this */
/** @var common\models\embargo\Embargo $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Buyruqlar'), 'url' => ['instruction-file']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="row">
    <div class="col-3">
        <?= StepsReestr::widget([])?>
    </div>

    <div class="col-sm-8">
        <p>
            <!--?= $model->status;?-->
           
            <?php
            echo Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                 'options' => [
                'class' => 'p-2 bg-primary breadcrumb float-sm-right'
                        ]
                ]);
            ?>
        </p>
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                   
                        [
                            'label' => 'Tekshiruv kodi',
                            'value' => function ($data) {
                                return $data ? $data->instructions_id : '';
                            }
                        ],  
                        [
                            'attribute' => 'Asos',
                            'value' => function (InstructionFile $model) {
                               // return $model->basis_file ? '<a class="btn btn-info" href="' . $model->getUploadedFileUrl('dalolatnoma') . '" download>Yuklash<a/>' : LaboratoryHelper::getForm($model->id, 'dalolatnoma');
                                return $model->basis_file;
                            },
                            'format' => 'raw'
                        ],
                        [
                            'attribute' => 'Dastur xati',
                            'value' => function (InstructionFile $model) {
                               // return $model->program_file ? '<a class="btn btn-info" href="' . $model->getUploadedFileUrl('bayonnoma') . '" download>Yuklash<a/>' : LaboratoryHelper::getForm($model->id, 'bayonnoma');
                               return $model->program_file;
                            },
                            'format' => 'raw'
                        ],
                        [
                            'attribute' => 'out_bayonnoma',
                            'value' => function (InstructionFile $model) {
                               // return $model->order_file ? '<a class="btn btn-info" href="' . $model->getUploadedFileUrl('out_bayonnoma') . '" download>Yuklash<a/>' : LaboratoryHelper::getForm($model->id, 'out_bayonnoma');
                               return $model->order_file;
                            },
                            'format' => 'raw'
                        ],                  
                    
                ],
            ]) ?>
            
    </div>

</div>
