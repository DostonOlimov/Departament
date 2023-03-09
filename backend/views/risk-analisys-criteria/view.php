<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\RiskAnalisysCriteria;
use common\models\User;
use common\models\Region;

/** @var yii\web\View $this */
/** @var common\models\RiskAnalisysCriteria $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Risk Analisys Criterias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="risk-analisys-criteria-view">

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
            //'id',
            'document_paragraph',
            ['attribute'=> 'criteria_category','value'=> function($model)
                {$model = RiskAnalisysCriteria::getField($model->criteria_category);
                    return $model;}],
            'criteria',
            ['attribute'=> 'company_field_category','value'=> function($model)
                {$model = RiskAnalisysCriteria::getActivity($model->company_field_category);
                    return $model;}],
            'criteria_score',
            ['attribute'=>'created_by', 'value'=>function($model)
                {$user = User::findOne($model->created_by);
                    return $user ? $user->name.' '.$user->surname:' ';}],
            ['attribute'=>'updated_by', 'value'=>function($model)
            {$user = User::findOne($model->updated_by);
                return $user ? $user->name.' '.$user->surname:' ';}],
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
