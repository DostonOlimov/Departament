<?php

/* @var $this yii\web\View */
/* @var $model Measure */

use common\models\control\ControlProductMeasures;
use common\models\control\Measure;
use frontend\widgets\Steps;
use yii\widgets\DetailView;

$this->title = 'Davlat nazoratini o\'tkazish uchun asos';
$this->params['breadcrumbs'][] = $this->title;

?>


<div class="page1-1 row ">

    <?= Steps::widget([
        'control_instruction_id' => $model->controlCompany->control_instruction_id,
        'control_company_id' => $model->control_company_id,
    ]) ?>

    <div class="col-8">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
//            'id',
                [
                    'attribute' => 'type',
                    'value' => function (Measure $model) {
                        $res = '';
                        if ($model->type) {
                            foreach (explode(',', $model->type) as $type) {
                                $res .=  $type ? Measure::typeList($type).'.<br>' : ' ' . '';
                            }
                        }
                        return $res;
                    },
                    'format' => 'raw'
                ],
                'ov_date',
                'ov_quantity',
                'ov_name',
                'realization_date',
                'realization_number',
                'person',
                'number_passport',
                'fine_amount',
                [
                    'attribute' => 'band_mjtk',
                    'value' => function ($model) {
                        
                        $result = '';
                        $model->band_mjtk = explode(',', substr($model->band_mjtk, 1));
                       // \yii\helpers\VarDumper::dump($model->band_mjtk);die;
                    if($model->band_mjtk[0]){$result .= ' MJtK ning 212-moddasi '. $model->band_mjtk[0]. '-qismi;</br>';}
                    if($model->band_mjtk[1]){$result .= ' MJtK ning 213-moddasi '. $model->band_mjtk[1]. '-qismi;</br>';}
                    if($model->band_mjtk[2]){$result .= ' MJtK ning 214-moddasi '. $model->band_mjtk[2]. '-qismi;';}
                        return $result;
                    },
                    'format' => 'raw',
                ],
                [
                    'attribute' => 'explanation_letter',
                    'value' => function ( $model) {
                        return $model->explanation_letter ? '<a class="btn btn-info" href="' . $model->getUploadedFileUrl('explanation_letter') . '" download>Yuklash<a/>' : 'Yuklanmagan';
                    },
                    'format' => 'raw'
                ],
                [
                    'attribute' => 'court_letter',
                    'value' => function ( $model) {
                        return $model->court_letter ? '<a class="btn btn-info" href="' . $model->getUploadedFileUrl('court_letter') . '" download>Yuklash<a/>' : 'Yuklanmagan';
                    },
                    'format' => 'raw'
                ],
                [
                    'attribute' => 'claim',
                    'value' => function (   $model) {
                        return $model->claim ? '<a class="btn btn-info" href="' . $model->getUploadedFileUrl('claim') . '" download>Yuklash<a/>' : 'Yuklanmagan';
                    },
                    'format' => 'raw'
                ],
                'first_warn_date',
                'warn_number',
                'eco_date',
                'eco_number',
                'eco_quantity',
                'eco_amount'
            ],
        ]) ?>
    </div>

</div>
