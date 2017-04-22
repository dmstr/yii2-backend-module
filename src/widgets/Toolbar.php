<?php
/**
 * @link http://www.diemeisterei.de/
 * @copyright Copyright (c) 2017 diemeisterei GmbH, Stuttgart
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace dmstr\modules\backend\widgets;


use dmstr\modules\backend\assets\ToolbarAsset;
use yii\base\Widget;

class Toolbar extends Widget
{
    public function init()
    {

    }

    public function run()
    {
        ToolbarAsset::register($this->view);
        return $this->render('toolbar.twig');
    }
}