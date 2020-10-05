<?php

namespace dmstr\modules\backend\controllers;

use dmstr\modules\backend\Module;
use dmstr\widgets\Menu;
use insolita\wgadminlte\InfoBox;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\Controller;

/**
 * Default backend controller.
 *
 * Usually renders a customized dashboard for logged in users
 */
class DefaultController extends Controller
{

    /**
     * Application dashboard.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (Yii::$app->hasModule('pages')) {
            // no `use` statement, since module is optional
            $items = \dmstr\modules\pages\models\Tree::getMenuItems('backend', true);
        } else {
            $items = [];
        }

        return $this->render('index', ['items' => $items]);
    }



    /**
     * @param array $item \dmstr\modules\pages\models\Tree::getMenuItems()
     *
     * @return string
     * @throws \Exception
     */
    public function renderDashboardMenu($item = [])
    {
        $menuItems = '';

        if (!isset($item['items'])) {
            return $menuItems;
        }

        foreach ($item['items'] as $subItem) {
            if ($subItem['visible'] && $subItem['url'] && $subItem['url'] !== '#') {
                $colorSelect = ArrayHelper::getValue($item, 'icon');
                $menuItems .= '<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">';
                $infoBoxHtml = InfoBox::widget(
                    [
                        'text' => '<h4 style="white-space: normal;">'.$subItem['label'].'</h4>',
                        'boxBg' => Module::colorHash($colorSelect[2] ?? 0),
                        'icon' => (isset($subItem['icon']) && !empty($subItem['icon']))
                            ? Menu::$iconClassPrefix.$subItem['icon']
                            : 'fa fa-circle-o',
                    ]);
                $menuItems .= Html::a($infoBoxHtml, $subItem['url']);
                $menuItems .= '</div>';
            }

            if (!empty($subItem['items'])) {
                $menuItems .= $this->renderDashboardMenu($subItem);
            }
        }

        return $menuItems;
    }

}
