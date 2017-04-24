<?php

namespace _;

use dmstr\cookiebutton\CookieButton;
use dmstr\modules\prototype\widgets\TwigWidget;
use lo\modules\noty\Wrapper;
use rmrevin\yii\fontawesome\FA;
use Yii;
use yii\base\InvalidCallException;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Menu;

/* @var $this \yii\web\View */
/* @var $content string */
$this->title = $this->title;
\dmstr\modules\backend\assets\BackendAsset::register($this);

if (Yii::$app->settings) {
    $adminLteSkin = (Yii::$app->settings->get('skin', 'backend.adminlte')) ?: 'black-light';
}

?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Ionicons -->
    <link href="//code.ionicframework.com/ionicons/1.5.2/css/ionicons.min.css" rel="stylesheet" type="text/css"/>
    <!-- Theme style -->
    <?php $this->head() ?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>

<body class="hold-transition skin-<?= $adminLteSkin ?> <?= Yii::$app->request->cookies['dmstr-backend_pin-navigation'] ?
    '' : 'sidebar-collapse' ?> <?= Yii::$app->settings->get('sidebar',
    'backend.adminlte',
    'sidebar-mini ') ?> ">
<?php $this->beginBody() ?>

<?php

// Dynamic blocks need to be rendered before `context.menuItems`, otherwise the events are fired too late.
// TODO: try catch is for open begin/end detection, move to TwigWidget
try {
    $this->beginBlock('twig-main-top');
    echo TwigWidget::widget([
        'position' => 'main-top',
        'registerMenuItems' => true,
        'queryParam' => false,
        'renderEmpty' => false,
    ]);
    $this->endBlock('twig-main-top');
} catch (InvalidCallException $e) {
    $this->blocks['twig-main-top'] = 'X';
    Yii::$app->session->addFlash('error', $e->getMessage());
}

try {
    $this->beginBlock('twig-main-bottom');
    echo TwigWidget::widget([
        'position' => 'main-bottom',
        'registerMenuItems' => true,
        'queryParam' => false,
        'renderEmpty' => false,
    ]);
    $this->endBlock('twig-main-bottom');
} catch (InvalidCallException $e) {
    $this->blocks['twig-main-bottom'] = 'X';
    Yii::$app->session->addFlash('error', $e->getMessage());
}

try {
    $this->beginBlock('extra-content');
    echo TwigWidget::widget([
        'key' => 'backend.extra.content',
        'position' => 'bottom',
        'registerMenuItems' => true,
        'queryParam' => false,
        'renderEmpty' => false,
    ]);
    $this->endBlock('extra-content');
} catch (InvalidCallException $e) {
    $this->blocks['extra-content'] = '';
    Yii::$app->session->addFlash('error', $e->getMessage());
}

?>

<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="<?= Yii::$app->homeUrl ?>" class="logo" target="_top">
            <?= FA::icon(FA::_HEART) ?>
            <span class="title"></span><?= getenv('APP_TITLE') ?>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <?= CookieButton::widget([
                'label' => '',
                'options' => [
                    'class' => 'sidebar-toggle',
                    'data-toggle' => 'offcanvas',
                    'role' => 'button',
                ],
                'cookieName' => 'dmstr-backend_pin-navigation',
                'cookieValue' => 'on',
                'cookieOptions' => [
                    'path' => '/',
                    'http' => true,
                    'expires' => 7,
                ],
            ]) ?>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <?php if (!\Yii::$app->user->isGuest): ?>

                        <!-- Messages: style can be found in dropdown.less-->
                        <li class="">
                            <?= \dmstr\modules\prototype\widgets\TwigWidget::widget([
                                'key' => 'backend.extra.menuItems',
                                'renderEmpty' => false,
                            ]) ?>
                        </li>
                        <?php if (isset(Yii::$app->params['context.menuItems']) && !empty(Yii::$app->params['context.menuItems'])): ?>
                            <li class="dropdown tasks-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-pencil-square-o"></i>
                                    <span><i class="caret"></i></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="header">Context menu items</li>
                                    <li>
                                        <!-- inner menu: contains the actual data -->
                                        <ul class="menu">

                                            <?php foreach (Yii::$app->params['context.menuItems'] as $item): ?>
                                                <li>
                                                    <?= Html::a(
                                                        $item['label'],
                                                        $item['url']
                                                    ) ?>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        <?php endif; ?>



                        <li class="dropdown tasks-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-flag"></i>
                                <span class="label label-default"><?= Yii::$app->language ?></span>
                                <span><i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">Languages</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <?php foreach (Yii::$app->urlManager->languages as $language): ?>
                                            <li>
                                                <?= Html::a(
                                                    $language,
                                                    ['', Yii::$app->urlManager->languageParam => $language]
                                                ) ?>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </li>
                            </ul>
                        </li>

                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><?= \Yii::$app->user->identity->username ?> <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <?php echo \cebe\gravatar\Gravatar::widget(
                                        [
                                            'email' => \Yii::$app->user->identity->email,
                                            'options' => [
                                                'alt' => \Yii::$app->user->identity->username,
                                            ],
                                            'size' => 128,
                                        ]
                                    ); ?>
                                    <p>
                                        <?= \Yii::$app->user->identity->username ?>
                                        <small><?= \Yii::$app->user->identity->email ?></small>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="<?= \yii\helpers\Url::to(['/user/settings/profile']) ?>"
                                           class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?= \yii\helpers\Url::to(['/user/security/logout']) ?>"
                                           class="btn btn-default btn-flat" data-method="post">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>

                        <li class="dropdown custom-menu">

                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-home"></i>
                                <span><i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
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

                        </li>

                        <li>
                            <a href="<?= Url::to('') ?>" target="_top">
                                <i class="fa fa-arrow-circle-up"></i>
                            </a>
                        </li>

                        <li>
                            <a href="<?= Url::to(['/backend']) ?>" target="_top">
                                <i class="fa fa-dashboard"></i>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <?= $this->render('_sidebar') ?>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Right side column. Contains the navbar and content of the page -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <?= $this->title ?>
                <small>Backend</small>
            </h1>
            <?=
            \yii\widgets\Breadcrumbs::widget(
                [
                    'homeLink' => ['label' => 'Backend', 'url' => ['/backend']],
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]
            ) ?>
        </section>

        <!-- Main content -->

        <section class="content">
            <?= Wrapper::widget([
                'layerClass' => 'lo\modules\noty\layers\Growl',
                'options' => [
                    'dismissQueue' => true,
                    'location' => 'br',
                    'timeout' => 4000,
                ],
            ]) ?>
            <?= $this->blocks['twig-main-top'] ?>
            <?= $content ?>
            <?= $this->blocks['twig-main-bottom'] ?>
        </section>
        <!-- /.content -->
    </div>

    <?= $this->blocks['extra-content'] ?>

    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <strong>
            <?= getenv('APP_NAME') ?>-<?= APP_VERSION ?></strong>
        built with
        <a href="http://phundament.com" target="_blank">phd</a>
    </footer>
</div>
<!-- ./wrapper -->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
