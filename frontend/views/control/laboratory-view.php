<?php

/* @var $this yii\web\View */

/* @var $model Laboratory */

use common\models\control\Laboratory;
use frontend\models\LaboratoryHelper;
use common\models\control\Instruction;
use frontend\widgets\Steps;
use yii\widgets\DetailView;
use yii\helpers\Html;


$this->title = 'Davlat nazoratini o\'tkazish uchun asos';
$this->params['breadcrumbs'][] = $this->title;

?>


<div class="page1-1 row ">
    <?php
    function DelayForm($name)
    {
        echo "<form href='#' method='post' >
            <button type='button'>Faylni saqlash<input type='file' name='$name' ></button>
            </form>";
    }

    ?>
    <?= Steps::widget([
        'control_instruction_id' => $model->controlCompany->control_instruction_id,
        'control_company_id' => $model->control_company_id,
    ]) ?>

    <div class="col-6">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
//            'id',
                [
                    'attribute' => 'dalolatnoma',
                    'value' => function (Laboratory $model) {
                        return $model->dalolatnoma ? '<a class="btn btn-info" href="' . $model->getUploadedFileUrl('dalolatnoma') . '" download>Yuklash<a/>' : LaboratoryHelper::getForm($model->id, 'dalolatnoma');
                    },
                    'format' => 'raw'
                ],
                [
                    'attribute' => 'bayonnoma',
                    'value' => function (Laboratory $model) {
                        return $model->bayonnoma ? '<a class="btn btn-info" href="' . $model->getUploadedFileUrl('bayonnoma') . '" download>Yuklash<a/>' : LaboratoryHelper::getForm($model->id, 'bayonnoma');
                    },
                    'format' => 'raw'
                ],
                [
                    'attribute' => 'out_bayonnoma',
                    'value' => function (Laboratory $model) {
                        return $model->out_bayonnoma ? '<a class="btn btn-info" href="' . $model->getUploadedFileUrl('out_bayonnoma') . '" download>Yuklash<a/>' : LaboratoryHelper::getForm($model->id, 'out_bayonnoma');
                    },
                    'format' => 'raw'
                ],
                [
                    'attribute' => 'out_dalolatnoma',
                    'value' => function (Laboratory $model) {
                        return $model->out_dalolatnoma ? '<a class="btn btn-info" href="' . $model->getUploadedFileUrl('out_dalolatnoma') . '" download>Yuklash<a/>' : LaboratoryHelper::getForm($model->id, 'out_dalolatnoma');
                    },
                    'format' => 'raw'
                ],
                [
                    'attribute' => 'finish_dalolatnoma',
                    'value' => function (Laboratory $model) {
                        return $model->finish_dalolatnoma ? '<a class="btn btn-info" href="' . $model->getUploadedFileUrl('finish_dalolatnoma') . '" download>Yuklash</a>' : LaboratoryHelper::getForm($model->id, 'finish_dalolatnoma');
                    },
                    'format' => 'raw'
                ],
            ],
        ]) ?>
    </div>
</div>
<?php $finish_date = Instruction::findOne(['id'=>$model->controlCompany->control_instruction_id])->checkup_finish_date;
if (!$finish_date ) : 
    if($model->finish_dalolatnoma || $model->out_dalolatnoma):?>
        <div class="col-9" style="text-align:center;">
            <?= Html::a('Tekshiruvni yakunlash', ['last-step','id' => $model->controlCompany->control_instruction_id], ['class' => 'btn btn-info']) ?>
        </div>
    <?php endif; ?>
<?php endif; ?>
