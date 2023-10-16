<?php

use yii\helpers\Html;
use yii\web\Application;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\identification\LaboratoryProtocol $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Laboratory Protocols', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="laboratory-protocol-view">

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
            'selected_product_id',
            'laboratory_id',
            'delivery_date',
            'protocol_number',
            'protocol_date',
            'status',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
        ],
    ]) ?>


<?php 
echo $this->render('/identification/laboratory-protocol-content/index', compact('model', 'searchModel', 'dataProvider')); ?>

</div>
