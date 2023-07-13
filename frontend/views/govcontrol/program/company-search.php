<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;
use frontend\widgets\StepsRiskAnalisys;
use yii\widgets\DetailView;
use common\models\Region;
use common\models\Company;

/** @var yii\web\View $this */
/** @var common\models\RiskAnalisys $model */

$this->title = 'Tashkilot qidirish';
$this->params['breadcrumbs'][] = ['label' => 'Company Search', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
    <!-- -----search from company----- -->
    <div class="col-7" >
        <?php $form = ActiveForm::begin();?>
        
            <?= $form->field($company_search, 'stir')->widget(MaskedInput::class, ['mask' => '999999999'])?>        
            <?= Html::submitButton('Qidirish', ['class' => 'btn btn-info']) ?>
                    <?php   if($t == 0 ) :?>
                        <div class = "text-danger" style="font-size:15px">Tashkilot topilmadi</div>
                    <?php endif; ?>
        <?php ActiveForm::end(); ?>

                    <!-- -----result from company----- -->
        <?php   if($t > 1) :?>
            <?= DetailView::widget(
                [
                    'model' => $company,
                    'attributes' => 
                    [
                        'company_name',
                        'id',
                        [
                            'attribute' =>'region_id',
                            'value'=> function($company){
                                $region = Region::findOne($company->region_id);
                                return $region->name;
                            }
                        ],
                        'address',
                        'registration_date',
                        
                        'ifut',
                    ],]) ?>
                    <?= Html::a('Saqlash',
                    [
                        'create', 
                        'company_id' => $company->id,
                        'id' => null,
                    ], [
                        'class' => 'btn btn-success'
                        ]) ?>
            <?php endif; ?>
            
        </div>