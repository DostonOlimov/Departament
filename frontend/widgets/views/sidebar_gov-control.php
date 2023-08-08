<?php

use common\models\govcontrol\PrimaryData;
use yii\helpers\Html;
use yii\helpers\Url;?>
<?php
$app = Yii::$app;
$controller = Yii::$app->controller->id;
$action  = Yii::$app->controller->action->id;
$current_page = $controller.'/'.$action; 
// debug($controller);
// debug($current_page);
$href_company = Url::to(['govcontrol/gov-control/view-company', 'id' => $gov_control_order_id]);
$class_company = ($action == 'view-company') ? 'active': '';

$href_base = Url::to(['govcontrol/gov-control/view', 'id' => $gov_control_order_id]);
$class_base = ($action == 'view' && $controller == 'govcontrol/gov-control') ? 'active': '';

    $href_primary = PrimaryData::findOne(['gov_control_order_id' => $gov_control_order_id]) ?
    Url::to(['govcontrol/primary-data/view', 'gov_control_order_id' => $gov_control_order_id]):
    Url::to(['govcontrol/primary-data/create', 'gov_control_order_id' => $gov_control_order_id]);
$class_primary = ($current_page == 'govcontrol/primary-data/create' or 
$current_page == 'govcontrol/primary-data/view') ? 'active': '';

$href_act_selection = Url::to(['actselection/act-selection/index', 'gov_control_order_id' => $gov_control_order_id]);
$class_act_selection = ($controller == 'actselection/act-selection')?'active':'';

$href_identification = Url::to(['govcontrol/gov-control/identification', 'gov_control_order_id' => $gov_control_order_id]);
$class_identification = ($current_page == 'govcontrol/gov-control/identification') ? 'active': '';

?>




<div class="list-group margin-topSite">
        <ul class="list-group">
            <!-- header -->
            <a href="/govcontrol/gov-control/index" class="list-group-item list-group-item-action ">
                Davlat nazorati
            </li>
            <!-- li-1 -->
            <a href="<?= $href_company ?>" class="list-group-item list-group-item-action <?= $class_company?>">
                Tashkilot to'g'risida ma'lumotlar
            </a>
            <!-- li-2 -->
            <a href="<?= $href_base ?>" class="list-group-item list-group-item-action <?= $class_base?>">
                Asos
            </a>
            <!-- li-3 -->
            <a href="<?= $href_primary ?>" class="list-group-item list-group-item-action <?= $class_primary?>">
                Birlamchi ma'lumotlar
            </a>
            <!-- li-4 -->
            <a href="<?= $href_act_selection ?>" class="list-group-item list-group-item-action <?= $class_act_selection?>">
                Namuna tanlab olish dalolatnomalari
            </a>
            <!-- li-5 -->
            <a href="<?= $href_identification ?>" class="list-group-item list-group-item-action <?= $class_identification?>">
                Tashqi ko'rinish bayonnomalari
            </a>
        </ul>
</div>