<?php

use common\models\identification\IdentificationContent;
use common\models\normativedocument\NormativeDocumentContent;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\identification\IdentificationContent $model */
/** @var yii\widgets\ActiveForm $form */

    $normative_document_content = NormativeDocumentContent::findOne($model->normative_document_content_id);
?>

   <style>
      table,tr,th,td {
         border:1px solid black;
      }
   </style>
<body>
   <h2>Tables in HTML</h2>
   <table style="width: 100%">
      <tr>
         <th >First Name </th>
         <th>Job role</th>
      </tr>
      <tr>
         <td >Tharun</td>
         <td rowspan="2">Content writer</td>
      </tr>
      <tr>
         <td >Akshaj</td>
      </tr>
   </table>
</body>
