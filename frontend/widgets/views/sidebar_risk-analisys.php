<?php 
use yii\helpers\Html;
use yii\helpers\Url;?>
<?php
$action  = Yii::$app->controller->action->id;

$href_company = ($company_id) ? Url::to(['view-company', 'company_id' => $company_id,'id' => $id,]):'search';
$class_company = ($action == 'view-company' || $action == 'search') ? 'active': '';




// debug($class_company, false);
// debug($company_id,false);


$class_risk_analisys = ($action == 'create' || $action == 'view') ? 'active': '';

if ($id) {
    $href_risk_analisys = Url::to(['view', 'id' => $id, 'company_id' => $company_id]);
}
else if($company_id) {
    $href_risk_analisys = Url::to(['create', 'company_id' => $company_id]);
}
else {
    $href_risk_analisys = '';
    $class_risk_analisys = 'disabled';
}



// debug($class_risk_analisys, false);
// debug($id,false);

$class_criteria = ($action == 'add-criteria' || $action == 'view-criteria') ? 'active': '';
// debug($action,false);
// debug($class_criteria,false);

if ($view_id){
    $href_criteria = Url::to(['view-criteria', 'id' => $id, 'company_id' => $company_id]);
} 
else if($id) {
    $href_criteria = Url::to(['add-criteria', 'id' => $id, 'company_id' => $company_id]) ;
}
else {
    $href_criteria = '';
    $class_criteria = 'disabled';
}
// debug($class_criteria, false);
// debug($view_id,false);
// debug($id,false);
// if ($company_id)
// {
//     // $href_company = 
// }
?>




<div class="list-group margin-topSite">
        <ul class="list-group">
            <!-- header -->
            <a href="index" class="list-group-item list-group-item-action ">
                Xavf tahlili
            </li>
            <!-- li-1 -->
            <a href="<?= $href_company ?>" class="list-group-item list-group-item-action <?= $class_company?>">
                Tashkilot to'g'risida ma'lumotlar
            </a>
            <!-- li-2 -->
            <a href="<?= $href_risk_analisys ?>" class="list-group-item list-group-item-action <?= $class_risk_analisys?>">
                Xavf tahlili to'g'risida ma'lumotlar
            </a>
            <!-- li-3 -->
            <a href="<?= $href_criteria ?>" class="list-group-item list-group-item-action <?= $class_criteria?>">
                Xavf tahlili mezonlari
            </a>
        </ul>
</div>