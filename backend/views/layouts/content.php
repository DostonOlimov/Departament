<?php
/* @var $content string */

use yii\bootstrap4\Breadcrumbs;
use common\widgets\Alert;
use yii\bootstrap4\Html;
?>
<div class="content-wrapper" >
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
                <div class="col-sm-12">
                    <h1 class="m-0">
                        <?php
                        if (!is_null($this->title)) {
                            echo \yii\helpers\Html::encode($this->title);
                        } else {
                            echo \yii\helpers\Inflector::camelize($this->context->id);
                        }
                        ?>
                    </h1>
                </div><!-- /.col -->
               
            </div><!-- /.row -->    
    </div>
    <!-- /.content-header -->
  
    <!-- Main content -->
    <div class="content">
    <?= Alert::widget() ?>
        <?= $content ?><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>