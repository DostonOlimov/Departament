<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\UserPosition $model */

$this->title = 'Create User Position';
$this->params['breadcrumbs'][] = ['label' => 'User Positions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-position-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
