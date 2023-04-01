<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/** @var yii\web\View $this */
/** @var common\models\RiskAnalisys $model */

$this->title = 'Create Risk Analisys';
$this->params['breadcrumbs'][] = ['label' => 'Risk Analisys', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="risk-analisys-create">

<?php $form = ActiveForm::begin(); ?>
<div class="row">
        <div class="col-sm-6" style="font-size:24px">
        <?= $form->field($model, 'stir')->widget(MaskedInput::className(), [
                'mask' => '999999999'
            ])?>
</div>
<div class="col-sm-2">
    <?= Html::submitButton('Qidirish', ['class' => 'btn btn-success']) ?>
</div>
</div>
<?php if($t == 0 ) { echo "<div class = \"text-danger\">Korxona topilmadi</div>";  }
if($t == 1 ) :?>
      <div class = "text-danger>">  <?= $company->company_name ?>  </div>
      <div class = "text-danger>">  <?= $company->status ?>  </div>
      <div class = "text-danger>">  <?= $company->ifut ?>  </div>
      <p>
        <?= Html::a('Create Risk Analisys', ['create',$company->id], ['class' => 'btn btn-success']) ?>
    </p>
 <?php endif; ?>



<?php ActiveForm::end(); ?>

</div>