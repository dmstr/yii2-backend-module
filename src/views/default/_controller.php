<?php

namespace _;

use dmstr\helpers\Metadata;
use Yii;
use yii\helpers\Html;
use yii\helpers\VarDumper;

// TODO: improve/handle detection in Metadata module
if ($model['module'] === Yii::$app->id) {
    $controller = Yii::$app->createController($model['name']);
} else {
    $controller = Yii::$app->createController($model['module'].'/'.$model['name']);
}

?>

<div class="row">
    <div class="col-sm-2">
        <b><?= $controller[0]->id ?></b>
    </div>
    <div class="col-sm-10">
        <div class="well">
            <b><?= Html::a($model['route'], $model['route']) ?></b>
            <br/>
            <?php
            foreach (Metadata::getControllerActions($controller[0]) as $action) {
                echo Html::a($action['route'], $action['route']).'<br/>';
            }
            ?>
        </div>
    </div>
</div>
