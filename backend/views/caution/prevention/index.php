<?php

use common\models\prevention\Prevention;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\bootstrap4\Breadcrumbs;
use kartik\export\ExportMenu;
/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Bartaraf etish ko\'rsatmasi');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prevention-index">
<?php
    echo Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            'options' => [
        'class' => 'breadcrumb float-sm-right'
                ]
        ]);
    ?>

<?php $gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],
        'id',
        [
            'attribute'=> 'companies_id',
            'value' => function ($data) {
                return $data ? $data->company->name : '';
            }
        ],
        [
            'attribute'=> 'instructions_id',
            'value' => function ($data) {
                return $data ? $data->instruction->command_number : '';
            }
        ],
        
       // 'message_date',
        [
            'attribute'=> 'created_by',
            'value'=> function($data){
                return $data ? $data->user->name .' '.$data->user->surname :'';
            }
        ],
        [
            'attribute'=> 'updated_by',
            'value'=> function($data){                
                return $data ? $data->user->name .' '.$data->user->surname :'';               
            }
        ],
        //'created_at',
        'message_date',
    ['class' => 'yii\grid\ActionColumn'],
    ];

    // Renders a export dropdown menu
    echo ExportMenu::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns,
        'clearBuffers' => true, //optional
    ]);?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute'=> 'instructions_id',
                'value' => function ($data) {
                    return $data ? $data->instruction->command_number : '';
                }
            ],
            [
                'attribute'=> 'companies_id',
                'value' => function ($data) {
                    return $data ? $data->company->name : '';
                }
            ],
            //'message_date',
            [
                'attribute' => 'created_by',
                'value' => function($data){
                    return $data ? $data->user->name . ' ' . $data->user->surname : '';
                }
            ],
            //'created_at',
            'updated_at',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
                'buttonOptions' => [
                    'class' => 'text-primary'
                ],
               
                'urlCreator' => function ($action, $searchmodel, $key, $index) {
                    if ($action === 'view') {
                        $url = Url::to(['view', 'id' => $searchmodel->id]);
                        return $url;
                    }
                }
            ],
        ],
    ]); ?>


</div>
