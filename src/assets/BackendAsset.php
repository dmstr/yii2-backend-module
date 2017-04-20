<?php

namespace dmstr\modules\backend\assets;

/*
 * @link http://www.yiiframework.com/
 *
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

use yii\web\AssetBundle as BaseBackendAssetBundle;

/**
 * Configuration for `backend` client script files.
 *
 * @since 4.0
 */
class BackendAsset extends BaseBackendAssetBundle
{
    public $sourcePath = '@vendor/dmstr/yii2-backend-module/src/assets/web';

    public $css = [
        'less/backend.less',
    ];
    public $js = [
    ];
    public $depends = [
        'dmstr\web\AdminLteAsset',
    ];
}
