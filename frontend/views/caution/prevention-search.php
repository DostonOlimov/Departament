<?php

use yii\helpers\Html;
use frontend\widgets\StepsPrevention;
use kartik\date\DatePicker;
use yii\widgets\ActiveForm;
use common\models\prevention\Prevention;

/** @var yii\web\View $this */
/** @var common\models\prevention\Prevention $model */
$this->title = Yii::t('app', 'Qidiruv');
?>
<div class="container">
    <div class="page1-1 row">
        <form action="<?= \yii\helpers\Url::to(['caution/prevention-create']) ?>" method="get">
        <label for="">Tekshiruv kodi</label>
            <input class="form-control" name="q" required minlength="5" maxlength="20" type="text" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Tekshiruv kodini kiriting...';}" required=""><br>
            <input class="btn btn-primary" type="submit" value="Qidiruv">

        </form>
    </div>
</div>