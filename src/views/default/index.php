<?php

namespace _;

use dmstr\modules\backend\Module;
use insolita\wgadminlte\Box;
use yii\helpers\Html;

$this->params['breadcrumbs'][] = ['label' => 'Dashboard'];

?>

    <div class="row">

        <?php if (\Yii::$app->user->identity->isAdmin): ?>

            <div class="col-md-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-gray">
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
                    <a href="<?= \yii\helpers\Url::to(['/']) ?>" class="small-box-footer">
                        Homepage <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- ./col -->

            <div class="col-md-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-gray">
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
                <div class="small-box bg-gray">
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
                <div class="small-box bg-<?= YII_ENV_PROD ? 'gray' : 'orange' ?>">
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
                    <a href="<?= \yii\helpers\Url::to(['/audit']) ?>" class="small-box-footer">
                        Audit <i class="fa fa-arrow-circle-right"></i>
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
                $url = \yii\helpers\Url::to($item['url']);
                $colorSelect = explode('/', $url);
                #var_dump($colorSelect);exit;
                echo '<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">';
                echo \insolita\wgadminlte\InfoBox::widget(
                    [
                        'text' => '<h4 style="white-space: normal;">'.Html::a($item['label'], $item['url']).'</h4>',
                        'boxBg' => Module::colorHash(isset($colorSelect[2]) ? $colorSelect[2] : 0),
                        'icon' => (isset($item['icon']) ? $item['icon'] : ''),
                    ]);
                echo '</div>';
            }
        }
        ?>
    </div>


<?php if (\Yii::$app->user->identity->isAdmin): ?>
    <div class="Xrow">
    <?php

    \insolita\wgadminlte\Box::begin(
        [
            'title' => 'Auto-detected modules',
            'type' => Box::TYPE_WARNING,

        ]);


    foreach ($allModulesMenuItems as $item) {
        if ($item['visible']) {
            #echo '<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">';

            $linkText = '<i class="fa fa-plug"></i>';
            $linkText .= $item['label'];

            echo Html::a($linkText, $item['url'], ['class' => 'btn btn-app']);
        }
    }
    ?>

    <?php

    Box::end();

    ?>
    <div>
<?php endif; ?>