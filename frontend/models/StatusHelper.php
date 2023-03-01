<?php

namespace frontend\models;

use common\models\control\Instruction;

class StatusHelper
{
    public static function getLabel($status)
    {
        $class = 'secondary';
        if ($status == Instruction::GENERAL_STATUS_SEND) {
            $class = 'primary';
        }
        if ($status == Instruction::GENERAL_STATUS_DONE) {
            $class = 'success';
        }
        if ($status == Instruction::GENERAL_STATUS_EXTEND) {
            $class = 'info';
        }
        if ($status == Instruction::GENERAL_STATUS_TRANSFER) {
            $class = 'danger';
        }
        return '<label class="btn bg-' . $class . '" style="font-weight:bold;color:white;">' . Instruction::getStatus($status) . '</label>';

    }

    public static function getLabelForPro($status)
    {
        $class = 'secondary';
        if ($status == \common\models\profilactic\Instruction::GENERAL_STATUS_SEND) {
            $class = 'primary';
        }
        if ($status == \common\models\profilactic\Instruction::GENERAL_STATUS_DONE) {
            $class = 'success';
        }
        return '<label class="btn bg-' . $class . '" style="font-weight:bold;">' . Instruction::getStatus($status) . '</label>';

    }
}
