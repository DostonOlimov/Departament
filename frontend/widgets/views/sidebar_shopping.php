<?php

/**@var $shopping_company_id */
/**@var $shopping_instruction_id */

use common\models\shopping\Company;
use common\models\shopping\Product;
use yii\helpers\Url;

$action = Yii::$app->controller->action->id;
$hrefIns = '';
$classIns = 'disabled';
$hrefIns = ($shopping_instruction_id) ? '/shopping/instruction-view?id=' . $shopping_instruction_id : '/shopping/instruction-add';
$classIns = ($action == 'instruction' || $action == 'instruction-view') ? 'active' : ($shopping_instruction_id ? 'actived' : '');

$hrefCom = ($shopping_company_id) ?  Url::to(['/shopping/company-view', 'id' => $shopping_company_id])  : Url::to(['/shopping/company', 'instruction_id' => $shopping_instruction_id]);
$classCom = ($action == 'company' || $action == 'company-view') ? 'active' : ($shopping_instruction_id ? 'actived' : 'disabled');

$hrefProduct = '';
$classProduct = 'disabled';
$hrefLab = '';
$classLab = 'disabled';

if ($shopping_company_id) {
    $shoppingCompany = Company::findOne($shopping_company_id);
    $lab =  Product::find()->where(['shopping_company_id'=>$shopping_company_id])->all();

    $hrefProduct = $shoppingCompany->product ? Url::to(['/shopping/product-view', 'shopping_company' => $shoppingCompany->id]) : Url::to(['/shopping/product', 'shopping_company' => $shopping_company_id]);
    $classProduct = ($action == 'product' || $action == 'product-view') ? 'active' : 'actived';
    foreach($lab as $la){
    $hrefLab = $la['lab_conclusion'] ? Url::to(['/shopping/laboratory-view', 'shopping_company' => $shoppingCompany->id]) : Url::to(['/shopping/laboratory', 'shopping_company' => $shopping_company_id]);
    $classLab = ($action == 'laboratory' || $action == 'laboratory-view') ? 'active' : 'actived';
    }
}

   

?>

<div class="col-3  list-group margin-top">
    <a href="javascript:void(0);" class="list-group-item list-group-item-action notHover">Nazorat xaridi</a>
    <a href="<?= $hrefIns ?>" class="list-group-item list-group-item-action <?= $classIns ?>">Nazorat xaridini amalga oshirish uchun asos</a>
    <a href="<?= $hrefCom ?>" class="list-group-item list-group-item-action <?= $classCom ?>">XYUS to'g'risida ma'lumot</a>
    <a href="<?= $hrefProduct ?>" class="list-group-item list-group-item-action <?= $classProduct ?>">Maxsulot to'g'risidagi ma'lumot</a>
    <a href="<?= $hrefLab ?>" class="list-group-item list-group-item-action <?= $classLab ?>">Laborotoriya xulosasi</a>

</div>
