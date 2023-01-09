<?php 
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use frontend\widgets\StepsPrevention;
use common\models\prevention\Prevention;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\bootstrap4\Breadcrumbs;

/** @var yii\web\View $this */
/** @var common\models\prevention\PreventionSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Ogohlantirish xati');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="">
    <div class="row">
        <div class="col-sm-4">
            <?= StepsPrevention::widget([
                    
            ])?>
        </div>
        <div class="col-sm-8" style="margin-left:-30px;">       

                <p>
                    <?= Html::a(Yii::t('app', 'Ko\'rsatma qo\'shish'), ['letters-search'], ['class' => 'btn btn-success']) ?>
                </p>
                <div class="">
                    <?php
                        echo Breadcrumbs::widget([
                            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                            'options' => [
                                'class' => 'p-2 bg-primary breadcrumb float-sm-right'
                            ]
                        ]);
                        ?>
                </div>
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'headerRowOptions' => ['style' => 'background-color: #0072B5'],
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        'id',
                        'company_id',
                        'letter_date',
                        'letter_number',
                        'file',
                        //'inpector_name',
                        [
                            // 'class' => ActionColumn::className(),
                            // 'urlCreator' => function ($action, CautionLetters $model, $key, $index, $column) {
                            //     return Url::toRoute([$action, 'id' => $model->id]);
                            // }
                        ],
                    ],
                ]); ?>
            </div>
    </div>
</div>
