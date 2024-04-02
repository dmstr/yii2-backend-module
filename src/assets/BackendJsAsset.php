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
    public $sourcePath = __DIR__ . '/backend-js';

    public $js = [
        'is-framed.js'
    ];
    public $jsOptions = [
        'position' => View::POS_BEGIN
    ];
}
