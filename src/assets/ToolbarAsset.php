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
use yii\web\JqueryAsset;
use yii\web\View;

/**
 * Class ToolbarAsset
 * @author Elias Luhr <e.luhr@herzogkommunikation.de>
 */
class ToolbarAsset extends AssetBundle
{
    public $sourcePath = '@vendor/dmstr/yii2-backend-module/src/assets/toolbar';

    public $js = ['js/widget.js'];

    public $css = ['less/widget.less'];

    public $depends = [
        JqueryAsset::class,
        \rmrevin\yii\fontawesome\AssetBundle::class
    ];
}