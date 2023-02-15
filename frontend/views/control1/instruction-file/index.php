<?php

use common\models\control\InstructionFile;
use yii\helpers\Html;
use yii\helpers\Url;
use common\models\User;
use yii\grid\ActionColumn;
use frontend\models\InsFileHelper;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\control\InstructionFileSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Instruction Files');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="instruction-file-index">  
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'Tekshiruv buyrug\'i',
                'value' => function ($data) {
                    return $data ? $data->instruction->command_number : '';
                }
            ],            
            [
                'attribute' => 'Asos',
                'value' => function (InstructionFile $model) {
                    return $model->basis_file ? '<a class="btn btn-info" href="' . $model->getUploadedFileUrl('basis_file') . '" download>Yuklash<a/>' :  'Yuklanmagan' ;
                },
                'format' => 'raw'
            ],
            [
                'attribute' => 'Dastur xati',
                'value' => function (InstructionFile $model) {
                    return $model->program_file ? '<a class="btn btn-info" href="' . $model->getUploadedFileUrl('program_file') . '" download>Yuklash<a/>' :'Yuklanmagan';
                },
                'format' => 'raw'
            ],
            [
                'attribute' => 'Bayonnoma',
                'value' => function (InstructionFile $model) {
                    return $model->order_file ? '<a class="btn btn-info" href="' . $model->getUploadedFileUrl('order_file') . '" download>Yuklash<a/>'  : 'Yuklanmagan';
                },
                'format' => 'raw'
            ], 
            ['attribute'=> 'created_by',
                'value'=> function($model){
                    $user = User::findOne($model->created_by);
                    return $user ? $user->name .' '.$user->surname :'';
                }
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, InstructionFile $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
