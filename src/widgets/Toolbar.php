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
use pheme\settings\models\Setting;
use yii\base\Widget;
use yii\helpers\Url;
use yii\web\View;

class Toolbar extends Widget
{
    public $useIframe = true;

    public function init()
    {
        $file = \Yii::$app->assetManager->publish(dirname(__DIR__).'/assets/toolbar/js/check-frame.js');
        $this->view->registerJsFile($file[1], ['position'=>View::POS_BEGIN]);
    }

    public function run()
    {
        ToolbarAsset::register($this->view);
        return $this->render('toolbar.twig', ['useIframe'=>$this->useIframe]);
    }

    /**
     * @param $section
     * @return string
     * @throws \yii\base\InvalidConfigException
     */
    public function seoSettingUrl($section) {

        $route = Url::toRoute('');
        /** @var Setting|null $setting */
        $setting = Setting::find()->andWhere(['key' => $route,'section' => $section])->one();

        if ($setting === null) {
            return Url::to(['/settings/default/create','Setting' => [
                'key' => $route,
                'section' => $section
            ]]);
        }

        return  Url::to(['/settings/default/update','id' => $setting->id]);

    }
}