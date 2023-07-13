<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\actselection\ActSelection $model */

$this->title = 'Create Act Selection';
$this->params['breadcrumbs'][] = ['label' => 'Act Selections', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerJs(
    '$(".dynamicform_wrapper").on("beforeInsert", function(e, item) {
        console.log("beforeInsert");
    });
    
    $(".dynamicform_wrapper").on("afterInsert", function(e, item) {
        console.log("afterInsert");
    });
    
    $(".dynamicform_wrapper").on("beforeDelete", function(e, item) {
        if (! confirm("Siz rostdan ham ushbu elementni o\'chirmoqchimisiz?")) {
            return false;
        }
        return true;
    });
    
    $(".dynamicform_wrapper").on("afterDelete", function(e) {
        console.log("Deleted item!");
    });
    
    $(".dynamicform_wrapper").on("limitReached", function(e, item) {
        alert("Limit reached");
    });'
);
?>
<div class="act-selection-create container">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'models' => $models,
    ]) ?>

</div>
