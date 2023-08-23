<?php

use common\models\govcontrol\ProgramProperty;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\widgets\ListView;

/** @var yii\web\View $this */
/** @var common\models\govcontrol\ProgramPropertySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Program Properties';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="program-property-index">

    <p>
        <?php 
        // echo Html::a('Create Program Property', ['create'], ['class' => 'btn btn-success']); 
        ?>
    </p>

    <?php 
    echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) {
            // return Html::a(Html::encode($model->id), ['view', 'id' => $model->id]);
            return Html::encode($model->id);
        },
    ]) ?>


</div>
