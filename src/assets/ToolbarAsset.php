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

class ToolbarAsset extends AssetBundle
{
    public $sourcePath = '@vendor/dmstr/yii2-backend-module/src/assets/toolbar';

    public $js = ['js/widget.js'];

    public $css = ['less/widget.less'];
}