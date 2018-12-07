<?php

use yii\bootstrap\Nav as Menu;
use yii\helpers\Html;
use yii\helpers\Url;
use dmstr\modules\backend\Module;

?>

<?php
$backendModule = Yii::$app->getModule('backend');
foreach (\dmstr\helpers\Metadata::getModules() as $name => $module) {
    if (in_array($name, $backendModule->modulesDashboardBlacklist)) {
        continue;
    }

    $role = $name;

    $defaultItem = [
        'icon' => 'fa fa-cube',
        'label' => $name,
        'url' => ['/'.$name],
        'visible' => Yii::$app->user->can($role),
        'items' => [],
    ];

    $developerMenuItems[] = $defaultItem;
}
?>

<aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
        <li class="active">
            <a href="#control-sidebar-home-tab" data-toggle="tab" aria-expanded="true"><i
                        class="fa fa-home"></i></a></li>
        <li class="">
            <a href="#control-sidebar-theme-demo-options-tab" data-toggle="tab" aria-expanded="false"><i
                        class="fa fa-wrench"></i></a></li>
        <li class="">
            <a href="#control-sidebar-settings-tab" data-toggle="tab" aria-expanded="false"><i
                        class="fa fa-edit"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
        <!-- Home tab content -->
        <div class="tab-pane active" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">Frontend Menu</h3>
            <ul class="control-sidebar-menu">
                <li>
                    <?php
                    // render home
                    echo Menu::widget(
                        [
                            'options' => ['class' => 'menu'],
                            'encodeLabels' => false,
                            'items' => [
                                [
                                    'label' => 'Home',
                                    'url' => Yii::$app->homeUrl,
                                ],
                            ],
                        ]
                    );
                    ?>
                    <?php
                    // render root pages
                    echo Menu::widget(
                        [
                            'options' => ['class' => 'menu'],
                            'encodeLabels' => false,
                            'items' => \dmstr\modules\pages\models\Tree::getMenuItems('root'),
                        ]
                    );
                    ?>


                </li>
            </ul>
            <!-- /.control-sidebar-menu -->


        </div>
        <div id="control-sidebar-theme-demo-options-tab" class="tab-pane">
            <h3 class="control-sidebar-heading">Languages</h3>


            <!-- inner menu: contains the actual data -->
            <ul class="control-sidebar-menu">
                <?php foreach (Yii::$app->urlManager->languages as $language): ?>
                    <li>
                        <?= Html::a(
                            $language,
                            Url::current([Yii::$app->urlManager->languageParam => $language])
                        ) ?>
                    </li>
                <?php endforeach; ?>
            </ul>

            <?php if (\Yii::$app->user->can('Admin')): ?>
                <h3 class="control-sidebar-heading">Application Modules</h3>
                <ul  class="control-sidebar-menu">


                    <?php  foreach ($developerMenuItems as $item) {
                        if ($item['visible']) {
                            $url = \yii\helpers\Url::to($item['url']);

                            echo '<li>';
                            echo '<a href="'.$url.'">';
                            echo '<i class="menu-icon fa fa-plug bg-gray"></i>';
                            echo '<div class="menu-info">';
                            echo $item['label'];
                            echo '</div>';
                            echo '</a>';
                            echo '</li>';
                        }
                    }
                    ?>
                    <div>
                    </div>

                </ul>
                <?php endif; ?>
        </div>
        <!-- /.tab-pane -->

        <!-- Settings tab content -->
        <div class="tab-pane" id="control-sidebar-settings-tab">
            <?php if (isset(Yii::$app->params['context.menuItems']) && !empty(Yii::$app->params['context.menuItems'])): ?>
                <h3  class="control-sidebar-heading">Context Menu</h3>
                <ul class="control-sidebar-menu">

                    <?php foreach (Yii::$app->params['context.menuItems'] as $item): ?>
                        <li>
                            <?= Html::a(
                                $item['label'],
                                $item['url']
                            ) ?></h4>

                        </li>
                    <?php endforeach; ?>
                </ul>

            <?php endif; ?>
        </div>
        <!-- /.tab-pane -->
    </div>
</aside>