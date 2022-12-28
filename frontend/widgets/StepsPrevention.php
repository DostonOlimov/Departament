<?php

namespace frontend\widgets;

use yii\bootstrap4\Widget;
use yii\helpers\VarDumper;

class StepsPrevention extends Widget
{

    

    public function run()
    {

        return $this->render('sidebar_prevention');
    }

}
