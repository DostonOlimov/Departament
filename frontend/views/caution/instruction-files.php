<?php

/* @var $this yii\web\View */

/* @var $model Laboratory */

use common\models\control\InstructionFile;
use frontend\models\InsFileHelper;
use common\models\control\Instruction;
use frontend\widgets\StepsReestr;
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
    <div class="col-3">
    <?= StepsReestr::widget([
       
        
    ]) ?>
    </div>

    <div class="col-sm-8">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
//            'id',
                [
                    'attribute' => 'Tekshiruv uchun asos',
                    'value' => function (InstructionFile $model) {
                        return $model->basis_file ? '<a class="btn btn-info" href="' . $model->getUploadedFileUrl('basis_file') . '" download>Yuklash<a/>' : InsFileHelper::getForm($model->id, 'basis_file');
                    },
                    'format' => 'raw'
                ],
                [
                    'attribute' => 'Tekshiruv dasturi',
                    'value' => function (InstructionFile $model) {
                        return $model->program_file ? '<a class="btn btn-info" href="' . $model->getUploadedFileUrl('program_file') . '" download>Yuklash<a/>' : InsFileHelper::getForm($model->id, 'program_file');
                    },
                    'format' => 'raw'
                ],
                [
                    'attribute' => 'Tekshiruv buyrug\'i',
                    'value' => function (InstructionFile $model) {
                        return $model->order_file ? '<a class="btn btn-info" href="' . $model->getUploadedFileUrl('order_file') . '" download>Yuklash<a/>' : InsFileHelper::getForm($model->id, 'order_file');
                    },
                    'format' => 'raw'
                ],                
            ],
        ]) ?>
    </div>
</div>

