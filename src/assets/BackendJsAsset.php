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

class BackendJsAsset extends AssetBundle
{
    public $sourcePath = '@vendor/dmstr/yii2-backend-module/src/assets/backend';

    public $js = [
        'js/is-framed.js',
    ];
    public $jsOptions = [
        'position' => View::POS_BEGIN
    ];
}