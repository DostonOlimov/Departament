<?php

use common\models\RiskAnalisys;
use common\models\User;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\RiskAnalisys $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Risk Analisys', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="risk-analisys-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'id',
            'company_id',
            'risk_analisys_date',
            'risk_analisys_number',
            [
                'attribute' => 'summary_user_id',
                'value'  => function(RiskAnalisys $model){
                    $summary_user = User::findOne($model->summary_user_id);
                    if(!$summary_user){
                        return "Kiritilmagan";
                    }
                    return ($summary_user->name).' '.($summary_user->surname) ?? "Xatolik";
                }

            ],
            'created_by',
            'updated_by',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
