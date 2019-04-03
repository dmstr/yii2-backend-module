<?php
/**
 * @link http://www.diemeisterei.de/
 * @copyright Copyright (c) 2017 diemeisterei GmbH, Stuttgart
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace dmstr\modules\backend\assets;

use yii\web\AssetBundle;
use yii\web\View;

/**
 * @package dmstr\modules\backend\assets
 */
class BackendJsAsset extends AssetBundle
{
    public $sourcePath = '@vendor/dmstr/yii2-backend-module/src/assets/backend';

    public $js = [
        'js/is-framed.js',
        'js/outdated-browser.js',
    ];
    public $jsOptions = [
        'position' => View::POS_BEGIN
    ];
}