<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\User;
use common\models\control\Instruction;
use common\models\measure\Executions;

/** @var yii\web\View $this */
/** @var common\models\measure\Executions $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Executions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="executions-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Tahrirlash', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('O\'chirish', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           // 'id',
           [
            'label' => 'Davlat nazorati buyruq kodi',
            'value' => function ($model) {
                $name =  Instruction::findOne([$model->control_instruction_id]);
                if($name) {
                    return $name->command_number;
                }
               // return $re_users;
            },
         ],
            'person',
            'person_position:ntext',
            'number_passport',
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
            'first_date',
            'caution_number',
            [
                'attribute' => 'created_by',
                'label' => 'Mutaxassis',
                'value' => function ($model) {
                    $re_users = '';
                    $name =  User::findOne([$model->created_by]);
                    if($name) {
                        $re_users .= $name->username;
                    }
                    return $re_users;
                },
             ],
            //'updated_by',
            'created_at:date',
            'updated_at:date',
        ],
    ]) ?>

</div>
