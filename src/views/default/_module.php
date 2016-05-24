<?php

namespace _;

use insolita\wgadminlte\Box;
use yii\data\ArrayDataProvider;
use yii\widgets\ListView;

/* @var $this \yii\web\View */

?>

<?php $this->beginBlock('routes') ?>

<?php
$controllerDataProvider = new ArrayDataProvider(
    [
        'allModels' => \dmstr\helpers\Metadata::getModuleControllers($key),
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


<?php Box::begin([
    'title' => $key.' '.(isset($model) && is_object($model) ? '<span class="label label-info">loaded</span>' : ''),
    'collapse' => true,
    'collapse_remember' => false,
]) ?>
<?= $this->blocks['routes'] ?>
<?php Box::end() ?>