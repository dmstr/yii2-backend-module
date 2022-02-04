<?php

namespace _;

use dmstr\helpers\Metadata;
use Yii;
use yii\helpers\Html;

// TODO: improve/handle detection in Metadata module
if ($model['module'] === Yii::$app->id) {
    $controller = Yii::$app->createController($model['name']);
} else {
    $controller = Yii::$app->createController($model['module'].'/'.$model['name']);
}

?>

<?php
// TODO: this is just a hotfix
if ($controller[0]):
    ?>
    <div class="row">
        <div class="col-sm-2">
            <b><?= $controller[0]->id ?></b>
        </div>
        <div class="col-sm-10">
            <div class="well">
                <b><?= Html::a($model['route'], $model['route']) ?></b>
                <br/>
                <?php
                foreach (Metadata::getControllerActions($controller[0]) as $action) {
                    echo Html::a($action['route'], $action['route']).'<br/>';
                }
                ?>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="alert alert-warning">
        <?php echo Yii::t('backend-module', 'Unable to detect controllers for <b>{moduleName}</b>', [
                'moduleName' => $model['name']
        ])?>
    </div>
<?php endif; ?>
