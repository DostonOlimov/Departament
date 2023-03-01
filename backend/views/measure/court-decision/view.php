<?php

use common\models\measure\CourtDecision;
use common\models\measure\CourtsName;
use common\models\measure\Executions;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\measure\CourtDecision $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Sud qarori', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="court-decision-view">

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
            [
                'attribute' => 'execution_id',
                'value' => function ($model) {
                    $name =  Executions::findOne([$model->execution_id]);
                    if($name) {
                        return $name->caution_number;
                    }
                   // return $re_users;
                },
             ],
            [
                'attribute' => 'court_id',
                'value' => function ($model) {
                    $name =  CourtsName::findOne([$model->court_id]);
                    if($name) {
                        return $name->name;
                    }
                   // return $re_users;
                },
             ],
            'decision_date',
            [
                'attribute' => 'decision_file',
                'value' => function ($model) {
                    $model->s_decision_file = $model->decision_file;
                    return $model->s_decision_file ? '<a class="btn btn-info" href="' . $model->getUploadedFileUrl('s_decision_file') . '" download>Yuklash<a/>' : 'Yuklanmagan';

                },
                'format' => 'raw'
            ],
            'fine_amount',
            'paid_amount',
            'paid_date',
            [
                'attribute' => 'discont',
                'value' => function ($model) {
                    if($model->discont == 1) {
                        return "Bor";
                    }
                    else{
                        return "Yo'q";
                    }
                   // return $re_users;
                },
             ],
            'paid_acount',
            'comment',
            [
                'label' => 'Mutaxasis',
                'value' => function ($model) {
                    $name =  \common\models\User::findOne([$model->created_by]);
                    if($name) {
                        return $name->name.' '.$name->surname;
                    }
                   // return $re_users;
                },
             ],
            // 'created_by',
            // 'updated_by',
            // 'created_at',
            // 'updated_at',
        ],
    ]) ?>

</div>
