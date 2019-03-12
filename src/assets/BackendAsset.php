<?php

namespace dmstr\modules\backend\assets;

/*
 * @link http://www.yiiframework.com/
 *
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

use yii\web\AssetBundle as BaseBackendAssetBundle;
use yii\web\View;
use dmstr\web\AdminLteAsset;

/**
 * Configuration for `backend` client script files.
 *
 * @since 4.0
 */
class BackendAsset extends BaseBackendAssetBundle
{
    public $sourcePath = '@vendor/dmstr/yii2-backend-module/src/assets/backend';

    public $css = [
        'less/backend.less',
    ];

    public $depends = [
        AdminLteAsset::class,
    ];
}
