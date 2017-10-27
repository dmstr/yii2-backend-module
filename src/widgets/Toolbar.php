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
use yii\web\View;

class Toolbar extends Widget
{
    public $useIframe = true;

    public function init()
    {
        $file = \Yii::$app->assetManager->publish(__DIR__.'/../assets/toolbar/js/check-frame.js');
        $this->view->registerJsFile($file[1], ['position'=>View::POS_BEGIN]);
    }

    public function run()
    {
        ToolbarAsset::register($this->view);
        return $this->render('toolbar.twig', ['useIframe'=>$this->useIframe]);
    }
}