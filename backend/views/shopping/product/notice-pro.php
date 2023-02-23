<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\shopping\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
           // 'shopping_company_id',
            'name',
            'lab_conclusion',
            //'cost',
            //'photo',
            //'photo_chek',
            //'created_by',
            //'updated_by',
            //'created_at',
            //'updated_at',

           // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
