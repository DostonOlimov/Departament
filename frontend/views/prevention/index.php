<?php

use common\models\prevention\Prevention;
use common\models\Control\Company;
use common\models\Control\Instruction;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use frontend\widgets\StepsPrevention;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;

/** @var yii\web\View $this */
/** @var common\models\prevention\PreventionSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Korxona');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-3">
        <?= StepsPrevention::widget([
                
        ])?>
    </div>
     <div class="col-sm-8">       

            <p>
                <?= Html::a(Yii::t('app', 'Ko\'rsatma qo\'shish'), ['search'], ['class' => 'btn btn-success']) ?>
            </p>

            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'headerRowOptions' => ['style' => 'background-color: #0072B5'],
                'columns' => [
                  //  ['class' => 'yii\grid\SerialColumn'],
               

                  [
                    'attribute'=> 'id',
                    'value' => function ($model) {
                        $prevention = Prevention::findOne(['id' => $model->id]);
                        return $prevention ? $prevention->id : '';
                    }
                ],
                    [
                        'attribute'=> 'companies_id',
                        'value' => function ($model) {
                            $company = Company::findOne(['id' => $model->companies_id]);
                            return $company ? $company->name : '';
                        }
                    ],
                    [
                        'attribute'=> 'instructions_id',
                        'value' => function ($model) {
                            $instruction = Instruction::findOne(['id' => $model->instructions_id]);
                            return $instruction ? $instruction->command_number : '';
                        }
                    ],
                    
                    'message_date',
                    'inspector_name',
                    [
                        'class' => ActionColumn::className(),
                        'template' => '{view}',
                        'buttonOptions' => [
                            'class' => 'text-primary'
                        ],
                        'urlCreator' => function ($action, Prevention $model, $key, $index) {
                            if ($action === 'view') {
                                $url = Url::to(['prevention/view', 'id' => $model->id]);
                                return $url;
                            }
                            // return Url::toRoute([$action, 'id' => $model->id]);
                        }
                    ],
                ],
            ]); ?>
        </div>


</div>