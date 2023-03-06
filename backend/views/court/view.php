<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap4\Breadcrumbs;
use common\models\Region;
use common\models\User;

/** @var yii\web\View $this */
/** @var backend\models\Court $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Courts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="court-view">

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
    <?php echo Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    'options' => [
        'class' => 'breadcrumb float-sm-right'
        ]
    ]);?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'region_id',
                'value' => function ( $model) {
                    return Region::findOne($model->region_id)->name;
                },
                'format' => 'raw',
            ],
            'name',
            [
                'attribute'=> 'created_by',
                'value'=> function($model){
                    $user = User::findOne($model->created_by);
                    return $user ? $user->name .' '.$user->surname :'';
                }
                ],
            //'created_by',
            'updated_by',
            
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
