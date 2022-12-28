<?php

use yii\helpers\Html;
use common\models\Control\Company;
use common\models\prevention\Prevention;
use common\models\Control\Instruction;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\prevention\Prevention $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Preventions'), 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$this->title = Yii::t('app', 'Korxona');
?>
<div class="container">



    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <!--?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?-->
    </p>

    <?= DetailView::widget([
        'model' => $model,
        
        'attributes' => [
            [
                'label' => 'Yozma ko\'rsatma raqami',
                'value' => function ($model) {
                    $prevention = Prevention::findOne(['id' => $model->id]);
                    return $prevention ? $prevention->id : '';
                }
            ],
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
           
            'message_date',
            'comment',
            'inspector_name',
            'inspectors',
        ],
    ]) ?>

</div>