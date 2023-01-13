<?php

/* @var $this yii\web\View */

/* @var $model Caution */

use common\models\control\Caution;
use common\models\control\Company;
use common\models\measure\Executions;
use frontend\widgets\StepsReestr;
use yii\widgets\DetailView;

$this->title = 'Davlat nazoratini o\'tkazish uchun asos';
$this->params['breadcrumbs'][] = $this->title;
//\yii\helpers\VarDumper::dump($model,12,true);die;
?>

<div class="page1-1 row">
<div class="col-3">
<?= StepsReestr::widget([])?>
</div>

    <div class="col-6">
        <?php
        if ($model) {
                echo DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'first_warn_date:date',
                        'warn_number',
                        'eco_date:date',
                        'eco_number',
                        'eco_quantity',
                        'eco_amount'
               
                    ],
                ]);
            }
        ?>
    </div>

</div>
