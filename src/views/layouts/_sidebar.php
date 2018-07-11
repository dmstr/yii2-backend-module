<?php

namespace _;

use tests\models\Tree;
use Yii;

?>




<?php


echo \dmstr\widgets\Menu::widget(
    [
        'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
        'encodeLabels' => false,
        'items' => \yii\helpers\ArrayHelper::merge(
            ['items' => ['label' => 'Backend navigation', 'options' => ['class' => 'header']]],
            \dmstr\modules\pages\models\Tree::getMenuItems('backend', true)
        ),
    ]
);
?>
