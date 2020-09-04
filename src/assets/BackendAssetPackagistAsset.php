<?php
/**
 * @link http://www.yiiframework.com/
 *
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace dmstr\modules\backend\assets;

use urosg\widgets\OutdatedBrowserRework\OutdatedBrowserReworkWidgetAsset;
use yii\web\AssetBundle as BaseBackendAssetBundle;
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
        'backend-asset-packagsist.less',
    ];

    public $depends = [
        AdminLteAsset::class,
        OutdatedBrowserReworkWidgetAsset::class
    ];
}
