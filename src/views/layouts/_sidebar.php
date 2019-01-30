<?php

namespace _;

use tests\models\Tree;
use Yii;

// get menu items from pages, if available
if (Yii::$app->hasModule('pages')) {
    $menuItems = \dmstr\modules\pages\models\Tree::getMenuItems('backend', true);
} else {
    $menuItems = [];
}

?>


<?php

echo \dmstr\widgets\Menu::widget(
    [
        'options' => ['class' => 'sidebar-menu tree', 'data-widget' => 'tree'],
        'encodeLabels' => false,
        'items' => \yii\helpers\ArrayHelper::merge(
            ['items' => ['label' => 'Backend navigation', 'options' => ['class' => 'header']]],
            $menuItems
        ),
    ]
);
?>
