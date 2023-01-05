<?php
use frontend\widgets\StepsEmbargo;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\bootstrap4\Breadcrumbs;

/** @var yii\web\View $this */
/** @var common\models\embargo\Embargo $model */

$this->title = Yii::t('app', 'Tahrirlash: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Taqiqlash'), 'url' => ['embargo']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['embargo-view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Tahrirlash');
?>
<div class="row">

    <h1><!--?= Html::encode($this->title) ?--></h1>

    <div class="col-4">
            <?= StepsEmbargo::widget([
                    
            ])?>
    </div>
    <div class="col-sm-8" style="margin-left:-30px">
            <?php
            echo Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                 'options' => [
                'class' => 'p-2 bg-primary breadcrumb float-sm-right'
                        ]
                ]);
            ?>
            <div class="col-sm-9" style="margin-top:-10%;">

                <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($model, 'instructions_id')->dropdownList([
                    $model['instructions_id'] => $model->instruction->command_number
                ]);?>

                <?= $form->field($model, 'companies_id')->dropdownList([
                    $model['companies_id'] => $model->company->name
                ]);?>

                <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

                <!--?= $form->field($model, 'status')->dropdownList([                           
                    '0' => 'Jarayonda',
                    '1' => 'Tasdiqlangan',
                    '2' => 'Bekor qilingan',
                    
                        ]
                );?-->

                <?= $form->field($model, 'created_by')->dropdownList([
                    $model['created_by'] => $model->user->name .' '. $model->user->surname 
                ]);?>

                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
    </div>

</div>
