<?php
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend-module', 'Dashboard')];
$this->title = Yii::t('backend-module', 'Dashboard');
?>

    <h1>Backend</h1>

    <div class="row">

        <?php if (\Yii::$app->user->can('Admin')): ?>

            <div class="col-md-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>
                            <?= getenv('APP_NAME') ?>
                        </h3>

                        <p>
                            <?=Yii::t('backend-module', 'Application ID')?>

                        </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-home"></i>
                    </div>
                    <a href="<?= \yii\helpers\Url::to(['/']) ?>" class="small-box-footer">
                        <?=Yii::t('backend-module', 'Homepage')?> <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- ./col -->

            <div class="col-md-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-navy">
                    <div class="inner">
                        <h3>
                            <?php
                            if (method_exists(\Yii::$app->user->identityClass, 'find')
                                && method_exists(\Yii::$app->user->identityClass::find(), 'count')) {
                                echo \Yii::$app->user->identityClass::find()->count();
                            } else {
                                echo '-';
                            }
                            ?>
                        </h3>

                        <p>
                            <?=Yii::t('backend-module', 'Users')?>
                        </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person"></i>
                    </div>
                    <a href="<?= \yii\helpers\Url::to(['/user/admin']) ?>" class="small-box-footer">
                        <?=Yii::t('backend-module', 'Manage')?> <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- ./col -->

            <div class="col-md-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-olive">
                    <div class="inner">
                        <h3>
                            <?= count(\Yii::$app->getModules()) ?>
                        </h3>

                        <p>
                            <?=Yii::t('backend-module', 'Modules')?>
                        </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="<?= \yii\helpers\Url::to(['/backend/config/view']) ?>" class="small-box-footer">
                        <?=Yii::t('backend-module', 'Configuration')?> <i class="fa fa-arrow-circle-right"></i>
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
                            <?= defined('PROJECT_VERSION') ? PROJECT_VERSION : '-' ?>
                        </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-grid"></i>
                    </div>
                    <a href="<?= \yii\helpers\Url::to(['/audit']) ?>" class="small-box-footer">
                        <?=Yii::t('backend-module', 'Audit')?> <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>


            <div class="col-md-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-olive">
                    <div class="inner">
                        <h3>
                            Diagram
                        </h3>
                            RBAC Hierarchy
                        <p>

                        </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-grid"></i>
                    </div>
                    <a href="<?= \yii\helpers\Url::to(['rbac/diagram']) ?>" class="small-box-footer">
                        <?=Yii::t('backend-module', 'Diagram')?> <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>


            <div class="col-md-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-olive">
                    <div class="inner">
                        <h3>
                            Auth
                        </h3>

                        <p>
                           Roles & Permissions
                        </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-grid"></i>
                    </div>
                    <a href="<?= \yii\helpers\Url::to(['rbac/assignments']) ?>" class="small-box-footer">
                        <?=Yii::t('backend-module', 'Assignments')?> <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>


            <div class="col-md-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-gray">
                    <div class="inner">
                        <h3>
                            Cache
                        </h3>

                        <p>
                            Flush
                        </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-grid"></i>
                    </div>
                    <a data-confirm="<?=Yii::t('backend-module', 'Are you sure?')?>" href="<?= \yii\helpers\Url::to(['default/cache-flush']) ?>" class="small-box-footer">
                        <?=Yii::t('backend-module', 'Flush')?> <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- ./col -->
        <?php endif; ?>

    </div>

    <div class="row">
        <?php
        echo $this->context->renderDashboardMenu(['items' => $items]);
        ?>
    </div>


