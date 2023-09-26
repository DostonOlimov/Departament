<?php

use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/** @var yii\web\View $this */
/** @var common\models\govcontrol\Order $model */

$this->title = 'Tekshiruv buyrug\'i yaratish';
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$date_pluginOptions =['pluginOptions' => ['autoclose' => true,'format' => 'dd.mm.yyyy']];
?>
<div class="order-create">

<h1><?= Html::encode($this->title) ?></h1>

<?= $this->render('_form', [
    'model' => $model,
    'program' => $program,
]) ?>

</div>
