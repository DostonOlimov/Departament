<?php

use common\models\normativedocument\NormativeDocument;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\govcontrol\Program $model */

$this->title = 'Tekshiruv dasturi yaratish';
$this->params['breadcrumbs'][] = ['label' => 'Programs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="program-create">
<?php 
    debug(NormativeDocument::class,false);
    debug(ProgramProperty::class,false);
    debug(NormativeDocument::getNormativeDocumentNames());
    ?>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
