<?php

namespace _;

use tests\models\Tree;
use Yii;

?>

<!-- Sidebar user panel -->
<?php if (!\Yii::$app->user->isGuest): ?>
    <div class="user-panel">
        <div class="pull-left image">
            <?php echo \cebe\gravatar\Gravatar::widget(
                [
                    'email' => \Yii::$app->user->identity->email,
                    'options' => [
                        'alt' => \Yii::$app->user->identity->username,
                    ],
                    'size' => 64,
                    'secure' => true,
                ]
            ); ?>
        </div>
        <div class="pull-left info">
            <p><?= \Yii::$app->user->identity->username ?></p>

            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
    </div>
<?php endif; ?>


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
