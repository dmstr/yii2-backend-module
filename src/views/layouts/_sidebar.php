<?php

namespace _;

use dmstr\widgets\Menu;
use Yii;
use yii\helpers\ArrayHelper;

// get menu items from pages, if available
if (Yii::$app->hasModule('pages')) {
    $menuItems = dmstr\modules\pages\models\Tree::getMenuItems('backend', true);
} else {
    $menuItems = [];
}

?>


<?php

echo Menu::widget(
    [
        'options' => ['class' => 'sidebar-menu tree', 'data-widget' => 'tree'],
        'encodeLabels' => false,
        'items' => ArrayHelper::merge(
            ['items' => ['label' => 'Backend navigation', 'options' => ['class' => 'header']]],
            $menuItems
        ),
    ]
);
?>
