<?php
// prepare assets
use dmstr\modules\backend\assets\BackendAsset;
use dmstr\modules\backend\assets\BackendJsAsset;
use yii\helpers\Html;

BackendAsset::register($this);
BackendJsAsset::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
    <?= Html::csrfMetaTags() ?>
  <title><?= Html::encode($this->title) . ' - ' . Yii::$app->name ?></title>
  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  <!-- Theme style -->
    <?php $this->head() ?>
</head>

<body class="hold-transition login-page">
<?php $this->beginBody() ?>
<div class="login-box">
  <div class="login-logo">
    <a href="<?= Yii::$app->homeUrl ?>"><b><?= getenv('APP_TITLE') ?></b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <div class="row">
      <div class="col-md-offset-3 col-md-6">
          <?= \dmstr\widgets\Alert::widget(['closeButton'=>false]) ?>
      </div>
    </div>

      <?= $content ?>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

