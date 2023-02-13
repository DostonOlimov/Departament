<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\control\PrimaryProduct $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Primary Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="primary-product-view">

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
            'control_primary_data_id',
            'product_type_id',
            'product_name',
            'made_country',
            'product_measure',
            'residue_amount',
            'residue_quantity',
            'potency',
            'year_amount',
            'year_quantity',
            'labaratory_checking',
            'certification',
            'photo',
            'quality',
            'cer_amount',
            'cer_quantity',
            'description:ntext',
            'codetnved:ntext',
        ],
    ]) ?>

</div>
