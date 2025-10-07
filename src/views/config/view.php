<?php

/**
 * @var \yii\data\DataProviderInterface $loadedModulesDataProvider
 * @var array $params
 * @var array $components
 * @var array $modules
 * @var array $env
*/

namespace _;

use insolita\wgadminlte\Box;
use yii\bootstrap\Tabs;
use yii\helpers\HtmlPurifier;
use yii\helpers\Json;
use yii\helpers\VarDumper;
use yii\widgets\ListView;
use \Yii;

$this->params['breadcrumbs'][] = ['label' => Yii::t('backend-module', 'Configuration')];
$this->title = Yii::t('backend-module', 'Configuration');
?>

<div class="row">
    <div class="col-sm-6">
        <?php $this->beginBlock('controllers') ?>

        <div class="row">
            <?= $this->render('_module', ['key' => null]) ?>
        </div>

        <?= ListView::widget(
            [
                'dataProvider' => $loadedModulesDataProvider,
                'itemView' => '_module',
                'layout' => '{summary}{pager}<div class="row">{items}</div>'
            ]
        )
        ?>
        <?php $this->endBlock('controllers') ?>
    </div>
</div>


<?php $this->beginBlock('params') ?>
<?php foreach ($params as $name => $element): ?>
    <div class="row">
        <div class="col-sm-2">
            <b><?= $name ?></b>
        </div>
        <div class="col-sm-10">
<pre>
<?= Json::encode($element, JSON_PRETTY_PRINT) ?>
</pre>
        </div>
    </div>
<?php endforeach ?>
<?php $this->endBlock('params') ?>


<?php $this->beginBlock('components') ?>
<?php foreach ($components as $name => $element): ?>
    <div class="row">
        <div class="col-sm-2">
            <b><?= $name ?></b>
        </div>
        <div class="col-sm-10">
<pre>
<?= Json::encode($element, JSON_PRETTY_PRINT) ?>
</pre>
        </div>
    </div>
<?php endforeach ?>
<?php $this->endBlock('components') ?>

<?php $this->beginBlock('modules') ?>
<?php foreach ($modules as $name => $element): ?>
    <?php Box::begin([
        'title' => $name,
        'collapse' => true,
        'collapse_remember' => false,
    ]) ?>

    <div class="row">
        <div class="col-sm-2">
            <b><?= $name ?></b>
        </div>
        <div class="col-sm-10">
<pre>
<?= VarDumper::dumpAsString($element, 2, true) ?>
</pre>
        </div>
    </div>

    <?php Box::end() ?>
<?php endforeach ?>
<?php $this->endBlock('modules') ?>


<?php $this->beginBlock('env') ?>
<pre>
<?= HtmlPurifier::process(VarDumper::dumpAsString($env)) ?>
</pre>
<?php $this->endBlock('env') ?>



<div class="nav-tabs-custom">
    <?= Tabs::widget([
        'items' => [
            [
                'label' => Yii::t('backend-module', 'Params'),
                'content' => $this->blocks['params'],
            ],
            [
                'label' => Yii::t('backend-module', 'Components'),
                'content' => $this->blocks['components'],
            ],
            [
                'label' => Yii::t('backend-module', 'Modules'),
                'content' => $this->blocks['modules'],
            ],
            [
                'label' => Yii::t('backend-module', 'Controllers'),
                'content' => $this->blocks['controllers'],
            ],
            [
                'label' => Yii::t('backend-module', 'Environment'),
                'content' => $this->blocks['env'],
            ],
        ],
    ]) ?>
</div>
