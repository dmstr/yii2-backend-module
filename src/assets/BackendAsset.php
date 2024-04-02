<?php
/**
 * @link http://www.yiiframework.com/
 *
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace dmstr\modules\backend\assets;

use yii\web\AssetBundle as BaseBackendAssetBundle;
use dmstr\web\AdminLteAsset;

/**
 * Configuration for `backend` client script files.
 *
 * @since 4.0
 */
class BackendAsset extends BaseBackendAssetBundle
{
    public $sourcePath = __DIR__ . '/backend';

    public $css = [
        'less/backend.less',
    ];

    public $depends = [
        AdminLteAsset::class
    ];
}
