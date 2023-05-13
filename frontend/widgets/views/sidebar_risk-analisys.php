<?php 
use yii\helpers\Html;
use yii\helpers\Url;?>
<?php
$action  = Yii::$app->controller->action->id;
//debug($risk_company_id);

$href_company = ($company_id) 
? Url::to(['view-company', 'company_id' => $company_id, 
'id' => $id,]) 
:'create-company';
$class_company = '';

$href_risk_analisys = ($id) 
? Url::to(['view', 'id' => $id, 'company_id' => $company_id]) 
: Url::to(['create', 'company_id' => $company_id]);
$class_risk_analisys = '';

$href_criteria = ($view_id) 
? Url::to(['view-criteria', 'id' => $id, 'company_id' => $company_id])
: Url::to(['add-criteria', 'id' => $id, 'company_id' => $company_id]);
$class_criteria = '';

// if ($company_id)
// {
//     // $href_company = 
// }
?>




<div class="list-group margin-topSite">
        <ul class="list-group">
            <!-- header -->
            <li class="list-group-item disabled" aria-disabled="true">
                Xavf tahlili
            </li>
            <!-- li-1 -->
            <a href="<?= $href_company ?>" class="list-group-item list-group-item-action ">
                Tashkilot to'g'risida ma'lumotlar
            </a>
            <!-- li-2 -->
            <a href="<?= $href_risk_analisys ?>" class="list-group-item list-group-item-action ">
                Xavf tahlili to'g'risida ma'lumotlar
            </a>
            <!-- li-3 -->
            <a href="<?= $href_criteria ?>" class="list-group-item list-group-item-action ">
                Xavf tahlili mezonlari
            </a>
        </ul>
</div>