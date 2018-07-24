<?php
/**
 * @var $allModulesMenuItems array
 */

use dmstr\modules\backend\Module;
use dmstr\modules\pages\models\Tree;
use insolita\wgadminlte\Box;
use yii\helpers\Html;

$this->params['breadcrumbs'][] = ['label' => 'Dashboard'];
$this->title = "Dashboard";
?>

    <div class="row">

        <?php if (\Yii::$app->user->can('Admin')): ?>

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
                            <?= defined('PROJECT_VERSION') ? PROJECT_VERSION : '-' ?>
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
        /** @var $items array */
        $items = Tree::getMenuItems('backend', true);
        echo $this->context->renderDashboardMenu(['items' => $items]);
        ?>
    </div>


<?php if (\Yii::$app->user->can('Admin')): ?>
    <?php Box::begin(
        [
            'title' => 'Auto-detected modules',
            'type' => Box::TYPE_WARNING,

        ]);
    ?>
    <div class="row">
      <?php  foreach ($allModulesMenuItems as $item) {
            if ($item['visible']) {
                echo '<div class="col-xs-6 col-sm-3 col-md-2 col-lg-2 text-error">';
                $url = \yii\helpers\Url::to($item['url']);
                $colorSelect = explode('/', $url);

                $linkText = '<span class="badge bg-'.Module::colorHash(isset($colorSelect[2]) ? $colorSelect[2] : 0).'">&nbsp;</span><i class="fa fa-plug"></i>';
                $linkText .= $item['label'];

                echo Html::a($linkText, $item['url'], ['class' => 'btn btn-app btn-block']);
                echo '</div>';
            }
        }
        ?>
    <div>
    <?php Box::end(); ?>
<?php endif; ?>