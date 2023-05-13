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

$this->title = 'Create Risk Analisys';
$this->params['breadcrumbs'][] = ['label' => 'Risk Analisys', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <!-- -----Side bar----- -->
    <div class="col-3" >
        <?php echo StepsRiskAnalisys::widget(['company_id' => null,'id' => null,])?>
    </div>
    
    <!-- -----search from company----- -->
    <div class="col-7" >
        <?php $form = ActiveForm::begin();?>
        
            <?= $form->field($company_search, 'stir')->widget(MaskedInput::className(), ['mask' => '999999999'])?>        
            <?= Html::submitButton('Qidirish', ['class' => 'btn btn-info']) ?>
                    <?php   if($t == 0 ) :?>
                        <div class = "text-danger" style="font-size:15px">Tashkilot topilmadi</div>
                    <?php endif; ?>
                          
                    
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
                        'view-company', 
                        'company_id' => $company->id,
                        'id' => null,
                    ], [
                        'class' => 'btn btn-success'
                        ]) ?>
            </div>
            <?php endif; ?>
            
            <?php ActiveForm::end(); ?>
        </div>