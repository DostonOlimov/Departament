<?php

use common\models\Court;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use kartik\export\ExportMenu;
use yii\helpers\ArrayHelper;
use yii\bootstrap4\Breadcrumbs;
use common\models\Region;
use common\models\User;

/** @var yii\web\View $this */
/** @var backend\models\CourtSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Hududiy sudlar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="court-index">
    
    <?php


echo Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    'options' => [
        'class' => 'breadcrumb float-sm-right'
        ]
    ]);
    
    
    ?>

    <?= Html::a('Qo\'shish', ['create'], ['class' => 'btn btn-success']) ?>

<?php  //echo $this->render('_search', ['model' => $searchModel]); ?>
<?php $gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],
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
        [
            'attribute'=> 'updated_by',
            'value'=> function($model){
                $user = User::findOne($model->updated_by);
                return $user ? $user->name .' '.$user->surname :'';
            }
            ],
];

echo ExportMenu::widget([
    'dataProvider' => $dataProvider,
    'columns' => $gridColumns,
]);

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        
        'id',
        [
            'attribute' => 'region_id',
            'value' => function ( $model) {
                return Region::findOne($model->region_id)->name;
            },
            'format' => 'raw',
        ],
        'name',
        //'created_by',
            [
            'attribute'=> 'created_by',
            'value'=> function($model){
                $user = User::findOne($model->created_by);
                return $user ? $user->name .' '.$user->surname :'';
            }
            ],
        'updated_by',
        'created_at',
        'updated_at',
        [
            'class' => ActionColumn::className(),
            'urlCreator' => function ($action, Court $model, $key, $index, $column) {
                return Url::toRoute([$action, 'id' => $model->id]);
            }
        ],
    ],
]); 
?>


</div>
