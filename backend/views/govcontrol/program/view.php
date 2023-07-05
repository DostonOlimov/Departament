<?php

use common\models\Company;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\govcontrol\Program $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Programs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="program-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    <?= Html::a('Buyrug\' yaratish', ['govcontrol/order/create', 'gov_control_program_id' => $model->id], ['class' => 'btn btn-success']) ?>
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
            [
                'attribute' => 'company_id',
                'value' => function($model){
                    return Company::findOne($model->company_id)->company_name;
                }
            ],
            [
                'attribute' => 'company_type_id',
                'value' => function($model){
                    return $model->getCompanyType($model->company_type_id);
                }
            ],
            
            [
                'attribute' => 'gov_control_type',
                'value' => function($model){
                    return $model->getGovcontrolType($model->gov_control_type);
                }
            ],
        ],
    ]) ?>

</div>
