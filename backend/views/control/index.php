<?php

use common\models\control\Company;
use common\models\control\Instruction;
use common\models\control\InstructionUser;
use common\models\Region;
use common\models\User;
use frontend\models\StatusHelper;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\control\InstructionSearch */
/* @var $dataProvider yii\data\ActiveDataprovider */

$this->title = 'Korxonalar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-index">

    <p  style="display:inline">
        <?= Html::a('Export', ['/control/control/export-form'], ['class' => 'btn btn-primary']) ?>
    </p>

    <p  style="display:inline-block">
        <?= Html::a('Qo\'shish', ['/control/control/instruction'], ['class' => 'btn btn-primary']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            
            [
                'attribute' => 'region_id',
                'label' => 'Hudud',
                'value' => function (Instruction $model) {
                    return $model->controlCompany ? $model->controlCompany->region->name : '';
                },
                'filter' => Html::activeDropDownList($searchModel, 'region_id', ArrayHelper::map(Region::find()->all(), 'id', 'name'), ['class' => 'form-control', 'prompt' => '- - -'])
            ],
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
            [
                'class' => 'yii\grid\SerialColumn',
            ],
            [
                'attribute' => 'name',
                'label' => 'XYUS nomi',
                'value' => function (Instruction $model) {
                    return $model->controlCompany ? $model->controlCompany->name : '';
                },
                'filter' => Html::activeInput('text',$searchModel, 'name', ['class' => 'form-control']),
                'format' => 'raw',
            ],
            [
                'attribute' => 'inn',
                'label' => 'XYUS STIR',
                'value' => function (Instruction $model) {
                    return $model->controlCompany ? $model->controlCompany->inn : '';
                },
                'filter' => Html::activeInput('text',$searchModel, 'inn', ['class' => 'form-control']),
                'format' => 'raw',
            ],
            [
                'label' => 'XYUS yuridik manzili',
                'value' => function (Instruction $model) {
                    return $model->controlCompany ? $model->controlCompany->address : '';
                },
                'format' => 'raw',
            ],
            [
                'label' => 'XYUS faoliyat turi',
                'value' => function ($model) {
                    return $model->controlCompany ? $model->controlCompany->type : '';
                },
                'format' => 'raw',
            ],
            [
                'attribute' => 'base',
                'value' => function ($model) {
                    return Instruction::getType($model->type);
                },
                'filter' => Html::activeDropDownList($searchModel, 'type', Instruction::getType(), ['class' => 'form-control', 'prompt' => '- - -'])
            ],
            [
                'attribute' => 'created_by',
                'label' => 'Mutaxassis',
                'value' => function ($model) {
                    $re_users = '';
                    $in_users = InstructionUser::findAll(['instruction_id'=>$model->id]);
                    foreach ($in_users as $user) {
                       $name =  User::findOne([$user->user_id]);
                        $re_users .= $name->username.',';
                    }
                    return $re_users;
                },
                'filter' => Html::activeDropDownList($searchModel, 'created_by', ArrayHelper::map(User::find()->all(), 'id', 'username'), ['class' => 'form-control', 'prompt' => '- - -'])
            ],
            'created_at',
            'updated_at',   
            [
                'label' => 'Status',
                'value' => function ($model) {
                    if($model->real_checkup_date)
                    {
                        return StatusHelper::getLabel($model->general_status);
                    }
                    else
                    {
                        return '<label class="btn bg-warning" style="font-weight:bold;">Yangi tekshiruv </label>';
                    }
                },
                'format' => 'raw'
            ],
        ],
    ]); ?>


</div>
