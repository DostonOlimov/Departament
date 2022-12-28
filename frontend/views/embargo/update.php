<?php
use frontend\widgets\StepsEmbargo;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\embargo\Embargo $model */

$this->title = Yii::t('app', 'Update Embargo: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Embargos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="row">

    <h1><!--?= Html::encode($this->title) ?--></h1>

    <div class="col-3">
            <?= StepsEmbargo::widget([
                    
            ])?>
    </div>
    <div class="col-sm-8">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>

</div>
