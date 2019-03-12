<?php

namespace _;

use dmstr\helpers\Metadata;
use insolita\wgadminlte\Box;
use yii\data\ArrayDataProvider;
use yii\widgets\ListView;

/* @var $this \yii\web\View */
/* @var $key string */

?>

<?php $this->beginBlock('routes') ?>

<?php
$controllerDataProvider = new ArrayDataProvider(
    [
        'allModels' => Metadata::getModuleControllers($key),
    ]
);
?>

<?= ListView::widget(
    [
        'dataProvider' => $controllerDataProvider,
        'layout' => "{items}\n{pager}",
        'itemView' => '_controller',
    ]
)
?>

<?php $this->endBlock() ?>

<div class="col-sm-6 col-lg-4 height-50" style="height: 50vh; overflow: auto">
<?php Box::begin([
    'title' => $key.' '.(isset($model) && is_object($model) ? '<span class="label label-info">loaded</span>' : ''),
    'collapse' => false,
    'collapse_remember' => false,
    'type' => Box::TYPE_INFO
]) ?>
<?= $this->blocks['routes'] ?>
<?php Box::end() ?>
</div>
