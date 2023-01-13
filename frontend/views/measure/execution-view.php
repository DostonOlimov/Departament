<?php

/* @var $this yii\web\View */

/* @var $model Caution */

use common\models\control\Caution;
use common\models\control\Company;
use common\models\measure\Executions;
use frontend\widgets\StepsReestr;
use yii\widgets\DetailView;

$this->title = 'Davlat nazoratini o\'tkazish uchun asos';
$this->params['breadcrumbs'][] = $this->title;
//\yii\helpers\VarDumper::dump($model,12,true);die;
?>

<div class="page1-1 row">
<div class="col-3">
<?= StepsReestr::widget([])?>
</div>

    <div class="col-6">
        <?php
        if ($model) {
            foreach ($model as $mod) {
                echo DetailView::widget([
                    'model' => $mod,
                    'attributes' => [
                        'person',
                        'person_position',
                        'number_passport',
                        'first_date:date',
                        'caution_number',
                        'fine_amount',
                        'paid_amount',
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
                            'attribute' => 'claim',
                            'value' => function (Executions $model) {
                                $model->s_claim = $model->claim;
                                return $model->s_claim ? '<a class="btn btn-info" href="' . $model->getUploadedFileUrl('s_claim') . '" download>Yuklash<a/>' : 'Yuklanmagan';

                            },
                            'format' => 'raw'
                        ],
                        [
                            'attribute' => 'explanation_letter',
                            'value' => function (Executions $model) {
                                $model->s_explanation_letter = $model->explanation_letter;
                                return $model->s_explanation_letter ? '<a class="btn btn-info" href="' . $model->getUploadedFileUrl('s_explanation_letter') . '" download>Yuklash<a/>' : 'Yuklanmagan';

                            },
                            'format' => 'raw'
                        ],
                        [
                            'attribute' => 'court_letter',
                            'value' => function (Executions $model) {
                                $model->s_court_letter = $model->court_letter;
                                return $model->s_court_letter ? '<a class="btn btn-info" href="' . $model->getUploadedFileUrl('s_court_letter') . '" download>Yuklash<a/>' : 'Yuklanmagan';

                            },
                            'format' => 'raw'
                        ],
                    ],
                ]);
            }
        }
        ?>
    </div>

</div>
