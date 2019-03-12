<?php

use yii\bootstrap\Nav as Menu;
use yii\helpers\Html;
use yii\helpers\Url;

?>

<?php
$backendModule = Yii::$app->getModule('backend');
foreach (\dmstr\helpers\Metadata::getModules() as $name => $module) {
    if (in_array($name, $backendModule->modulesDashboardBlacklist,true)) {
        continue;
    }

    $role = $name;

    $defaultItem = [
        'icon' => 'fa fa-cube',
        'label' => $name,
        'url' => ['/' . $name],
        'visible' => Yii::$app->user->can($role),
        'items' => [],
    ];

    $developerMenuItems[] = $defaultItem;
}

if (Yii::$app->hasModule('pages')) {
    $rootItems = \dmstr\modules\pages\models\Tree::getMenuItems('root');
} else {
    $rootItems = [];
}

if (Yii::$app->urlManager->hasProperty('language')) {
    $languages = Yii::$app->urlManager->language;
} else {
    $languages = explode(',', getenv('APP_LANGUAGES'));
}

?>

<aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
        <li class="active">
            <a href="#control-sidebar-home-tab" data-toggle="tab" aria-expanded="true"><i
                        class="fa fa-home"></i></a></li>
        <li class="">
            <a href="#control-sidebar-languages-tab" data-toggle="tab" aria-expanded="false"><i
                        class="fa fa-flag"></i></a></li>
        <li class="">
            <a href="#control-sidebar-modules-tab" data-toggle="tab" aria-expanded="false"><i
                        class="fa fa-plug"></i></a></li>
        <li class="">
            <a href="#control-sidebar-settings-tab" data-toggle="tab" aria-expanded="false"><i
                        class="fa fa-edit"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
        <!-- Home tab content -->
        <div class="tab-pane active" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading"><?=Yii::t('backend-module','Frontend Menu')?></h3>
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
                            'items' => $rootItems,
                        ]
                    );
                    ?>


                </li>
            </ul>
            <!-- /.control-sidebar-menu -->


        </div>
        <div id="control-sidebar-languages-tab" class="tab-pane">
            <h3 class="control-sidebar-heading"><?=Yii::t('backend-module','Languages')?></h3>


            <!-- inner menu: contains the actual data -->
            <ul class="control-sidebar-menu">
                <?php foreach ($languages as $language): ?>
                    <li>
                        <?= Html::a(
                            $language,
                            Url::current([Yii::$app->urlManager->languageParam => $language]),
                            ['class' => (Yii::$app->language === $language) ? 'active' : '']
                        ) ?>
                    </li>
                <?php endforeach; ?>
            </ul>


        </div>
        <div id="control-sidebar-modules-tab" class="tab-pane">
            <?php if (\Yii::$app->user->can('Admin')): ?>
                <h3 class="control-sidebar-heading"><?=Yii::t('backend-module','Application Modules')?></h3>
                <ul class="control-sidebar-menu">


                    <?php foreach ($developerMenuItems as $item) {
                        if ($item['visible']) {
                            $url = \yii\helpers\Url::to($item['url']);

                            echo '<li>';
                            echo '<a href="' . $url . '">';
                            echo $item['label'];
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
                <h3 class="control-sidebar-heading"><?=Yii::t('backend-module','Context Menu')?></h3>
                <ul class="control-sidebar-menu">

                    <?php foreach (Yii::$app->params['context.menuItems'] as $item): ?>
                        <li>
                            <?= Html::a(
                                $item['label'],
                                $item['url']
                            ) ?>

                        </li>
                    <?php endforeach; ?>
                </ul>

            <?php endif; ?>
        </div>
        <!-- /.tab-pane -->
    </div>
</aside>