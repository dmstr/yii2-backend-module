<?php

namespace _;

use dmstr\modules\prototype\widgets\HtmlWidget;
use rmrevin\yii\fontawesome\component\Icon;

?>

    <div class="row">
        <div class="col-md-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-blue">
                <div class="inner">
                    <h3>
                        ID
                    </h3>

                    <p>
                        <?= getenv('APP_NAME') ?>
                    </p>
                </div>
                <div class="icon">
                    <i class="ion ion-home"></i>
                </div>
                <a href="<?= \yii\helpers\Url::to('site/index') ?>" class="small-box-footer">
                    Homepage <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->

        <?php if (\Yii::$app->user->identity->isAdmin): ?>

            <div class="col-md-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>
                            <?= \dektrium\user\models\User::find()->count() ?>
                        </h3>

                        <p>
                            Users
                        </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person"></i>
                    </div>
                    <a href="<?= \yii\helpers\Url::to(['/user/admin']) ?>" class="small-box-footer">
                        Manage <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- ./col -->

            <div class="col-md-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-orange">
                    <div class="inner">
                        <h3>
                            <?= count(\Yii::$app->getModules()) ?>
                        </h3>

                        <p>
                            Modules
                        </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="<?= \yii\helpers\Url::to(['/backend/default/view-config']) ?>" class="small-box-footer">
                        Configuration <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>

            </div>
            <!-- ./col -->

            <div class="col-md-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>
                            <?= YII_ENV ?>
                        </h3>

                        <p>
                            <?= APP_VERSION ?>
                        </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-grid"></i>
                    </div>
                    <a href="<?= \yii\helpers\Url::to(['/debug']) ?>" class="small-box-footer">
                        Debug <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- ./col -->
        <?php endif; ?>

    </div>

    <div class="row">
        <?php
        $items = \dmstr\modules\pages\models\Tree::getMenuItems(
            'backend',
            true,
            \dmstr\modules\pages\models\Tree::GLOBAL_ACCESS_DOMAIN
        );
        foreach ($items as $item) {
            if ($item['visible']) {
                echo '<div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">';
                echo \insolita\wgadminlte\SmallBox::widget(
                    [
                        'head' => substr(trim(strip_tags($item['label'])), 0, 2),
                        'type' => \insolita\wgadminlte\SmallBox::TYPE_GREEN,
                        'icon' => (isset($item['icon'])?$item['icon']:''),
                        'footer' => $item['label'],
                        'footer_link' => $item['url'],
                    ]);
                echo '</div>';
            }
        }
        ?>
    </div>


<?php if (\Yii::$app->user->identity->isAdmin): ?>
    <div class="row">
    <?php

    foreach ($allModulesMenuItems as $item) {
        if ($item['visible']) {
            echo '<div class="col-xs-6 col-sm-3 col-lg-2">';
            echo \insolita\wgadminlte\SmallBox::widget(
                [
                    'head' => substr(trim(strip_tags($item['label'])), 0, 2),
                    'icon' => 'fa fa-cog',
                    'type' => \insolita\wgadminlte\SmallBox::TYPE_GRAY,
                    'footer' => $item['label'],
                    'footer_link' => $item['url'],
                ]);
            echo '</div>';
        }
    }
    ?>
    <div>
<?php endif; ?>