<?php
use frontend\widgets\StepsPrevention;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\prevention\Prevention $model */

$this->title = Yii::t('app', 'Update Prevention: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Preventions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="row">    

    <div class="col-3">
            <?= StepsPrevention::widget([
                    
            ])?>
    </div>
    <div class="col-sm-8">
        
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>

</div>
