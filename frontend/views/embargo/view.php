<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\control\Company;
use common\models\control\Instruction;
use common\models\embargo\Embargo;


/** @var yii\web\View $this */
/** @var common\models\embargo\Embargo $model */

$this->title = $model->id;
$this->title = Yii::t('app', 'Korxona');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Embargos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="container">


    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
       
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
                
                [
                    'label' => 'Korxona',
                    'value' => function ($model) {
                        $company = Company::findOne(['id' => $model->companies_id]);
                        return $company ? $company->name : '';
                    }
                ],
                [
                    'label' => 'Korxona INN',
                    'value' => function ($model) {
                        $company = Company::findOne(['id' => $model->companies_id]);
                        return $company ? $company->inn : '';
                    }
                ],
    
                [
                    'label' => 'Korxona manzili',
                    'value' => function ($model) {
                        $company = Company::findOne(['id' => $model->companies_id]);
                        return $company ? $company->address : '';
                    }
                ],
                [
                    'label' => 'Korxona telefon raqami',
                    'value' => function ($model) {
                        $company = Company::findOne(['id' => $model->companies_id]);
                        return $company ? $company->phone : '';
                    }
                ],
    
                [
                    'label' => 'Tekshiruv kodi',
                    'value' => function ($model) {
                        $instruction = Instruction::findOne(['id' => $model->instructions_id]);
                        return $instruction ? $instruction->command_number : '';
                    }
                ],

            
            'comment:ntext',
            [
                'attribute' => 'status',
                'value' => function($model){
                    if($model->status==1){
                    return $model->status==1 ? '<span class="text-primary">Tasdiqlangan</span>':'<span class="text-warning">Jarayonda</span>'?:'<span class="text-alert">Bekor qilingan</span>';
                    }elseif($model->status==2){
                        return $model->status==2 ? '<span class="text-danger">Bekor qilingan</span>':'<span class="text-warning">Jarayonda</span>'?:'<span class="text-alert">Bekor qilingan</span>';  
                    }else{
                        return $model->status==0 ? '<span class="text-warning">Jarayonda</span>':'<span class="text-warning">Jarayonda</span>'?:'<span class="text-alert">Bekor qilingan</span>';   
                    }
                },
                
                'format' => 'raw',
            ],
            //'status',
            'message_date',
            'inspector_name',
        ],
    ]) ?>

</div>
