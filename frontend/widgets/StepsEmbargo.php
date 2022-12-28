<?php

namespace frontend\widgets;

use yii\bootstrap4\Widget;
use yii\helpers\VarDumper;

class StepsEmbargo extends Widget
{

    

    public function run()
    {

        return $this->render('sidebar_embargo');
    }

}
